<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use App\Models\Kelas;
use App\Models\MahasiswaKelas;
use App\Models\Periode;
use Illuminate\Http\Request;


class AbsenController extends Controller
{
    public function absenIndex()
    {
        $periode = Periode::where('isActive', 'Yes')->first();

        if ($periode == null) {
            $allkelas = null;
        } else {
            $allkelas = Kelas::where('id_periode', $periode->id_periode)->get();
        }

        return view('praktikan.absen.indexabsen', compact('allkelas'));
    }

    // public function isiAbsen($id)
    // {
    //     $absen = Absen::where('id_modulkelas', $id)->get();

    //     return view('praktikan.absen.isiabsen', compact('absen','mhs'));
    // }

    public function storeAbsen(Request $request)
    {
        // dd($request);

        if ($request->absen != null) {
            foreach ($request->absen as $check) {
                Absen::where('id_absen', $check)->update([
                    'isAbsen' => 'Hadir'
                ]);
            }
        }

        if ($request->tidakabsen != null) 

            foreach ($request->tidakabsen as $uncheck) {
                Absen::where('id_absen', $uncheck)->update([
                    'isAbsen' => 'Tidak Hadir'
                ]);
        }

        return redirect()->back()->with('success', 'absen sudah diisi');
    }

    public function rekapAbsen(Request $request)
    {
        $rekap = MahasiswaKelas::where('mahasiswa_kelas.id_kelas', $request->id_kelas)->get();
        $kelas = Kelas::where('id_kelas',  $request->id_kelas)->first();
        return view('praktikan.absen.rekapabsen', compact('rekap', 'kelas'));
    }
}
