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
        if(!Auth::user()->user_rol === "superAdmin"){
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
