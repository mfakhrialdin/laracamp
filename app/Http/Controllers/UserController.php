<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Auth;

class UserController extends Controller
{
    //integrasi ke halaman login
    public function login() {
        return view('auth.user.login');
    }

    //menampilkan list gmail
    public function google() {
        return Socialite::driver('google')->redirect();
    }

    //handle callback setelah email dipilih
    public function handleProviderCallBack() {
        //memngambil data dari akun email google dalam bentuk collection
        $callback = Socialite::driver('google')->stateless()->user();

        //parsing data
        $data = [
            'name' => $callback->getName(),
            'email' => $callback->getEmail(),
            'avatar' => $callback->getAvatar(),
            'email_verified_at' => date('Y-m-d H:i:s',time())
        ];

        $user = User::firstOrCreate(['email' => $data['email']], $data);
        Auth::login($user, true);

        return redirect(route('welcome'));
    }
}
