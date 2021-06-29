<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{
    public function login() {
        return view('admin.auth.login');
    }

    public function store(Request $request)
    {
        $this->validate($request, 
            [
                'username' => 'bail|required',
                'password' => 'required'
            ],
            [
                'username.required' => 'Vui lòng nhập tài khoản hoặc email',
                'password.required' => 'Vui lòng nhập mật khẩu'
            ]
        );

        $username = Auth::attempt(['username' => $request->username,'password' => $request->password]);
        $email = Auth::attempt(['email' => $request->username,'password' => $request->password]);

        if (!$username && !$email) {
            return back()->withErrors(['error' => __('messages.login_failed')]);
        }

        return redirect()->route('admin.index');
    }

    public function forgotPassword()
    {
        return view('admin.auth.reset-pass');
    }

    public function resetPassword(Request $request)
    {
        $request->validate(
            [
                'email' => 'bail|required|email|exists:users,email'
            ],
            [
                'email.required' => 'Vui lòng nhập Email.',
                'email.email' => 'Email chưa đúng định dạng.',
                'email.exists' => 'Email không tồn tại.'
            ]
        );
        return view('admin.pages.error.404');
    }

    public function logOut()
    {
        Auth::logout();
        return redirect()->route('home');
    }
}
