<?php

namespace App\Http\Controllers;

use App\Models\NilaiTugas;
use App\Models\Tugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use App\Models\Absen;
use App\Models\Kelas;
use App\Models\Mahasiswa;
use App\Models\MahasiswaKelas;
use App\Models\Matkul;
use App\Models\ModulKelas;
use App\Models\ModulPraktikum;
use App\Models\NilaiSubjektif;

class TugasController extends Controller
{
    public function createTugas($id)
    {
        $tugas = Tugas::find($id);
        return view('tugas.createtugas', compact('tugas'));
    }

    public function storeTugas(Request $request, $id)
    {
        // dd($request);

        date_default_timezone_set('Asia/Jakarta');
        $req = $request->all();

        $matkul = str_replace(' ', '_', $req['matkul']);
        $mods = str_replace(' ', '', $req['modul']);
        $periode = str_replace('/', '_', $req['periode']);

        $idk = DB::table('tugas')->where('id_tugas', $id)->first();
        $idkel = $idk->id_kelas;
        $dataMhs = DB::table('mahasiswa_kelas')->where('mahasiswa_kelas.id_kelas', $idkel)->select(DB::raw('mahasiswa_kelas.id_mahasiswa_kelas'))->get()->toArray();

        if ($dataMhs == []) {
            return redirect()->back()->with('error', 'Tidak bisa membuat tugas, mahasiswa tidak tersedia!');
        }

        $allmhs = [];
        foreach ($dataMhs as $k => $v) {
            $allmhs[$k] = $v->id_mahasiswa_kelas;
        }
        $pp = null;
        if ($request->file('tugas_file')) {

            $extension = $request->file('tugas_file')->getClientOriginalExtension();
            $pp = 'ujian' . '_' . $request->jenis . '_' . $request->kelas . '_' . $matkul . '_' . $mods . '_' . $periode . '.' . $extension;
            $dataImage = $request->file('tugas_file')->get();
            File::put(public_path('upload/tugas/' . $pp), $dataImage);
        }

        Tugas::find($id)->update([

            'uraian_tugas' => $req['body'],
            'file_tugas' => $pp,
            'status' => 'approved',
        ]);

        foreach ($allmhs as $key => $mhs) {
            $mhstugas = new NilaiTugas();
            $mhstugas->id_kelas = $req['id_kelas'];
            $mhstugas->id_modulkelas = $req['id_modulkelas'];
            $mhstugas->id_tugas = $req['id_tugas'];
            $mhstugas->id_periode = $req['id_periode'];
            $mhstugas->id_mahasiswa_kelas = $mhs;
            $mhstugas->jenis = $req['jenis'];
            $mhstugas->save();
        }

        if ($request->jenis == 'report') {
            foreach ($allmhs as $key => $mhs) {
                $mhssubject = new NilaiSubjektif();
                $mhssubject->id_kelas = $req['id_kelas'];
                $mhssubject->id_modulkelas = $req['id_modulkelas'];
                $mhssubject->id_periode = $req['id_periode'];
                $mhssubject->id_mahasiswa_kelas = $mhs;
                $mhssubject->save();
            }
        }

        return redirect()->to('kelas/detail/' . $request->id_kelas)->with('success', 'Alhamdulillah Tugas berhasil dibuat');
    }

    public function detailTugas($id)
    {
        $role = Session::get('role_code');

        $detailtugas = Tugas::find($id);

        return view('tugas.detailtugas', compact('detailtugas', 'role'));
    }

    public function validasiTugas(Request $request, $id)
    {
        Tugas::find($id)->update(['status' => 'approved']);

        $req = $request->all();
        $mhsabsen = DB::table('mahasiswa_kelas')->where('mahasiswa_kelas.id_kelas', $request->id_kelas)
            ->select(DB::raw('id_mahasiswa_kelas'))
            ->get();
        $checked = [];
        foreach ($mhsabsen as $k => $v) {
            $checked[$k] = $v->id_mahasiswa_kelas;
        }
        
        if ($request->jenis == 'pre_test') {
            foreach ($checked as $absen) {
                $absensi = new Absen();
                $absensi->id_mahasiswa_kelas = $absen;
                $absensi->id_modulkelas = $req['id_modulkelas'];
                $absensi->id_periode = $req['id_periode'];
                $absensi->id_kelas = $req['id_kelas'];
                $absensi->isAbsen = 0;
                $absensi->save();
            }
        }

        return redirect()->to('kelas/detail/' . $request->id_kelas)->with('success', 'Tugas telah di-approve');
    }

    public function detailTugasMhs($id)
    {
        $role = Session::get('role_code');
        $mhs = Mahasiswa::where('user_id', Session::get('user_id'))->first();
        $mhskelas = MahasiswaKelas::where('id_mahasiswa', $mhs->id_mahasiswa)->first();
        $kelas = Kelas::where('id_kelas', $mhskelas->id_kelas)->first();
        $matkul = Matkul::where('id_matkul', $kelas->id_matkul)->first();

        $detailtugas = Tugas::find($id);
        $modulkelas = ModulKelas::where('id_modulkelas', $detailtugas->id_modulkelas)->first();
        $modul = ModulPraktikum::where('id_modul', $modulkelas->id_modul)->first();
        $nilaitugas = NilaiTugas::where('jenis', $detailtugas->jenis)->where('id_mahasiswa_kelas', $mhskelas->id_mahasiswa_kelas)
            ->where('id_tugas', $id)->first();

        // dd($modul);



        return view('tugas.tugasformhs', compact('detailtugas', 'role', 'nilaitugas', 'matkul', 'modulkelas', 'modul'));
    }

    public function mhsJawabTugas(Request $request, $id)
    {

        // dd($request);

        date_default_timezone_set('Asia/Jakarta');
        $req = $request->all();

        $matkul = str_replace(' ', '_', $req['matkul']);
        $mods = str_replace(' ', '', $req['modul']);
        $periode = str_replace('/', '_', $req['periode']);

        $pp = null;

        if ($request->file('tugas_file')) {

            $extension = $request->file('tugas_file')->getClientOriginalExtension();
            $pp = 'Tugas' . '_' . Session::get('username') . '_' . $request->kelas . '_' . $matkul . '_' . $mods . '_' . $periode . '.' . $extension;
            $dataImage = $request->file('tugas_file')->get();
            File::put(public_path('upload/jawaban/tugas/' . $pp), $dataImage);
        }

        NilaiTugas::find($id)->update(['uraian_jawaban' => $request->body, 'file_jawaban' => $pp]);

        return redirect('/dashboard/index')->with('success', 'Jawaban berhasil diupload');
    }

    public function publishTugas($id)
    {
        Tugas::find($id)->update(['status'=>'used']);
        return redirect()->back()->with('success', 'tugas sudah di-publish');
    }

    public function takeDownTugas(Request $request, $id)
    {
        $id_tugas = $request->id_tugas;
        $id_kelas = $request->id_kelas;

        Tugas::find($id)->update(['status' => 'approved']);

        NilaiTugas::where('id_tugas', $id)->whereNull('nilai')->update(['nilai' => 0]);

        return redirect()->to('kelas/detail/' . $id_kelas)->with('warning', 'Tugas telah di-takedown');
    }
}
