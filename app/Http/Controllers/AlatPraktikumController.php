<?php

namespace App\Http\Controllers;

use App\Models\AlatPraktikum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;

class AlatPraktikumController extends Controller
{
    public function alatIndex()
    {
        $alat = DB::table('alat')->whereNull('alat.deleted_at')
                    ->leftJoin('lemari', 'lemari.id_lemari', '=' ,'alat.id_lemari')
                    ->leftJoin('lokasi', 'lokasi.id_lokasi', '=' ,'lemari.id_lokasi')
                    ->select(DB::raw('alat.id_alat, alat.jenis as jenis, alat.nama_alat as nama,
                                        alat.merk_alat as merk, alat.ukuran_alat as ukuran,
                                        alat.jumlah as jumlah, alat.baris as baris, alat.kolom as kolom,
                                        lemari.nama_lemari as lemari, lokasi.nama_lokasi as lokasi,
                                        alat.images as images'))
                    ->get()->toArray();
        return view('inventory.alat.indexalat', compact('alat'));
    }

    public function createAlat()
    {
        $lemari = DB::table('lemari')->leftJoin('lokasi', 'lokasi.id_lokasi' ,'=', 'lemari.id_lokasi')
                    ->select(DB::raw('lemari.id_lemari as id_lemari, lemari.nama_lemari as nama_lemari,
                                        lokasi.nama_lokasi as nama_lokasi'))
                    ->get()->toArray();

        return view('inventory.alat.createalat', compact('lemari'));
    }

    public function storeAlat(Request $request)
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
            File::put(public_path('upload/inventory/alat/' . $pp), $dataImage);
        }

        $storealat = new AlatPraktikum();
        $storealat->nama_alat = $req['name'];
        $storealat->merk_alat = $req['merk'];
        $storealat->ukuran_alat = $req['ukuran'];
        $storealat->jumlah = $req['jumlah'];
        $storealat->id_lemari = $req['lemari_id'];
        $storealat->baris = $req['baris'];
        $storealat->kolom = $req['kolom'];
        $storealat->images = $pp;
        $storealat->created_by = $creatorid;
        $storealat->save();

        return redirect('/alat')->with('success', 'alhamdulillah Data Alat berhasil dibuat');
    }
}
