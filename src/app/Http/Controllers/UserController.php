<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use App\Models\User;
use Illuminate\Support\Facades\Redis;

class UserController extends BaseController
{
    public function index()
    {
        $users = User::all();
        $redisKeys = Redis::keys('user-*');
        return view('user/index', ['users' => $users, 'redisKeys' => $redisKeys]);
    }

    public function store(Request $request)
    {
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->save();

        Redis::set("user-{$user->id}", $user->name, 86400);
        return redirect('users');
    }
}
