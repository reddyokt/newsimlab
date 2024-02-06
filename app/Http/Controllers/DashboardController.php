<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use SebastianBergmann\Type\NullType;

class DashboardController extends Controller
{
    public function index()
    {
        $role = Session::get('role_code');
        $pdaID = Session::get('pda_id');

        

        return view('dashboard.index');
    }

    function setRole($id)
    {
        //fetch menu code
        $menu = DB::select("
            SELECT code
            FROM menu
            LEFT JOIN role_menu rm ON rm.menu_id = menu.menu_id
            LEFT JOIN user_role ur ON ur.role_id = rm.role_id WHERE ur.user_id = " . Session::get('user_id') . " AND ur.role_id = " . $id . " AND menu.deleted_at IS NULL");
        $m = array();
        foreach ($menu as $mn) {
            $m[] = $mn->code;
        }

        $role_current = DB::table('user_role')
            ->join('roles', 'roles.id', '=', 'user_role.role_id')
            ->where('user_id', Session::get('user_id'))
            ->where('roles.id', $id)
            ->select(DB::raw('roles.id, roles.CODE, roles.role_name'))
            ->first();

        $role_other = DB::table('user_role')
            ->join('roles', 'roles.id', '=', 'user_role.role_id')
            ->where('user_id', Session::get('user_id'))
            ->where('roles.id', '<>', $id)
            ->select(DB::raw('roles.id, roles.CODE, roles.role_name'))
            ->first();

        Session::put('menu', $m);
        Session::put('role_other', $role_other);
        Session::put('role_id', $role_current->role_id);
        Session::put('role_name', $role_current->role_name);
        Session::put('role_code', $role_current->CODE);

        return response()->json(['status' => true, 'message' => 'Success']);
    }

    public function getTotalPDAMember()
    {
        $role = Session::get('role_code');
        $pdaID = Session::get('pda_id');

        $allData = DB::table("kader_info")
            ->join('pda', 'pda.pda_id', '=', 'kader_info.pda_id')
            ->whereNull('kader_info.deleted_at')
            ->where('kader_info.status', 'valid')
            ->select(DB::raw('kader_info.pda_id, pda.pda_name as pda_name, COUNT(kader_id) as total'))
            ->orderBy('kader_info.pda_id')
            ->groupBy('kader_info.pda_id', 'pda_name');

            if ($role == "SUP" || $role == "PWA1") {
                $allData = $allData->get()->toArray();
            } else if ($role == "PDA1" || $role == "PDA2") {
                $allData = $allData->where('kader_info.pda_id', $pdaID)->get()->toArray();
            }
    

        $listPDA = DB::table('pda')
            ->whereNull('deleted_at')
            ->orderBy('pda_id', 'asc')
            ->get()->toArray();

        $listData = array();
        foreach ($listPDA as $k => $v) {
            $listData[$v->pda_name] = 0;
        }

        foreach ($allData as $key => $val) {
            $listData[$val->pda_name] = $val->total;
        }

        return $listData;
    }

    public function getTotalAum()
    {
        $role = Session::get('role_code');
        $pdaID = Session::get('pda_id');

        $allData = DB::table('aum')
            ->join('pda', 'pda.pda_id', '=', 'aum.pda_id')
            ->whereNull('aum.deleted_at')
            ->where('aum.isActive', 'Yes')
            ->select(DB::raw('aum.pda_id, pda.pda_name as pda_name, COUNT(id_aum) as total'))
            ->orderBy('aum.pda_id')
            ->groupBy('aum.pda_id', 'pda_name');

            if ($role == "SUP" || $role == "PWA1") {
                $allData = $allData->get()->toArray();
            } else if ($role == "PDA1" || $role == "PDA2") {
                $allData = $allData->where('aum.pda_id', $pdaID)->get()->toArray();
            }
    

        $listPDA = DB::table('pda')
            ->whereNull('deleted_at')
            ->orderBy('pda_id', 'asc');
        
            if ($role == "SUP" || $role == "PWA1") {
                $listPDA = $listPDA->get()->toArray();
            } else if ($role == "PDA1" || $role == "PDA2") {
                $listPDA = $listPDA->where('pda_id', $pdaID)->get()->toArray();
            }
    

        $listData = array();
        foreach ($listPDA as $k => $v) {
            $listData[$v->pda_name] = 0;
        }

        foreach ($allData as $key => $val) {
            $listData[$val->pda_name] = $val->total;
        }

        return $listData;
    }

    public function getProker($periode)
    {
        $role = Session::get('role_code');
        $pdaID = Session::get('pda_id');

        $allData = DB::table("proker")
            ->leftJoin('periode', 'periode.id_periode', '=', 'proker.id_periode')
            ->where('periode.isActive', 'Yes')
            ->select(DB::raw('status, COUNT(status) as total'))
            ->groupBy("status");

        if ($role == "SUP" || $role == "PWA1") {
            $allData = $allData->get()->toArray();
        } else if ($role == "PDA1" || $role == "PDA2") {
            $allData = $allData->where('proker.pda_id', $pdaID)->get()->toArray();
        }

        $idx = 0;
        $realized = 0;
        $unrealized = 0;
        $onprogress = 0;
        foreach ($allData as $key => $val) {
            if ($val->status == 'realized') {
                $realized += $val->total;
            }
            if ($val->status == 'unrealized') {
                $unrealized += $val->total;
            }
            if ($val->status == 'validatedbypwa') {
                $onprogress += $val->total;
            }
        }
        $listData = array();
        $listData[0] = $realized;
        $listData[1] = $unrealized;
        $listData[2] = $onprogress;

        return $listData;
    }

    public function getProkerPDA()
    {
        $role = Session::get('role_code');
        $pdaID = Session::get('pda_id');

        $allData = DB::table("proker")
            ->join('pda', 'pda.pda_id', '=', 'proker.pda_id')
            ->leftJoin('periode', 'periode.id_periode', '=', 'proker.id_periode')
            ->where('periode.isActive', 'Yes')
            ->select(DB::raw('proker.pda_id, pda.pda_name as pda_name, COUNT(status) as total'))
            ->orderBy('proker.pda_id')
            ->groupBy("proker.pda_id", 'pda_name');

            if ($role == "SUP" || $role == "PWA1") {
                $allData = $allData->get()->toArray();
            } else if ($role == "PDA1" || $role == "PDA2") {
                $allData = $allData->where('proker.pda_id', $pdaID)->get()->toArray();
            }
    
        
        $listPDA = DB::table('pda')
            ->whereNull('deleted_at')
            ->orderBy('pda_id', 'asc')
            ->get()->toArray();

        $listData = array();
        foreach ($listPDA as $k => $v) {
            $listData[$v->pda_name] = 0;
        }

        foreach ($allData as $key => $val) {
            $listData[$val->pda_name] = $val->total;
        }

        return $listData;
    }
}
