<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuperAdminController extends Controller
{

    public function index(){
        if(!Auth::user()->user_rol === "superAdmin"){
            return redirect()->back();
        }
        $users = User::all();
        return view('admin.superAdmin', compact('users'));
    }

    public function updateRole($user_id, Request $request){
        // dd(Auth::user()->id == $user_id) ;
        if(!Auth::user()->user_rol === "superAdmin"){ // valida que solo lo haga el admin
            return redirect()->back();
        }
        if(Auth::user()->id == $user_id){
            // valida que no pueda cambiar su propio rol
            return redirect()->back();
        }
        $request->validate([
            'user_rol' => 'required|string|max:10',
        ]);
        $user= User::where('id',$user_id)->first();
        $user->user_rol = $request->user_rol;
        $user->save();
        return redirect()->back()->with('success', 'Rol asignado con éxito.');
    }
}
