<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardsController extends Controller
{
    public function index(){
        if(Auth::user()->hasRole('superadmin')){
            return view('superadmin.superadmindashboard');
        }elseif(Auth::user()->hasRole('admin')){
            return view('admin.admindashboard');
        }elseif(Auth::user()->hasRole('manager')){
            return view('manager.managerdashboard');
        }else{
            return view('user.userdashboard');
        }
    }
}
