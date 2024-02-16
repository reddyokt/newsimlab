<?php

namespace App\Http\Controllers;

use App\Models\NilaiUjian;
use App\Models\PenilaianLisan;
use App\Models\Ujian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;


class UjianController extends Controller
{
    public function createUjian($id)
    {
        $ujian = Ujian::find($id);

        return view('ujian.createujian', compact('ujian'));
    }

    public function storeUjian(Request $request, $id)
    {
  
        date_default_timezone_set('Asia/Jakarta');
        $req = $request->all();

        $matkul = str_replace(' ', '_', $req['matkul']);
        $periode = str_replace('/', '_', $req['periode']);
        $idk = DB::table('ujian')->where('id_ujian', $id)->first();
        $idkel = $idk->id_kelas;

        $dataMhs = DB::table('mahasiswa_kelas')->where('mahasiswa_kelas.id_kelas', $idkel)->select(DB::raw('mahasiswa_kelas.id_mahasiswa_kelas'))->get()->toArray();

        if ($dataMhs == []) {
            return redirect()->back()->with('error', 'Tidak bisa membuat ujian, mahasiswa tidak tersedia!');
        }

        $allmhs = [];
        foreach ($dataMhs as $k => $v) {
            $allmhs[$k] = $v->id_mahasiswa_kelas;
        }

        if ($request->file('ujian_file')) {

            $extension = $request->file('ujian_file')->getClientOriginalExtension();
            $pp = 'ujian' . '_' . $request->jenis . '_' . $request->kelas . '_' . $matkul . '_' . $periode . '.' . $extension;
            $dataImage = $request->file('ujian_file')->get();
            File::put(public_path('upload/ujian/' . $pp), $dataImage);
        }

        Ujian::find($id)->update([

            'uraian_ujian' => $req['body'],
            'file_ujian' => $pp,
            'status' => 'waiting',
        ]);

        foreach ($allmhs as $key => $mhs) {
            $mhsuji = new NilaiUjian();
            $mhsuji->id_kelas = $req['id_kelas'];
            $mhsuji->id_ujian = $req['id_ujian'];
            $mhsuji->id_periode = $req['id_periode'];
            $mhsuji->id_mahasiswa_kelas = $mhs;
            $mhsuji->jenis = $req['jenis'];
            $mhsuji->save();
        }

        foreach ($allmhs as $key => $mhs) {
            $mhslisan = new PenilaianLisan();
            $mhslisan->id_kelas = $req['id_kelas'];
            $mhslisan->id_periode = $req['id_periode'];
            $mhslisan->id_mahasiswa_kelas = $mhs;
            $mhslisan->created_by = Session::get('username');
            $mhslisan->save();
        }

        return redirect()->to('kelas/detail/' . $request->id_kelas)->with('success', 'Alhamdulillah Ujian berhasil dibuat');
    }

    public function detailUjian($id)
    {
        $role = Session::get('role_code');

        $detailujian = Ujian::find($id);

        return view('ujian.detailujian', compact('detailujian', 'role'));
    }
}
