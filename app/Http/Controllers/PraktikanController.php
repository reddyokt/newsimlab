<?php

namespace App\Http\Controllers;

use App\Imports\PraktikanImport;
use App\Models\Kelas;
use App\Models\Kelompok;
use App\Models\Mahasiswa;
use App\Models\MahasiswaKelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use SebastianBergmann\Type\NullType;

class PraktikanController extends Controller
{
    public function import(Request $request)
    {
        // dd($request);
        Excel::import(new PraktikanImport($request->id_periode), $request->file('dataimport'));
        return redirect('/peserta');
    }

    public function pesertaIndex()
    {
        $periode = DB::table('periode')->where('periode.isActive', 'Yes')->first();

        if ($periode?->id_periode == Null) {
            $noperiode = '1';
        } else {
            $noperiode = '0';
            $periode = $periode;
        }

        $peserta = DB::table('mahasiswa_kelas')
            ->leftJoin('mahasiswa', 'mahasiswa.id_mahasiswa', '=', 'mahasiswa_kelas.id_mahasiswa')
            ->leftJoin('kelas', 'kelas.id_kelas', '=', 'mahasiswa_kelas.id_kelas')
            ->leftJoin('matkul', 'matkul.id_matkul', '=', 'kelas.id_matkul')
            ->leftJoin('periode', 'periode.id_periode', '=', 'kelas.id_periode')
            ->where('periode.isActive', 'Yes')
            ->select(DB::raw('mahasiswa.nim as nim, mahasiswa.nama_mahasiswa as nama,
                                        kelas.nama_kelas as nama_kelas, matkul.nama_matkul as matkul,
                                        periode.tahun_ajaran, periode.semester'))
            ->get()->toArray();

        return view('praktikan.peserta.indexpeserta', compact('periode', 'noperiode', 'peserta'));
    }

    public function kelompokIndex()
    {
        $periode = DB::table('periode')->where('periode.isActive', 'Yes')->first();

        if ($periode?->id_periode == Null) {
            $noperiode = '1';
        } else {
            $noperiode = '0';
            // $periode = $periode;
        }

        $kelas = DB::table('kelas')
            ->leftJoin('matkul', 'matkul.id_matkul', '=', 'kelas.id_matkul')
            ->leftJoin('periode', 'periode.id_periode', '=', 'kelas.id_periode')
            ->where('periode.isActive', 'Yes')
            ->select(DB::raw('kelas.id_kelas, kelas.nama_kelas as nama_kelas, 
                                    kelas.id_periode, matkul.nama_matkul as nama_matkul'))
            ->get();

        $kelass = DB::table('kelas')
            ->leftJoin('matkul', 'matkul.id_matkul', '=', 'kelas.id_matkul')
            ->leftJoin('periode', 'periode.id_periode', '=', 'kelas.id_periode')
            ->where('periode.isActive', 'Yes')
            ->select(DB::raw('kelas.id_kelas, kelas.nama_kelas as nama_kelas, 
                                    kelas.id_periode, matkul.nama_matkul as nama_matkul'))
            ->get();

        $peserta = DB::table('mahasiswa_kelas')
            ->leftJoin('mahasiswa', 'mahasiswa.id_mahasiswa', '=', 'mahasiswa_kelas.id_mahasiswa')
            ->leftJoin('kelas', 'kelas.id_kelas', '=', 'mahasiswa_kelas.id_kelas')
            ->leftJoin('matkul', 'matkul.id_matkul', '=', 'kelas.id_matkul')
            ->leftJoin('periode', 'periode.id_periode', '=', 'kelas.id_periode')
            ->where('periode.isActive', 'Yes')
            ->whereNull('mahasiswa_kelas.id_kelompok')
            ->select(DB::raw('mahasiswa_kelas.id_mahasiswa_kelas as id, mahasiswa.nim as nim, mahasiswa.nama_mahasiswa as nama,
                                    kelas.nama_kelas as nama_kelas, matkul.nama_matkul as matkul,
                                    periode.tahun_ajaran, periode.semester'))
            ->get()->toArray();

        $pesertakelompok = Kelompok::whereNull('deleted_at')->whereHas(
            'kelas',
            function ($q) {
                $q->whereHas('periode', function ($q1) {
                    $q1->where('isActive', 'Yes');
                });
            }
        )->get();

        return view('praktikan.kelompok.indexkelompok', compact('periode', 'noperiode', 'peserta', 'kelas', 'pesertakelompok', 'kelass'));
    }

    public function storeKelompok(Request $request)
    {
        // dd($request);
        // $req = $request->all();

        $idmhs = $request->id_mhs;

        $kelompok = new Kelompok();
        $kelompok->nama_kelompok = $request->name;
        $kelompok->id_kelas = $request->id_kelas;
        $kelompok->save();

        MahasiswaKelas::whereIn('id_mahasiswa_kelas', $idmhs)->update([
            'id_kelompok' => $kelompok->id_kelompok
        ]);

        return redirect()->back()->with('success', 'Kelompok telah dibuat');
    }

    public function mahasiswaBykelas($id)
    {
        $mhs = DB::table('mahasiswa_kelas')
            ->leftJoin('mahasiswa', 'mahasiswa.id_mahasiswa', '=', 'mahasiswa_kelas.id_mahasiswa')
            ->leftJoin('kelas', 'kelas.id_kelas', '=', 'mahasiswa_kelas.id_kelas')
            ->leftJoin('matkul', 'matkul.id_matkul', '=', 'kelas.id_matkul')
            ->leftJoin('periode', 'periode.id_periode', '=', 'kelas.id_periode')
            ->where('mahasiswa_kelas.id_kelas', $id)
            ->where('periode.isActive', 'Yes')
            ->whereNull('mahasiswa_kelas.id_kelompok')
            ->select(DB::raw('mahasiswa_kelas.id_mahasiswa_kelas as id, mahasiswa.nim as nim, 
                            mahasiswa.nama_mahasiswa as nama'))
            ->get()->toArray();

        return response()->json($mhs);
    }

    public function editKelompok($id)
    {
        $edit = Kelompok::find($id);

        $kelas = DB::table('kelas')
            ->leftJoin('matkul', 'matkul.id_matkul', '=', 'kelas.id_matkul')
            ->select(DB::raw('kelas.id_kelas, kelas.nama_kelas as nama_kelas, 
                        kelas.id_periode, matkul.nama_matkul as nama_matkul'))
            ->get();

        $mhskelas = DB::table('mahasiswa_kelas')
            ->where('mahasiswa_kelas.id_kelas', $edit->id_kelas)
            ->whereNull('id_kelompok')
            ->get();
        $peserta = DB::table('mahasiswa_kelas')
            ->leftJoin('mahasiswa', 'mahasiswa.id_mahasiswa', '=', 'mahasiswa_kelas.id_mahasiswa')
            ->leftJoin('kelas', 'kelas.id_kelas', '=', 'mahasiswa_kelas.id_kelas')
            ->leftJoin('matkul', 'matkul.id_matkul', '=', 'kelas.id_matkul')
            ->leftJoin('periode', 'periode.id_periode', '=', 'kelas.id_periode')
            ->where('periode.isActive', 'Yes')
            ->whereNull('mahasiswa_kelas.id_kelompok')
            ->select(DB::raw('mahasiswa_kelas.id_mahasiswa_kelas as id, mahasiswa.nim as nim, mahasiswa.nama_mahasiswa as nama,
                                    kelas.nama_kelas as nama_kelas, matkul.nama_matkul as matkul,
                                    periode.tahun_ajaran, periode.semester'))
            ->get()->toArray();
        return view('praktikan.kelompok.editkelompok', compact('edit', 'mhskelas', 'kelas', 'peserta'));
    }

    public function deleteMhs($id)
    {
        MahasiswaKelas::find($id)->update(['id_kelompok' => Null]);

        return redirect()->back()->with('error', 'Mahasiswa tersebut sudah dikeluarkan dari kelompok');
    }

    public function tambahMhs(Request $request, $id)
    {
        // dd($request);

        $idmhs = $request->id_mhs;

        MahasiswaKelas::whereIn('id_mahasiswa_kelas', $idmhs)->update([
            'id_kelompok' => $id
        ]);

        return redirect()->back()->with('success', 'Data Mahasiswa baru ditambahkan pada kelompok ini');
    }

    public function hapusKelompok($id)
    {
        Kelompok::where('id_kelompok', $id)->update([
            'deleted_at' => now()
        ]);
        $ids = [$id];
        MahasiswaKelas::whereIn('id_kelompok', $ids)->update([
            'id_kelompok' => Null
        ]);

        return redirect()->back()->with('error', 'Kelompok sudah dihapus!');
    }
}
