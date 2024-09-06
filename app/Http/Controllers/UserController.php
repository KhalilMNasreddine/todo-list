<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $incomingFields = $request->validate([
            'name' => ['required', 'min:3', 'max:10', Rule::unique('users', 'name')],
            'email' => ['required', 'email'],
            'password' => ['required', 'min:8'],
        ]);

        $incomingFields['password'] = bcrypt($incomingFields['password']);

        $user = User::create($incomingFields);

        auth()->login($user);

        return redirect('/todo');
    }
    public function logout(){
        auth()->logout();
        return redirect('/');
    }
    public function login(Request $request){
        $incomingFields=$request->validate([
            'lemail'=> 'required',
            'lpassword'=>'required'
        ]);
        if(auth()->attempt([
            'email'=>$incomingFields['lemail'],
            'password'=>$incomingFields['lpassword']
        ])){
            $request->session()->regenerate();
        }
        return redirect('/todo');
    }
}
