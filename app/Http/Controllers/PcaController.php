<?php

namespace App\Http\Controllers;

use App\Models\Pca;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PCAController extends Controller
{
    public function pcaindex()
    {
        $pcaindex = Pca::leftJoin('pda', 'pda.pda_id', '=' ,'pca.pda_id')
                    ->leftJoin('districts', 'districts.id', '=', 'pca.district_id')
                    ->whereNull('pca.deleted_at')
                    ->select(DB::raw('pca.pca_id, pca.pca_name, districts.name, pca.address, pda.pda_name as pda_name'))
                    ->get()->toArray();


        foreach ($pcaindex as $key => $value) {
            $pcaindex[$key]['nomor'] = $key + 1;
        }

    return view('auth.masterdata.pca.pcaindex', compact('pcaindex'));
    }

    public function createpca()
    {
        $districts = DB::table('districts')
        ->get()->toArray();
        $pda = DB::table('pda')
        ->whereNull('pda.deleted_at')
        ->get()->toArray();

        return view('auth.masterdata.pca.createpca', compact('districts','pda'));

    }

    public function storecreatepca(Request $request)
    {
        // dd ($request);

        $storecreatepca = $request->validate([
            'name' => 'required',
            'districts' => 'required',
            'pda' => 'required',
        ]);

        $storecreatepca['pca_name'] = $request->name;
        $storecreatepca['district_id'] = $request->districts;
        $storecreatepca['address'] = $request->address;
        $storecreatepca['created_by'] = $request->id;
        $storecreatepca['pda_id'] = $request->pda;

        Pca::create($storecreatepca);

        return redirect('/pca')->with('success', 'Alhamdulillah, data PCA berhasil dibuat');
    }
}
