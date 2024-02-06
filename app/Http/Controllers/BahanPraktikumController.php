<?php

namespace App\Http\Controllers;

use App\Models\BahanPraktikum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;

class BahanPraktikumController extends Controller
{
    public functiOn bahanIndex()
    {
        $bahan = DB::table('bahan')->whereNull('bahan.deleted_at')
        ->leftJoin('lemari', 'lemari.id_lemari', '=' ,'bahan.id_lemari')
        ->leftJoin('lokasi', 'lokasi.id_lokasi', '=' ,'lemari.id_lokasi')
        ->select(DB::raw('bahan.id_bahan, bahan.nama_bahan as nama,
                            bahan.rumus as rumus, bahan.jumlah as jumlah,
                            lemari.nama_lemari as lemari, lokasi.nama_lokasi as lokasi,
                            bahan.images as images'))
        ->get()->toArray();

        return view('inventory.bahan.indexbahan', compact('bahan'));
    }

    public function createBahan()
    {
        $lemari = DB::table('lemari')->leftJoin('lokasi', 'lokasi.id_lokasi' ,'=', 'lemari.id_lokasi')
        ->select(DB::raw('lemari.id_lemari as id_lemari, lemari.nama_lemari as nama_lemari,
                            lokasi.nama_lokasi as nama_lokasi'))
        ->get()->toArray();

return view('inventory.bahan.createbahan', compact('lemari'));
    }

    public function storeBahan(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        $req = $request->all();

        $waktu = Carbon::now()->format('YmdHis');
        $creatorid = Session::get('user_id');

        if ($request->file('images')) {
            $namafile = str_replace(' ', '_', $request->name);
            $extension = $request->file('images')->getClientOriginalExtension();
            $pp = 'images'. '-' .$namafile. '-' . $waktu . '.' . $extension;
            $dataImage = $request->file('images')->get();
            File::put(public_path('upload/inventory/bahan/' . $pp), $dataImage);
        }

        $storebahan = new BahanPraktikum();
        $storebahan->nama_bahan = $req['name'];
        $storebahan->rumus = $req['rumus'];
        $storebahan->jumlah = $req['jumlah'];
        $storebahan->id_lemari = $req['lemari_id'];
        $storebahan->images = $pp;
        $storebahan->created_by = $creatorid;
        $storebahan->save();

        return redirect('/bahan')->with('success', 'alhamdulillah Data Alat berhasil dibuat');
    }
}
