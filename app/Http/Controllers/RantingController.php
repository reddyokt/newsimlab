<?php

namespace App\Http\Controllers;

use App\Models\Ranting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RantingController extends Controller
{
    public function rantingIndex()
    {
        $rantingindex = Ranting::leftJoin('pca', 'pca.pca_id', '=' , 'ranting.pca_id')
        ->leftJoin('pda', 'pda.pda_id', '=' , 'pca.pda_id')
        ->leftJoin('villages', 'villages.id', '=', 'ranting.villages_id')
        ->whereNull('ranting.deleted_at')
        ->select(DB::raw('ranting.ranting_id, ranting.ranting_name,
                          villages.name, ranting.address as ranting_address, pca.pca_id as pca_id,
                          pca.pca_name as pca_name, pda.pda_name as pda_name, villages.name as villages'))
        ->get()->toArray();


    foreach ($rantingindex as $key => $value) {
        $rantingindex[$key]['nomor'] = $key + 1;
    }

    return view('auth.masterdata.ranting.rantingindex', compact('rantingindex'));
    }

    public function createRanting()
    {
        $villages = DB::table('villages')
            ->get()->toArray();
        $pca = DB::table('pca')
            ->whereNull('pca.deleted_at')
            ->get()->toArray();

        return view('auth.masterdata.ranting.createranting', compact('villages','pca'));

    }

    public function storeCreateRanting(Request $request)
    {
        // dd ($request);

        $storecreateranting = $request->validate([
            'name' => 'required',
            'villages' => 'required',
            'pca' => 'required',
        ]);

        $storecreateranting['ranting_name'] = $request->name;
        $storecreateranting['villages_id'] = $request->villages;
        $storecreateranting['address'] = $request->address;
        $storecreateranting['created_by'] = $request->id;
        $storecreateranting['pca_id'] = $request->pca;

        Ranting::create($storecreateranting);

        return redirect('/ranting')->with('success', 'Alhamdulillah, data Ranting berhasil dibuat');
    }
}
