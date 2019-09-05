<?php

namespace App\Http\Controllers;

use App\Mail\RegMail;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    /**
     * 网站首页
     */
    public function home()
    {
        $user = \App\User::find(1);
        \Mail::to($user)->send(new RegMail());
        return view('home');
    }
}
