<?php

namespace App\Http\Controllers;

use App\Models\Lemari;
use App\Models\Lokasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LokasiController extends Controller
{
    public function lokasiIndex() 
    {
        $lokasi = Lokasi::all();
        $lokasiss = Lokasi::all();

        $lokasis = DB::table('lokasi')->whereNull('deleted_at')->get()->toArray();

      return view('inventory.lokasi.indexlokasi', compact('lokasi', 'lokasis', 'lokasiss'));    
    }

    public function createLokasi(Request $request)
    {
        $lokasi = new Lokasi();
        $lokasi->nama_lokasi = $request->lokasi;
        $lokasi->save();

        return redirect()->back()->with('success', 'Lokasi baru berhasil dibuat');

    }

    public function createLemari(Request $request)
    {
        $lemari = new Lemari();
        $lemari->id_lokasi = $request->id_lokasi;
        $lemari->nama_lemari = $request->lemari;
        $lemari->save();

        return redirect()->back()->with('success', 'Lemari baru berhasil dibuat');
    }
}
