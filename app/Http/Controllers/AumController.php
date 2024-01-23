<?php

namespace App\Http\Controllers;

use App\Models\Aum;
use App\Models\AumImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class AumController extends Controller
{
    public function aumIndex()
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

    public function createAum()
    {
        $kepemilikan = DB::table('kepemilikan')
                        ->whereNull('deleted_at')
                        ->get()->toArray();
        $bidangusaha = DB::table('bidangusaha')
                        ->where('isActive', 'Yes')
                        ->get()->toArray();
        return view('auth.aum.createaum', compact('kepemilikan','bidangusaha'));
    }

    public function storeCreateAum(Request $request)
    {
        // dd($request);

        // $req = $request->all();

        date_default_timezone_set('Asia/Jakarta');
        $aum = new Aum;
        $aum->ranting_id = $request->ranting;
        $aum->pca_id= $request->pca;
        $aum->pda_id = $request->pda;
        $aum->id_kepemilikan = $request->kepemilikan;
        $aum->id_bidangusaha = $request->bidangusaha;
        $aum->aum_name = $request->name;
        $aum->address = $request->address;
        $aum->created_by = $request->id;
        $aum->save();

        $namafile = str_replace(' ', '_', $request->name);

        $files = [];
        if($request->hasfile('images'))
         {
            foreach($request->file('images') as $key => $file)
            {
                $name = $namafile.time().rand(1,50).'.'.$file->extension();
                $file->move(public_path('upload/aum'), $name);
                $files[] = $name;
            }
         }

         $file= new AumImage;
         $file->id_aum = $aum->id_aum;
         $file->images = json_encode($files);
         $file->created_by = $request->created_by;
         $file->save();

        return redirect('/aum')->with('success', 'Alhamdulillah, data AUM berhasil disimpan');
    }



    public function aumByRanting()
    {
        $rantings = DB::table('ranting')->get()->toArray();
        return response()->json($rantings);
    }

    public function aumByPca()
    {
        $pcas = DB::table('pca')->get()->toArray();
        return response()->json($pcas);
    }

    public function aumByPda()
    {
        $pdas = DB::table('pda')->get()->toArray();
        return response()->json($pdas);
    }
}
