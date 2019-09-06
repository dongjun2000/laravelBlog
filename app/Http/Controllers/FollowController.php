<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    /**
     * 我的关注
     */
    public function follows(User $user)
    {
        $title = '我的关注';
        $users = $user->follows()->paginate(1);
        return view('follow.index', compact('title','users'));
    }

    /**
     * 我的粉丝
     */
    public function fans(User $user)
    {
        $title = '我的粉丝';
        $users = $user->fans()->paginate(1);
        return view('follow.index', compact('title','users'));
    }
}
