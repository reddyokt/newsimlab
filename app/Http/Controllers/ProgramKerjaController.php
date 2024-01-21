<?php

namespace App\Http\Controllers;

use App\Models\Periode;
use App\Models\ProgramKerja;
use App\Models\ProkerDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;

class ProgramKerjaController extends Controller
{
    public function periodeIndex()
    {
        $periodeindex = DB::table('periode')->get()->toArray();
        
        return view('auth.proker.periodeindex', compact('periodeindex'));
    }

    public function createPeriode ()
    {
      return view('auth.proker.createperiode');
    }
    public function storeCreatePeriode (Request $request)
    {
        // dd($request);

        $periode = new Periode;

        $periode->from = \DateTime::createFromFormat('m/d/Y', $request->from);
        $periode->to = \DateTime::createFromFormat('m/d/Y', $request->to);
        $periode->description = $request->description;

        $periode->save();

        return redirect('/periode')->with('success', 'Alhamdulillah Periode berhasil dibuat');
        
    
    }
    public function prokerIndex()
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

    public function createProker()
    {

        $periode = DB::table('periode')->where('periode.isActive', 'Yes')->first();
        
        $datestart = Carbon::parse($periode->from)->locale('id');
        $datestart->settings(['formatFunction' => 'translatedFormat']);

        $dateend = Carbon::parse($periode->to   )->locale('id');
        $dateend->settings(['formatFunction' => 'translatedFormat']);

        return view('auth.proker.createproker', compact('periode','datestart', 'dateend'));
    }

    public function storeCreateProker(Request $request)
    {
        // dd (Session::get('pda_id'));
        date_default_timezone_set('Asia/Jakarta');

        // $dataImage = $request->file('image');
        $req = $request->all();

        $proker = new ProgramKerja;
        $proker->id_periode = $req['periode'];
        $proker->proker_name = $req['prokername'];
        $proker->prokerstart = \DateTime::createFromFormat('m/d/Y', $req['from']);
        $proker->prokerend = \DateTime::createFromFormat('m/d/Y', $req['to']);
        $proker->anggaran = $req['anggaran'];
        // $proker->anggaran = str_replace(',', '', $req['anggaran']);
        $proker->created_by = Session::get('user_id');
        $proker->description = $req['description'];
        $proker->pda_id = Session::get('pda_id');
        $proker->save();


        $proker_detail = new ProkerDetail;
        $proker_detail->id_proker = $proker->id_proker;
        $proker_detail->initial = $req['initial'];
        $proker_detail->note_update = 'Program Kerja'.' '.$proker->proker_name.' '.'dimulai';
        $proker_detail->created_by = Session::get('user_id');
        $proker_detail->save();

        return redirect('/proker')->with('success', 'alhamdulillah Program Kerja berhasil disimpan.');
    }

    public function prokerDetail($id)
    {
        $proker = DB::table('proker')
                    ->leftJoin('prokerdetail', 'prokerdetail.id_proker', '=' ,'proker.id_proker')
                    ->leftJoin('pda', 'pda.pda_id', '=' ,'proker.pda_id')
                    ->where('proker.id_proker', $id)
                    ->whereNull('proker.deleted_at')
                    ->select(DB::raw('proker.id_proker, proker.proker_name, proker.anggaran, proker.description, 
                                        proker.status, proker.prokerstart, proker.prokerend, 
                                        prokerdetail.created_at as created_at, pda.pda_name as pda_name'))
                    ->first();
        $prokerdetail = DB::table('prokerdetail')
                    ->where('prokerdetail.id_proker', $id)
                    ->get()->toArray();

        return view('auth.proker.prokerdetail', compact('proker','prokerdetail'));
    }
}
