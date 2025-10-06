<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\User;

class AuthController extends Controller
{
    // ===================== REGISTER =====================
    public function register()
    {
        return view('register');
    }

    public function post_register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|dns',
            'password' => 'required|min:8',
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal!', 'Pastikan semua terisi dengan benar!');
            return redirect()->back();
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'point' => 10000,
        ]);

        if ($user) {
            Alert::success('Berhasil!', 'Akun baru berhasil dibuat, silahkan melakukan login!');
            return redirect('/');
        } else {
            Alert::error('Gagal!', 'Akun gagal dibuat, silahkan coba lagi!');
            return redirect()->back();
        }
    }

    // ===================== LOGIN =====================
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email:dns',
            'password' => 'required|min:8|max:15',
        ]);

        if ($validator->fails()) {
            Alert::error('Login Failed', 'Invalid input');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            Alert::success('Success', 'Welcome Admin!');
            return redirect()->route('admin.dashboard');
        } elseif (Auth::attempt($credentials)) {
            Alert::success('Success', 'Welcome User!');
            return redirect()->route('user.dashboard');
        } else {
            Alert::error('Login Failed', 'Incorrect email or password');
            return redirect()->back()->withInput();
        }
    }

    // ===================== LOGOUT =====================
    public function admin_logout()
    {
        Auth::guard('admin')->logout();
        Alert::success('Logged Out', 'Admin has been logged out');
        return redirect('/');
    }

    public function user_logout()
    {
        Auth::logout();
        Alert::success('Logged Out', 'User has been logged out');
        return redirect('/');
    }
}
