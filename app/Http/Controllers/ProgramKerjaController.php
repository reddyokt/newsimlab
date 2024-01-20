<?php

namespace App\Http\Controllers;

use App\Models\Periode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class ProgramKerjaController extends Controller
{
    public function periodeindex()
    {
        $periodeindex = DB::table('periode')->get()->toArray();
        
        return view('auth.proker.periodeindex', compact('periodeindex'));
    }

    public function createperiode ()
    {
      return view('auth.proker.createperiode');
    }
    public function storecreateperiode (Request $request)
    {
        // dd($request);

        $periode = new Periode;

        $periode->from = \DateTime::createFromFormat('m/d/Y', $request->from);
        $periode->to = \DateTime::createFromFormat('m/d/Y', $request->to);
        $periode->description = $request->description;

        $periode->save();

        return redirect('/periode')->with('success', 'Alhamdulillah Periode berhasil dibuat');
        
    
    }
    public function prokerindex()
    {
        $prokerindex = DB::table('proker')
        ->leftJoin('periode', 'periode.id_periode', '=' ,'proker.id_periode')
        ->leftJoin('user', 'user.user_id', '=' ,'proker.created_by')
        ->leftJoin('pda', 'pda.pda_id', '=' ,'user.pda_id')
        ->whereNull('proker.deleted_at')
        ->select(DB::raw('proker.id_proker as id_proker, proker.proker_name as name, 
            proker.prokerstart as start, proker.prokerend as end, proker.status as status,
            proker.anggaran as anggaran, user.name as username, pda.pda_name as pda_name'))
        ->get()->toArray();

        return view('auth.proker.prokerindex', compact('prokerindex'));
    }

    public function createproker()
    {

        $periode = DB::table('periode')->where('periode.isActive', 'Yes')->first();
        
        $datestart = Carbon::parse($periode->from)->locale('id');
        $datestart->settings(['formatFunction' => 'translatedFormat']);

        $dateend = Carbon::parse($periode->to   )->locale('id');
        $dateend->settings(['formatFunction' => 'translatedFormat']);

        return view('auth.proker.createproker', compact('periode','datestart', 'dateend'));
    }
}
