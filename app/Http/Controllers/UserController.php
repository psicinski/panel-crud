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
// podstawowe wartości do klasy User możesz w tablicy przekazać do konstruktora - ogólnie nie jest za bezpieczne pozostawianie getterów, które przeważnie z poziomu public się ustawia. kolejnym zagadnieniem jest to, że pozostawiając gettery możesz podczas pracy z modelem zmieniać stan obiektu, a tego nie powinno się praktykować.
    /**
        przykład 
        $user = new User(['name' => 'john', 'lastName' => 'Smith', 'email' => 'johnsmith@mail.com]', 'password' => 'Qw3r()*&#$!hfsj0-1assSD2%'); 
        wtedy od razu przekazujesz do konstruktora i w nim już możesz z góry zdefiniować przypisywanie - oraz usunąć wtedy gettery.
    **/
    public function store(Request $request){
        $user = new MyUser(); // tutaj zdecydowanie lepiej użyć wbudowanej funkcji User 
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = $request->input('password');
        $user->save();
        return redirect('/create')->with('success','Dodano nowego użytkownika.');
    }
// tutaj dobrze byłoby dodać weryfikację czy instnieje user w ogóle wykorzystaj np. firstOrFail();
    public function destroy($id){
        $user = MyUser::find($id); // j.w
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
