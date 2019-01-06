<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class RegisterController extends Controller {

    public function index() {
        return view('register.index');
    }

    public function register() {
        // 验证
        $this->validate(request(), [
            'name' => 'required|min:3|unique:users,name',
            'email' => 'required|unique:users,email|email',
            'password' => 'required|min:5|max:10|confirmed'
        ]);
        // 逻辑
        $name = \request('name');
        $email = \request('email');
        $password = bcrypt(request('password'));
        // 渲染
        User::create(compact('name', 'email', 'password'));

        return redirect('/login');
    }
}
