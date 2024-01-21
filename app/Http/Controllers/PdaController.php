<?php

namespace App\Http\Controllers;

use App\Models\Pda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class PdaController extends Controller
{
    public function pdaIndex()
    {
        $pdaindex = Pda::leftJoin('regencies', 'regencies.id', '=', 'pda.regencies_id')
        ->whereNull('pda.deleted_at')
        ->select(DB::raw('pda.pda_id, pda.pda_name, regencies.name, pda.address'))
        ->get()->toArray();


    foreach ($pdaindex as $key => $value) {
        $pdaindex[$key]['nomor'] = $key + 1;
    }

    return view('auth.masterdata.pda.pdaindex', compact('pdaindex'));
    }

    public function createPda()
    {
        $regencies = DB::table('regencies')
        ->get()->toArray();

        return view('auth.masterdata.pda.createpda', compact('regencies'));

    }

    public function storeCreatePda(Request $request)
    {
        // dd ($request);

        $storecreatepda = $request->validate([
            'name' => 'required',
            'regencies' => 'required',
        ]);

        $storecreatepda['pda_name'] = $request->name;
        $storecreatepda['regencies_id'] = $request->regencies;
        $storecreatepda['address'] = $request->address;
        $storecreatepda['created_by'] = $request->id;

        Pda::create($storecreatepda);

        return redirect('/pda')->with('success', 'Alhamdulillah, data PDA berhasil dibuat');
    }
}
