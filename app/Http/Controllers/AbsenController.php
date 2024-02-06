<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\ModulPraktikum;
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
}
