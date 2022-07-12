<?php

namespace App\Http\Controllers;

use App\Models\MyUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;


class LoginController extends Controller
{
    public function index(){
        return view('panel.loginPanel');
    }

    public function login(Request $request){
        $user = new MyUser();
        $user->email = $request->input('email');
        $user->password = $request->input('password');
        $result = DB::table('my_users')->where([['email', $user->email],
            ['password', $user->password]
        ])->count();
        if($result == 1){
            $check = 'true';
            Session::put('login', $check );
            Session::save();
            return app('App\Http\Controllers\UserController')->index();
        }else{
            $check = 'false';
            Session::put('login', $check );
            Session::save();
            return redirect('/')->with('error', 'Błąd logowania.');
        }

        /*$credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if(Auth::attempt($credentials)){
            //return view('panel.mainPanel');
        }*/
    }

    public function logout(){
        Session::forget('login');
        return redirect('/')->with('success', 'Poprawnie wylogowano.');
    }
}
