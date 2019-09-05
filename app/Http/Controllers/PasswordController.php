<?php

namespace App\Http\Controllers;

use App\Notifications\ResetPassword;
use App\User;
use Illuminate\Http\Request;

class PasswordController extends Controller
{
    /**
     * 找回密码表单
     */
    public function findPasswordForm()
    {
        return view('password.find');
    }

    /**
     * 找回密码操作 - 发送邮件
     */
    public function findPassword(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            session()->flash('warning', '该邮箱还未注册，请检查填写是否正确！');
            return back()->withInput();
        }

        // 发送通知邮件
        $user->notify(new ResetPassword($user->email_token));

        return redirect()->route('home')->with('success', '邮件已发送，赶紧去看看吧！');
    }

    /**
     * 重置密码表单
     */
    public function resetPasswordForm($token)
    {
        $user = $this->getUserByToken($token);
        if (!$user) {
            return redirect()->home()->with('danger', '链接不正确');
        }
        return view('password.reset', compact('user'));
    }

    /**
     * 重置密码操作
     */
    public function resetPassword(Request $request)
    {
        $this->validate($request, [
            'password' => 'required|min:5|confirmed',
        ]);
        $user = $this->getUserByToken($request->email_token);
        $user->password = bcrypt($request->password);
        $user->email_token = str_random(20);
        $user->save();

        return redirect()->route('login')->with('success', '密码重置成功！');
    }

    /**
     * 通过 email_token获取用户实例
     *
     * @param $token
     * @return mixed
     */
    public function getUserByToken($token)
    {
        return User::where('email_token', $token)->first();
    }
}
