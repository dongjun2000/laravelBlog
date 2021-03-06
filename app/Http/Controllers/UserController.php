<?php

namespace App\Http\Controllers;

use App\Blog;
use App\Mail\RegMail;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', [
            'except' => ['index', 'show', 'create', 'store', 'confirmEmailToken']
        ]);

        $this->middleware('guest', [
            'only' => ['create', 'store', 'confirmEmailToken']
        ]);
    }

    /**
     * 用户列表
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('id', 'DESC')->paginate(10);
        return view('user.index', compact('users'));
    }

    /**
     * 用户注册表单
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * 用户注册操作
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 表单验证
        $data = $this->validate($request, [
            'name' => 'required|min:3|max:20',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:5|confirmed'
        ]);
        
        $data['password'] = bcrypt($data['password']);

        // 添加用户
        $user = User::create($data);

        // 用户登录
//       \Auth::attempt(['email' => $request->email, 'password' => $request->password]);

        // 发送注册邮件
        \Mail::to($user)->send(new RegMail($user));

       return redirect()->route('home')->with('success', '注册成功！并已为你自动登录~~~');
    }

    /**
     * 关注与取关
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function follow(User $user)
    {
        $user->followToggle(\Auth::user()->id);

        return back();
    }

    /**
     * 用户个人主页
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $blogs = Blog::where('user_id', $user->id)->orderBy('id', 'DESC')->paginate(10);

        // 关注状态
        $followStatus = '关注我';
        if (\Auth::check()) {
            $followStatus = $user->isFollow(\Auth::user()->id) ? '取消关注' : '关注我';
        }

        return view('user.show', compact('user', 'blogs', 'followStatus'));
    }

    /**
     * 修改个人信息页面
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $this->authorize('update', $user);

        return view('user.edit', compact('user'));
    }

    /**
     * 修改个人信息操作
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->authorize('update', $user);

        $this->validate($request, [
            'name' => 'nullable|min:2|max:20',
            'password' => 'nullable|min:5|confirmed|required_without:name'
        ],[
            'password.required_without' => '昵称与密码必须填写一项',
        ], [
            'name' => '昵称',
        ]);

        if ($request->name) {
            $user->name = $request->name;
        }
        if ($request->password) {
            $user->password = bcrypt($request->password);
        }
        $user->save();

        return back()->with('success', '修改成功！');
    }

    /**
     * 删除用户
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->authorize('delete', $user);

        $user->delete();

        return back()->with('success', '删除成功！');
    }

    /**
     * 邮件激活用户
     *
     * @param $token
     * @return \Illuminate\Http\RedirectResponse
     */
    public function confirmEmailToken($token)
    {
        $user = User::where('email_token', $token)->first();

        if ($user) {
            if ($user['email_active']) {    // 判断账户激活状态
                return redirect()->route('home')->with('warning', '账号已激活！无需重复激活');
            } else {
                $user->email_active = true;
                $user->email_token = str_random(20);
                $user->save();
                \Auth::login($user);
                return redirect()->route('home')->with('success', '账号激活成功');
            }
        }

        return redirect()->route('home')->with('warning', '邮箱验证失败！请重新发送邮件~');
    }
}
