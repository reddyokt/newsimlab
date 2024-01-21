<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // dd(Session::get('menu'));

        //role
        $role = Session::get('role_code');
        $pda_id = Session::get('pda_id');
        $list = [];

        if ($role == "SUP" || $role == "PWA1") {

        } else if ($role == "PDA1") {
        } else if ($role == "MWA1") {
        } else if ($role == "MDA1") {
        } else if ($role == "PWA2") {
        } else if ($role == "PDA2") {
        } else if ($role == "MWA2") {
        } else if ($role == "MDA2") {

        } else {
            return view('authentication.login')->with('error', 'Kamu tidak bisa akses');
        }

        return view('dashboard.index', compact('list'));
    }

    function setRole($id){
        //fetch menu code
        $menu = DB::select("
            SELECT code
            FROM menu
            LEFT JOIN role_menu rm ON rm.menu_id = menu.menu_id
            LEFT JOIN user_role ur ON ur.role_id = rm.role_id WHERE ur.user_id = ".Session::get('user_id')." AND ur.role_id = ".$id." AND menu.deleted_at IS NULL");
        $m = array();
        foreach($menu as $mn){
            $m[] = $mn->code;
        }

        $role_current = DB::table('user_role')
            ->join('roles','roles.id','=','user_role.role_id')
            ->where('user_id', Session::get('user_id'))
            ->where('roles.id', $id)
            ->select(DB::raw('roles.id, roles.CODE, roles.role_name'))
            ->first();

        $role_other = DB::table('user_role')
            ->join('roles','roles.id','=','user_role.role_id')
            ->where('user_id', Session::get('user_id'))
            ->where('roles.id', '<>', $id)
            ->select(DB::raw('roles.id, roles.CODE, roles.role_name'))
            ->first();
        
        Session::put('menu',$m);
        Session::put('role_other', $role_other);
        Session::put('role_id', $role_current->role_id);
        Session::put('role_name', $role_current->role_name);
        Session::put('role_code', $role_current->CODE);
        
        return response()->json(['status'=>true,'message'=>'Success']);
    }
}
