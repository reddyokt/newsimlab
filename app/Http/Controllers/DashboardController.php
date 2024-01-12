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

        } else if ($role == "PDA1") {
        } else if ($role == "MWA1") {
        } else if ($role == "MWA1") {
        } else if ($role == "PWA2") {
        } else if ($role == "PDA2") {
        } else if ($role == "PDA2") {
        } else if ($role == "MDA2") {

        } else {
            return view('authentication.login')->with('error', 'Kamu tidak bisa akses');
        }

        return view('dashboard.index', compact('list'));
    }
}
