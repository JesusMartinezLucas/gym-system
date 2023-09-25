<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class AuthManager extends Controller
{
    function login(){
        if(Auth::check()){
            return redirect(route('appointments.index'));
        }

        return view('login');
    }

    function registration(){
        if(Auth::check()){
            return redirect(route('appointments.index'));
        }

        return view('registration');
    }

    function loginPost(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');
        if(Auth::attempt($credentials)){
            return redirect()->intended(route('appointments.index'));
        }
        return redirect(route('login'))->with("error", "Credenciales no válidas");
    }

    function registrationPost(Request $request){
        $request->validate([
            'name' => 'required',
            'last_name' => 'required',
            'age' => 'required|numeric',
            'gender' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ]);

        $data['name'] = $request->name;
        $data['last_name'] = $request->last_name;
        $data['age'] = $request->age;
        $data['gender'] = $request->gender;
        $data['email'] = $request->email;
        $data['password'] = Hash::make($request->password);

        //dd($data);

        $user = User::create($data);
       
        if(!$user){
            return redirect(route('registration'))->with("error", "Error al registrar.");
        }
        return redirect(route('login'))->with("success", "Usuario creado.");
    }

    function edit(){
        if(!Auth::check()){
            return redirect(route('login'));
        }

        return view('edit', ['user' => Auth::user()]);
    }

    function update(Request $request){
        $id = Auth::user()->id;
        $request->validate([
            'name' => 'required',
            'last_name' => 'required',
            'age' => 'required|numeric',
            'gender' => 'required',
            'email' => 'required|email|unique:users,email,'.$id
        ]);

        $user = User::find($id);
        $user->name = $request->name;
        $user->last_name = $request->last_name;
        $user->age = $request->age;
        $user->gender = $request->gender;
        $user->email = $request->email;
        if($request->password)
            $user->password = Hash::make($request->password);

        $user->save();
       
        if(!$user){
            return redirect(route('edit'))->with("error", "Error al actualizar.");
        }
        return redirect(route('appointments.index'))->with("success", "Usuario actualizado.");
    }

    function logout(){
        Session::flush();
        Auth::logout();
        return redirect(route('login'));
    }
}
