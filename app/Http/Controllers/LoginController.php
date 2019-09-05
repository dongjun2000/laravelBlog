<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * 用户登录表单
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function loginForm()
    {
        return view('login');
    }

    /**
     * 用户登录操作
     * @param Request $request
     */
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // 用户登录
        if (\Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ])) {
            return redirect()->route('home')->with('success', '登录成功！');
        }

        session()->flash('warning', '用户名或密码错误！');
        return back()->withInput();
    }

    /**
     * 用户退出
     */
    public function logout()
    {
        \Auth::logout();
        return redirect()->route('home')->with('success', '退出成功！');
    }
}
