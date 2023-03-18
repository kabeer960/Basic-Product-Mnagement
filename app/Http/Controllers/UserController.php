<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role_User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function manageusers(){
        if(Auth::user()->hasRole('superadmin') || Auth::user()->hasRole('admin')){
            $data = User::all();
            return view('manageusers.manageusers', ['items' => $data]);
        }else{
            return redirect('home');
        }
    }

    public function get_userdata($uid){
        if(Auth::user()->hasRole('superadmin') || Auth::user()->hasRole('admin')){
            $data = User::with('role')->find($uid);
            foreach($data->role as $role){
                $rdata = $role->id; 
            }
            return response()->json([$data, $rdata]);
            
        }else{
            return redirect('home');
        }
    }

    public function user_edit_store(Request $req){
        if(Auth::user()->hasRole('superadmin') || Auth::user()->hasRole('admin')){
            $data = User::with('role')->find($req->id);
            $data->name = $req->name;
            $data->email = $req->email;
            foreach($data->role as $role){
                $data->detachRole($role->pivot->role_id);
            }
            $data->attachRole($req->role);
            $data->save();
            return response()->json($data);
            
        }else{
            return redirect('home');
        }
    }
}
