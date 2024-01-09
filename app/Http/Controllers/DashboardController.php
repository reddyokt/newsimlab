<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function index()
    {
        //role
        $role = Session::get('role_code');
        $list = [];
        
        if ($role == "SUP" || $role == "PWA1") {

        } else if ($role == "PWA2") {

        } else if ($role == "MWA1") {

        } else {
            return view('authentication.login')->with("your user can't be access");
        }

        return view('dashboard.index', compact('list'));
    }
}
