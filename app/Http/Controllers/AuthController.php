<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Session;
use Mockery\Generator\StringManipulation\Pass\Pass;

class AuthController extends Controller
{
    function index()
    {
        return view('login');
    }

    function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ],[
            'email.required' => 'Email Wajib Diisi',
            'password.required' => 'Password Wajib Diisi',
        ]);

        $infologin = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if(Auth::attempt($infologin)) {
            if(Auth::user()->role == 'admin') {
                return redirect('admin/dashboard');
            }elseif (Auth::user()->role == 'staff'){
                return redirect('admin/dashboard');
            }elseif (Auth::user()->role == 'customer') {
                return redirect('main/landingpage');
            }
        }else {
            return redirect('/')->withErrors('Username dan password yang dimasukkan tidak benar');
        }
    }

    public function registerPage() {
        return view('register');
    }

    public function createUser(Request $request) {
        Session::flash('name', $request->name);
        Session::flash('username', $request->username);
        Session::flash('email', $request->email);
        Session::flash('password', $request->password);
        $request->validate([
            'name' => 'required',
            'username' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ], [
            'name.required' => 'Name Wajib Diisi',
            'username.required' => 'Username Wajib Diisi',
            'email.required' => 'Email Wajib Diisi',
            'email.email' => 'Email tidak valid',
            'email.unique' => 'Email telah terdaftar',
            'password.required' => 'Password Wajib Diisi',
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' =>Hash::make($request->password)
        ]);

        return redirect('/')->with('success', 'Login now');

    }

    function forgotPassword()
    {
        return view('forgot');
    }

    function resetLink(Request $request) {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    function resetPassword($token) {
        return view('formresetpassword', ['token' =>$token])->with('success', 'Success sending email notification reset password');
    }

    function updatePassword(Request $request) {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed'
        ]);

        $status = Password::reset(
            $request->only('email', 'password','password_confirmation','token'),
            function($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
        ?  redirect()->route('/')->with('status', __($status))
        : back()->withErrors(['email' => [__($status)]]);
    }

    function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
