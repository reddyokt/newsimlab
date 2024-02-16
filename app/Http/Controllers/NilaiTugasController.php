<?php

namespace App\Http\Controllers;

use App\Models\Aslab;
use App\Models\Dosen;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Mahasiswa;
use App\Models\MahasiswaKelas;
use App\Models\Matkul;
use App\Models\ModulKelas;
use App\Models\ModulPraktikum;
use App\Models\NilaiSubjektif;
use App\Models\NilaiTugas;
use App\Models\Periode;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class NilaiTugasController extends Controller
{
    public function nilaiTugas()
    {
        $role = Session::get('role_code');
        $periode = DB::table('periode')->where('periode.isActive', 'Yes')->first();

        if ($periode?->id_periode == Null) {
            $noperiode = '1';
        } else {
            $noperiode = '0';
        }

        $kelas = Kelas::whereNull('deleted_at')->whereHas(
            'periode',
            function ($q) {
                $q->where('isActive', 'Yes');
            }
        )->get();

        if ($role == 'DPA') {
            $dosen = Dosen::where('user_id', Session::get('user_id'))->first();
            $kelas = Kelas::where('id_dosen', $dosen->id_dosen)->whereNull('deleted_at')->whereHas(
                'periode',
                function ($q) {
                    $q->where('isActive', 'Yes');
                }
            )->get();
        }

        if ($role == 'ASL') {
            $aslab = Aslab::where('user_id', Session::get('user_id'))->first();
            $kelas = Kelas::where('aslab', $aslab->id_aslab)->whereNull('deleted_at')->whereHas(
                'periode',
                function ($q) {
                    $q->where('isActive', 'Yes');
                }
            )->get();
        }

        return view('penilaian.nilaitugas.indexnilaitugas', compact('noperiode', 'periode', 'kelas'));
    }

    public function nilaiTugasByModul($id)
    {
        // dd($id);
        $idkel = DB::table('modulkelas')->where('modulkelas.id_modulkelas', $id)->first();
        $idkelas = $idkel->id_kelas;

        $detail = Kelas::find($idkelas);
        $mdlkelas = ModulKelas::find($id);

        $datamhs = DB::table('mahasiswa_kelas')
            ->leftJoin('mahasiswa', 'mahasiswa.id_mahasiswa', '=', 'mahasiswa_kelas.id_mahasiswa')
            ->select(DB::raw('mahasiswa.nim as nim, mahasiswa_kelas.id_mahasiswa_kelas, mahasiswa.nama_mahasiswa as nama_mahasiswa'))
            ->where('mahasiswa_kelas.id_kelas', $idkelas)
            ->get()->toArray();

        $detailx = Kelas::find($idkelas);
        $aslab = DB::table('aslab')
            ->where('aslab.status', 'active')
            ->whereNull('deleted_at')
            ->select(DB::raw('aslab.id_aslab as id_aslab, aslab.nama_aslab as nama_aslab'))
            ->get()->toArray();

        return view('penilaian.nilaitugas.detailnilaitugasmodul', compact('detail', 'mdlkelas', 'datamhs'));
    }

    public function detailJawaban(Request $request)
    {

        $id_mhskls = MahasiswaKelas::find($request->id_mahasiswa_kelas);
        $id_mdlkls = ModulKelas::find($request->id_modulkelas);

        $tugaspre = $id_mdlkls->tgs->where('jenis', 'pre_test')->first();
        $tugaspost = $id_mdlkls->tgs->where('jenis', 'post_test')->first();
        $tugasrep = $id_mdlkls->tgs->where('jenis', 'report')->first();

        $kelas = Kelas::where('id_kelas', $id_mdlkls->id_kelas)->first();
        $matkul = Matkul::where('id_matkul', $kelas->id_matkul)->first();
        $periode = Periode::where('id_periode', $id_mdlkls->id_periode)->first();
        $modul = ModulPraktikum::where('id_modul', $id_mdlkls->id_modul)->first();
        $dosen = Dosen::where('id_dosen', $kelas->id_dosen)->first();
        $aslab = Aslab::where('id_aslab', $kelas->id_aslab)->first();
        $namamhs = Mahasiswa::where('id_mahasiswa', $id_mhskls->id_mahasiswa)->first();
        $user = User::where('user_id', $namamhs->user_id)->first();

        $pre_test = NilaiTugas::where('jenis', 'pre_test')->where('id_mahasiswa_kelas', $id_mhskls->id_mahasiswa_kelas)->where('id_tugas', $tugaspre->id_tugas)->first();
        $post_test = NilaiTugas::where('jenis', 'post_test')->where('id_mahasiswa_kelas', $id_mhskls->id_mahasiswa_kelas)->where('id_tugas', $tugaspost->id_tugas)->first();
        $report = NilaiTugas::where('jenis', 'report')->where('id_mahasiswa_kelas', $id_mhskls->id_mahasiswa_kelas)->where('id_tugas', $tugasrep->id_tugas)->first();
        $subject = NilaiSubjektif::where('id_mahasiswa_kelas', $id_mhskls->id_mahasiswa_kelas)->where('id_modulkelas', $id_mdlkls->id_modulkelas)->first();


        // dd($subject);
        return view(
            'penilaian.nilaitugas.detailjawabantugas',
            compact(
                'id_mhskls',
                'id_mdlkls',
                'kelas',
                'periode',
                'modul',
                'dosen',
                'aslab',
                'namamhs',
                'matkul',
                'user',
                'pre_test',
                'post_test',
                'report',
                'subject'
            )
        );
    }


    public function isiNilaiTugas(Request $request, $id)
    {
        NilaiTugas::find($id)->update(['nilai' => $request->nilai]);
        return redirect()->back()->with('success', 'Nilai tugas sudah dibuat');
    }

    public function isiNilaiSubjektif(Request $request, $id)
    {
        NilaiSubjektif::find($id)->update(['nilai' => $request->nilai, 'uraian' => $request->body]);
        return redirect()->back()->with('success', 'Nilai Subjektif sudah dibuat');
    }
}
