<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use App\Models\Kelas;
use App\Models\MahasiswaKelas;
use App\Models\ModulKelas;
use Illuminate\Http\Request;


class AbsenController extends Controller
{
    public function absenIndex()
    {
        $allkelas = Kelas::whereHas('periode', function ($q){
            $q->where('isActive', 'Yes');
        })->get();

        return view('praktikan.absen.indexabsen',compact( 'allkelas' ));
    }

    public function storeAbsen(Request $request, $id)
    {

        if ($request->id_absen != null)
        {
        foreach ($request->id_absen as $check) {
            Absen::find($check)->update([
                'isAbsen' => 1
            ]);
        }
        }

        
        $uncheck = Absen::whereNotIn('id_absen', $request->id_absen_not)->get();
        $unchecked = [];
        foreach ($uncheck as $k => $v) {
            $unchecked[$k] = $v->id_absen;
        }

        foreach ($unchecked as $check) {
            Absen::find($check)->update([
                'isAbsen' => 0
            ]);
        }

        return redirect()->back()->with('success', 'absen sudah diisi');

    }

    public function rekapAbsen(Request $request)
    {
        $rekap = MahasiswaKelas::where('mahasiswa_kelas.id_kelas', $request->id_kelas)->get();
        // dd($rekap);
        return view('praktikan.absen.rekapabsen', compact('rekap'));
    }
}
