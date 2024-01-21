<?php

namespace App\Http\Controllers;

use App\Models\Majelis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MajelisController extends Controller
{
    public function majelisIndex()
    {
        $majelisindex = DB::table('majelis')
                        ->where('isActive', 'Yes')
                        ->get();

        return view ('auth.masterdata.majelis.majelisindex', compact('majelisindex'));
    }

    public function createMajelis()
    {
        return view('auth.masterdata.majelis.createmajelis');
    }

    public function storeCreateMajelis(Request $request)
    {
        // dd($request);
        $storecreatemajelis = $request->validate([
            'name' => 'required',
            'code' => 'required',
            'type' => 'required',
            'description' => 'required',
        ]);

        $storecreatemajelis['name'] = $request->name;
        $storecreatemajelis['code'] = $request->code;
        $storecreatemajelis['type'] = $request->type;
        $storecreatemajelis['description'] = $request->description;
        // $storecreatemajelis['created_by'] = $request->id;

        Majelis::create($storecreatemajelis);
        return redirect('/majelis')->with('success', 'Alhamdulillah data Majelis/Lembaga berhasil dibuat');
    }
}
