<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        // echo 'my_user_name : <input value="'
        //     . \Illuminate\Support\Facades\Hash::make('Kurts123')
        //     . '">';
        // exit();

        return view(
            'auth.login',
            [
                'title' => 'Login'
            ]
        );
    }
    public function authenticate(Request $request)
    {
        $credentials = $request->only('name', 'password');
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('books');
        }
        return back()->withErrors([
            'name' => 'Authentication error',
        ]);
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
