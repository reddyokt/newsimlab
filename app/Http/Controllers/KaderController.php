<?php

namespace App\Http\Controllers;

use App\Models\Kader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KaderController extends Controller
{
    public function kaderindex()
    {
        $kaderindex = Kader::leftjoin();

        return view('auth.masterdata.kader.kaderindex', compact('kaderindex'));

    }

    public function createkader()
    {
        $pda = DB::table('pda')
        ->whereNull('pda.deleted_at')
        ->get()->toArray();

        $pekerjaan = DB::table('pekerjaan')
        ->get()->toArray();

        return view('auth.masterdata.kader.createkader', compact('pda','pekerjaan'));
    }

    public function storekader(Request $request)
    {
        dd ($request);
    }


    public function PCAbyPDA($id) {
        $pca = DB::table('pca')->where("pda_id", $id)->whereNull('deleted_at')->get()->toArray();
        return response()->json($pca);
    }
}
