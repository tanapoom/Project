<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\User;
use Illuminate\Support\Facades\Redirect as FacadesRedirect;
use Redirect;

class loginController extends Controller
{
    //
    function login(Request $request)
    {
        $user = $request->input('username');
        $pass = $request->input('password');
        $admin = User::where('username', 'admin')->first()->toArray();
        if ($user == $admin["username"] && $pass == $admin["password"]) {
            session()->put('login', true);
            return Redirect::to('/admin');
        } else {
            session()->flash('loginFail', 'fail');
            return Redirect::to('/adminlogin');
        }
    }

    function checkLogin()
    {

        if (Session::has('login')) {
            return Redirect::to('admin');
        } else

            return view('login');
    }

    function logout(Request $request)
    {
        $request->session()->forget('login');
        return Redirect::to('/');
    }
}
