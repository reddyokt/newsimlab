<?php

namespace App\Http\Controllers;

use App\Models\ModulAlat;
use App\Models\ModulPraktikum;
use App\Models\Pertemuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PertemuanController extends Controller
{
    public function editPertemuan($id)
    {
        $data = DB::table('pertemuan')
            ->where('id_pertemuan', $id)
            ->leftJoin('kelas', 'kelas.id_kelas', '=', 'pertemuan.id_kelas')
            ->leftJoin('periode', 'periode.id_periode', '=', 'pertemuan.id_periode')
            ->leftJoin('matkul', 'matkul.id_matkul', '=', 'kelas.id_matkul')
            ->leftJoin('modul', 'modul.id_matkul', '=', 'matkul.id_matkul')
            ->select(DB::raw('pertemuan.id_pertemuan, pertemuan.nama_pertemuan,kelas.id_kelas, kelas.nama_kelas, 
                                      matkul.nama_matkul, modul.modul_name'))
            ->first();
        $modul = ModulPraktikum::where('id_matkul', $data->id_matkul)->get();

        return view('pertemuan.editpertemuan', compact('data', 'modul'));
    }
}
