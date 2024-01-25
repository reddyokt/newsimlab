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

        $totalKader = DB::table('kader_info')->where('status', 'valid')->count();
        $totalAUM = DB::table('aum')->where('isActive', 'Yes')->count();
        
        $totalPDAMember = $this->getTotalPDAMember();
        $totalPDAAum = $this->getTotalAum();

        $dataPdaList = DB::table('pda')
            ->where('deleted_at')
            ->orderBy('pda_id', 'asc')
            ->get()->toArray();

        $pdaList = [];
        foreach($dataPdaList as $k=>$v){
            $pdaList[$k] = $v->pda_name;
        }


        $allData= [
            'pdaList'=> json_encode($pdaList),
            'totalPDA' => json_encode($totalPDAMember),
            'totalKader' => json_encode($totalKader),
            'totalAum' => json_encode($totalAUM),
            'totalPDAAum' => json_encode($totalPDAAum)
        ];
        
        // dd($allData);

        return view('dashboard.index', compact('allData'));
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

    public function getTotalPDAMember()
    {
        $role = Session::get('role_code');

        $allData = DB::table("kader_info")
            ->join('pda','pda.pda_id','=','kader_info.pda_id')
            ->whereNull('kader_info.deleted_at')
            ->where('kader_info.status','valid')
            ->select(DB::raw('kader_info.pda_id, pda.pda_name as pda_name, COUNT(kader_id) as total'))
            ->orderBy('kader_info.pda_id')
            ->groupBy('kader_info.pda_id', 'pda_name');

        $allData = $allData->get()->toArray();

        $listPDA = DB::table('pda')
            ->whereNull('deleted_at')
            ->orderBy('pda_id', 'asc')
            ->get()->toArray();
        
        $listData = array();
        foreach($listPDA as $k=>$v){
            $listData[$v->pda_name] = 0;
        }

        foreach($allData as $key => $val) {
            $listData[$val->pda_name] = $val->total;
        }

        return $listData;
    }

    public function getTotalAum()
    {
        $role = Session::get('role_code');

        $allData = DB::table('aum')
        ->join('pda','pda.pda_id','=','aum.pda_id')
        ->whereNull('aum.deleted_at')
        ->where('aum.isActive','Yes')
        ->select(DB::raw('aum.pda_id, pda.pda_name as pda_name, COUNT(id_aum) as total'))
        ->orderBy('aum.pda_id')
        ->groupBy('aum.pda_id', 'pda_name');

        $allData = $allData->get()->toArray();

        $listPDA = DB::table('pda')
            ->whereNull('deleted_at')
            ->orderBy('pda_id', 'asc')
            ->get()->toArray();
        
        $listData = array();
        foreach($listPDA as $k=>$v){
            $listData[$v->pda_name] = 0;
        }

        foreach($allData as $key => $val) {
            $listData[$val->pda_name] = $val->total;
        }

        return $listData;

    }
}
