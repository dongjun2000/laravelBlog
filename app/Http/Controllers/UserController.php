<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', [
            'except' => ['index', 'show', 'create', 'store']
        ]);

        $this->middleware('guest', [
            'only' => ['create', 'store']
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
        User::create($data);

        // 用户登录
       \Auth::attempt(['email' => $request->email, 'password' => $request->password]);

       return redirect()->route('home')->with('success', '注册成功！并已为你自动登录~~~');
    }

    /**
     * 用户个人主页
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('user.show', compact('user'));
    }

    /**
     * 修改个人信息页面
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
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
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
