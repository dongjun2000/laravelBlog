<?php

namespace App\Http\Controllers;

use App\Blog;
use App\Mail\RegMail;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    /**
     * 网站首页
     */
    public function home()
    {
        $blogs = Blog::orderBy('id', 'DESC')->with('user')->paginate(10);
        return view('home', compact('blogs'));
    }
}
