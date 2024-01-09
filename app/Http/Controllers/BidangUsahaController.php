<?php

namespace App\Http\Controllers;

use App\Models\BidangUsaha;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BidangUsahaController extends Controller
{
    public function bidangusahaindex()
    {
        $bidangusahaindex = DB::table('bidangusaha')
            ->where('isActive', 'Yes')
            ->get();

        return view('auth.masterdata.bidangusaha.bidangusahaindex', compact('bidangusahaindex'));
    }

    public function createbidangusaha()
    {
        return view('auth.masterdata.bidangusaha.createbidangusaha');
    }

    public function storecreatebidangusaha(Request $request)
    {
        // dd($request);
        $storecreatebidangusaha = $request->validate([
            'name' => 'required',
            'description' => 'required'
        ]);

        $storecreatebidangusaha['name'] = $request->name;
        $storecreatebidangusaha['description'] = $request->description;

        BidangUsaha::create($storecreatebidangusaha);
        return redirect('/bidangusaha')->with('success', 'Alhamdulillah data Bidang Usaha berhasil dibuat');
    }
}
