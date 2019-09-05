<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * 用户退出
     */
    public function logout()
    {
        \Auth::logout();
        return redirect()->route('home')->with('success', '退出成功！');
    }
}
