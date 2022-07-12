<?php

namespace App\Http\Controllers;

use App\Models\MyUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function index(){
        $users = MyUser::all();
        return view('panel.mainPanel', compact('users'));
    }

    public function create(){
        return view('panel.createPanel');
    }

    public function store(Request $request){
        $user = new MyUser();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = $request->input('password');
        $user->save();
        return redirect('/create')->with('success','Dodano nowego użytkownika.');
    }

    public function destroy($id){
        $user = MyUser::find($id);
        $user->delete();
        return redirect('/main')->with('success','Usunieto użytkownika.');
    }

    public function edit($id){
        return view('panel.updatePanel', compact('id'));
    }

    public function update(Request $request, MyUser $myUser){
        $request->validate([
            'email' => 'email'
        ]);
        $myUser->update($request->all());

        return redirect('/main')->with('success', 'Zaktualizowano użytkownika.');
    }
}
