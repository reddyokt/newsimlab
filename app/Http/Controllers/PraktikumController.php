<?php

namespace App\Http\Controllers;

use App\Models\Aslab;
use App\Models\Dosen;
use App\Models\Kelas;
use App\Models\ModulKelas;
use App\Models\Periode;
use App\Models\Tugas;
use App\Models\Ujian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;

class PraktikumController extends Controller
{
    public function periodeIndex()
    {
        $periodeindex = DB::table('periode')->get()->toArray();
        return view('praktikum.indexperiode', compact('periodeindex'));
    }

    public function createPeriode()
    {
        $year = now()->year;
        $tAjar = [$year - '1' . '/' . $year, $year . '/' . $year + '1'];
        $semester = ['Ganjil', 'Genap'];

        return view('praktikum.createperiode', compact('tAjar', 'semester'));
    }

    public function storePeriode(Request $request)
    {
        $isActive = DB::table('periode')->where('isActive', 'Yes')->first();
        if ($isActive != Null) {

            return redirect()->back()->with('error', 'Tidak bisa membuat periode baru, Masih ada periode aktif');
        }
        $periode = new Periode();

        $periode->start = \DateTime::createFromFormat('m/d/Y', $request->start);
        $periode->end = \DateTime::createFromFormat('m/d/Y', $request->end);
        $periode->tahun_ajaran = $request->tahun_ajaran;
        $periode->semester = $request->semester;

        $periode->save();

        return redirect('/periode')->with('success', 'Alhamdulillah Periode berhasil dibuat');
    }

    public function editPeriode($id)
    {
        $year = now()->year;
        $tAjar = [$year - '1' . '/' . $year, $year . '/' . $year + '1'];
        $semester = ['Ganjil', 'Genap'];

        $editperiode = DB::table('periode')->where('id_periode', $id)->first();
        return view('praktikum.editperiode', compact('editperiode', 'tAjar', 'semester'));
    }

    public function storeEditPeriode(Request $request, $id)
    {
        // dd($request);
        $storeEditPeriode = Periode::find($id);
        $storeEditPeriode->start = \DateTime::createFromFormat('m/d/Y', $request->start);
        $storeEditPeriode->end = \DateTime::createFromFormat('m/d/Y', $request->end);

        $storeEditPeriode->update($request->all());

        return redirect('/periode')->with('success', 'Periode telah diedit');
    }

    public function kelasIndex()
    {
        $role = Session::get('role_code');

        $kelas = Kelas::whereHas('periode', function ($q) {
            $q->where('periode.isActive', 'Yes');
        })->get();

        if ($role == 'DPA') {
            $dosen = Dosen::where('user_id', Session::get('user_id'))->first();
            $kelas = Kelas::where('id_dosen', $dosen->id_dosen)->whereHas('periode', function ($q) {
                $q->where('periode.isActive', 'Yes');
            })->get();
        }

        if ($role == 'ASL') {
            $aslab = Aslab::where('user_id', Session::get('user_id'))->first();
            $kelas = Kelas::where('id_aslab', $aslab->id_aslab)->whereHas('periode', function ($q) {
                $q->where('periode.isActive', 'Yes');
            })->get();
        }

        $kelasx = Kelas::whereHas('periode', function ($q) {
            $q->where('periode.isActive', 'Yes');
        })->get();

        if ($role == 'DPA') {
            $dosen = Dosen::where('user_id', Session::get('user_id'))->first();
            $kelasx = Kelas::where('id_dosen', $dosen->id_dosen)->whereHas('periode', function ($q) {
                $q->where('periode.isActive', 'Yes');
            })->get();
        }

        if ($role == 'ASL') {
            $aslab = Aslab::where('user_id', Session::get('user_id'))->first();
            $kelasx = Kelas::where('id_aslab', $aslab->id_aslab)->whereHas('periode', function ($q) {
                $q->where('periode.isActive', 'Yes');
            })->get();
        }    
        
        $modkls = ModulKelas::whereHas('kels')->get();
        $aslab = DB::table('aslab')
            ->where('aslab.status', 'active')
            ->whereNull('deleted_at')
            ->select(DB::raw('aslab.id_aslab as id_aslab, aslab.nama_aslab as nama_aslab'))
            ->get()->toArray();
        return view('praktikum.indexkelas', compact('kelas', 'modkls', 'kelasx', 'aslab'));
    }

    public function createKelas()

    {
        $periode = DB::table('periode')->where('isActive', 'Yes')->first();
        $dosen = DB::table('dosen')->where('isActive', 'Yes')->get()->toArray();
        $matkul = DB::table('matkul')->get();

        if ($periode?->id_periode == Null) {
            $noperiode = '1';
            $dateend = '';
            $datestart = '';
        } else {

            $noperiode = '0';
            $datestart = Carbon::parse($periode->start)->locale('id');
            $datestart->settings(['formatFunction' => 'translatedFormat']);

            $dateend = Carbon::parse($periode->end)->locale('id');
            $dateend->settings(['formatFunction' => 'translatedFormat']);
        }

        return view('praktikum.createkelas', compact('dosen', 'matkul', 'periode', 'datestart', 'dateend', 'noperiode'));
    }

    public function storeKelas(Request $request)
    {

        $req = $request->all();

        $idkel = $request->matkul;
        $allmodul = $this->idModul($idkel);
        $jenistugas = ['pre_test', 'post_test', 'report'];
        $jenisujian = ['awal', 'akhir'];

        $kelas = new Kelas();
        $kelas->id_periode = $req['id_periode'];
        $kelas->id_matkul = $req['matkul'];
        $kelas->id_dosen = $req['dosen'];
        $kelas->nama_kelas = $req['name'];
        $kelas->kode_matkul = $req['kode'];
        $kelas->save();

        foreach ($allmodul as  $modul) {
            $modulkelas = ModulKelas::create([
                'id_kelas' => $kelas->id_kelas,
                'id_modul' => $modul,
                'created_by' => Session::get('user_id'),
                'id_periode' => $req['id_periode'],
            ]);

            foreach ($jenistugas as $key =>  $tugas) {
                $tugasmodul = Tugas::create([
                    'id_kelas' => $kelas->id_kelas,
                    'jenis' => $tugas,
                    'id_periode' => $req['id_periode'],
                    'id_modulkelas' => $modulkelas->id_modulkelas,
                    'created_by' => Session::get('user_id'),
                ]);
            }
        }

        foreach ($jenisujian as $key => $ujian) {
            $ujian = Ujian::create([
                'id_kelas' => $kelas->id_kelas,
                'id_periode' => $req['id_periode'],
                'jenis' => $ujian
            ]);
        }

        return redirect('kelas')->with('success', 'Kelas Baru Sudah dibuat');
    }

    public function kodeMatkul($id)
    {
        $kode = DB::table('matkul')->where('matkul.id_matkul', $id)->first();
        $kode_matkul = $kode->kode_matkul;

        $matkul = DB::table('matkul')->where('matkul.kode_matkul', $kode_matkul)->get()->toArray();
        return response()->json($matkul);
    }

    public function idModul($id)
    {

        $modul = DB::table('modul')->where('modul.id_matkul', $id)
            ->select(DB::raw('modul.id_modul as id_modul'))
            ->get()->toArray();
        // return $modul;

        $allmod = [];
        foreach ($modul as $k => $v) {
            $allmod[$k] = $v->id_modul;
        }

        return $allmod;
    }

    public function storeAslab(Request $request, $id)
    {
        Kelas::find($id)->update(['id_aslab' => $request->aslab]);

        return redirect()->back()->with('success', 'Asisten Lab telah ditunjuk');
    }

    public function kelasDetail($id)
    {
        $detail = Kelas::find($id);
        $detailmhs = Kelas::find($id);
        $detailmodul = Kelas::find($id);
        $detailtugas = Kelas::find($id);
        $detailujian = Kelas::find($id);
        $detailx = Kelas::find($id);
        $aslab = DB::table('aslab')
            ->where('aslab.status', 'active')
            ->whereNull('deleted_at')
            ->select(DB::raw('aslab.id_aslab as id_aslab, aslab.nama_aslab as nama_aslab'))
            ->get()->toArray();

        return view('praktikum.detailkelas', compact('detail', 'detailx', 'aslab', 'detailmhs', 'detailmodul', 'detailtugas', 'detailujian'));
    }
}
