<?php

namespace App\Http\Controllers;

use App\Models\Aslab;
use App\Models\Dosen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Kelas;
use App\Models\Mahasiswa;
use App\Models\MahasiswaKelas;
use App\Models\Matkul;
use App\Models\NilaiUjian;
use App\Models\PenilaianLisan;
use App\Models\Periode;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class NilaiUjianController extends Controller
{
    public function nilaiUjian()
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

        return view('penilaian.nilaiujian.indexnilaiujian', compact('noperiode', 'periode', 'kelas'));
    }

    public function nilaiUjianbyKelas($id)
    {
        $idkel = Kelas::find($id);
        $mhs = MahasiswaKelas::where('id_kelas', $id)->get();

        $ujianawal = $idkel->ujian->where('jenis', 'awal')->first();
        $ujianakhir = $idkel->ujian->where('jenis', 'akhir')->first();
        $ujianlisan = PenilaianLisan::where('id_kelas', $id)->first();
        $periode = Periode::where('id_periode', $idkel->id_periode)->first();
        $matkul = Matkul::where('id_matkul', $idkel->id_matkul)->first();
        $dosen = Dosen::where('id_dosen', $idkel->id_dosen)->first();
        $aslab = Aslab::where('id_aslab', $idkel->id_aslab)->first();
        $userdosen = User::where('user_id', $dosen->user_id)->first();
        $useraslab = User::where('user_id', $aslab->user_id)->first();


        return view('penilaian.nilaiujian.detailujiankelas', compact('idkel', 'dosen', 'aslab', 'mhs', 'periode', 'matkul', 'userdosen', 'useraslab'));
    }

    public function detailJawaban(Request $request)
    {
        $idmhskelas = MahasiswaKelas::find($request->id_mahasiswa_kelas);
        $idkelas = Kelas::find($request->id_kelas);

        $ujianawal = $idkelas->ujian->where('jenis', 'awal')->first();
        $ujianakhir = $idkelas->ujian->where('jenis', 'akhir')->first();
        // $ujianlisan = PenilaianLisan::where('id_kelas', $idkelas)->first();

        $matkul = Matkul::where('id_matkul', $idkelas->id_matkul)->first();
        $periode = Periode::where('id_periode', $idkelas->id_periode)->first();

        $dosen = Dosen::where('id_dosen', $idkelas->id_dosen)->first();
        $aslab = Aslab::where('id_aslab', $idkelas->id_aslab)->first();
        $namamhs = Mahasiswa::where('id_mahasiswa', $idmhskelas->id_mahasiswa)->first();
        $user = User::where('user_id', $namamhs->user_id)->first();

        $nilaiawal = NilaiUjian::where('jenis', 'awal')->where('id_mahasiswa_kelas', $idmhskelas->id_mahasiswa_kelas)->where('id_ujian', $ujianawal->id_ujian)->first();
        $nilaiakhir = NilaiUjian::where('jenis', 'akhir')->where('id_mahasiswa_kelas', $idmhskelas->id_mahasiswa_kelas)->where('id_ujian', $ujianakhir->id_ujian)->first();
        $nilailisan = PenilaianLisan::where('id_mahasiswa_kelas', $idmhskelas->id_mahasiswa_kelas)->where('id_kelas', $idkelas->id_kelas)->first();

        // dd($nilailisan);

        return view(
            'penilaian.nilaiujian.detailjawabanujian',
            compact(
                'idmhskelas',
                'idkelas',
                'ujianawal',
                'ujianakhir',
                'dosen',
                'aslab',
                'namamhs',
                'matkul',
                'user',
                'nilaiawal',
                'nilaiakhir',
                'periode',
                'nilailisan'
            )
        );
    }

    public function isiNilaiUjian(Request $request, $id)
    {
        NilaiUjian::find($id)->update(['nilai' => $request->nilai]);

        return redirect()->back()->with('success', 'Nilai ujian sudah dibuat');
    }

    public function isiNilaiLisan(Request $request, $id)
    {
        // dd($request);

        PenilaianLisan::find($id)->update(['nilai_lisan' => $request->nilailisan ]);

        return redirect()->back()->with('success', 'Nilai Ujian Lisan sudah dibuat');
    }
}
