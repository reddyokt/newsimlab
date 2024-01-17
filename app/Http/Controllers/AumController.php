<?php

namespace App\Http\Controllers;

use App\Models\Aum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AumController extends Controller
{
    public function aumindex()
    {
        $aumindex = DB::table('aum')
                    ->leftJoin('bidangusaha', 'bidangusaha.id_bidangusaha', '=' ,'aum.id_bidangusaha')
                    ->leftJoin('kepemilikan', 'kepemilikan.id_kepemilikan', '=' ,'aum.id_kepemilikan')
                    ->leftJoin('ranting', 'ranting.ranting_id' ,'=' ,'aum.ranting_id' )
                    ->leftJoin('pca', 'pca.pca_id' ,'=' ,'aum.pca_id' )
                    ->leftJoin('pda', 'pda.pda_id' ,'=' ,'aum.pda_id' )
                    ->whereNull('aum.deleted_at')
                    ->select(DB::raw('aum.id_aum, aum.isActive as status, aum.address, aum.aum_name as aum_name, 
                                    kepemilikan.name as kepemilikan_name, bidangusaha.name as bidangusaha,
                                    ranting.ranting_name, pca.pca_name, pda.pda_name, aum.ranting_id, aum.pca_id, aum.pda_id'))
                    ->get()->toArray();
        return view('auth.aum.aumindex', compact('aumindex'));
    }

    public function createaum()
    {
        $kepemilikan = DB::table('kepemilikan')
                        ->whereNull('deleted_at')
                        ->get()->toArray();
        $bidangusaha = DB::table('bidangusaha')
                        ->where('isActive', 'Yes')
                        ->get()->toArray();
        return view('auth.aum.createaum', compact('kepemilikan','bidangusaha'));
    }

    public function storecreateaum(Request $request)
    {
        // dd($request);

        date_default_timezone_set('Asia/Jakarta');

        $storecreateaum = $request->validate([
            'name' => 'required',
            'bidangusaha' => 'required',
            'kepemilikan' => 'required',
        ]);

        $storecreateaum['aum_name'] = $request->name;
        $storecreateaum['id_bidangusaha'] = $request->bidangusaha;
        $storecreateaum['id_kepemilikan'] = $request->kepemilikan;
        $storecreateaum['address'] = $request->address;

        $storecreateaum['created_by'] = $request->id;
        $storecreateaum['pca_id'] = $request->pca;

        Aum::create($storecreateaum);

        return redirect('/aum')->with('success', 'Alhamdulillah, data AUM berhasil disimpan');
    }









    public function aumbyranting()
    {
        $rantings = DB::table('ranting')->get()->toArray();
        return response()->json($rantings);
    }

    public function aumbypca()
    {
        $pcas = DB::table('pca')->get()->toArray();
        return response()->json($pcas);
    }

    public function aumbypda()
    {
        $pdas = DB::table('pda')->get()->toArray();
        return response()->json($pdas);
    }
}
