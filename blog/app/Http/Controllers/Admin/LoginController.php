<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;

// 有些命令需要注释这行代码
include_once(base_path('public/org/code/Code.class.php'));

class LoginController extends CommonController
{
    public function login()
    {
        if ($input = Input::all()) {
            $code = new \Code();
            if (strtoupper($input['code']) != strtoupper($code->get())) {
                return back()->with('msg', '验证码错误');
            }

            $user = User::first();
            if (!($input['username'] == $user->username && $input['password'] == Crypt::decrypt($user->password))) {
                return back()->with('msg', '用户名或密码错误');
            }

            session(['user' => $user]);
            return redirect('admin/index');
        }
        return view('admin.login', ['title' => '登录界面']);
    }

    public function code()
    {
        $code = new \Code();
        $code->make();
    }

    public function logout()
    {
        session(['user' => null]);
        return redirect('admin/login');
    }
}
