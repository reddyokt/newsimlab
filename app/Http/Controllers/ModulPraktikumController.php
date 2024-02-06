<?php

namespace App\Http\Controllers;

use App\Models\BahanPraktikum;
use App\Models\Kelas;
use App\Models\ModulAlat;
use App\Models\ModulBahan;
use App\Models\ModulKelas;
use App\Models\ModulPraktikum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use PhpParser\Node\Expr\FuncCall;
use Sabberworm\CSS\Property\Selector;

class ModulPraktikumController extends Controller
{
    public function modulIndex()
    
    {
        $modul = ModulPraktikum::all();
 
        return view('modul.indexmodul', compact('modul'));
    }

    public function createModul()
    {
        $matkul = DB::table('matkul')->where('isActive', 'Yes')->get();
        $bahan = DB::table('bahan')->whereNull('bahan.deleted_at')->get();
        $alat = DB::table('alat')->whereNull('alat.deleted_at')->get();

        return view('modul.createmodul', compact('matkul','bahan','alat'));
    }

    public function storeModul(Request $request)
    {
        // dd($request);

        $req = $request->all();

        $modul = new ModulPraktikum();
        $modul->id_matkul = $req['matkul'];
        $modul->modul_name = $req['name'];
        $modul->created_by = Session::get('user_id');
        $modul->save();

        foreach ($req['alat'] as $key => $alat) {
            $modulalat = [
                'id_modul' => $modul->id_modul,
                'id_alat' => $alat,
                'jumlah' => $req['jumlah_alat'][$key],
            ];
            ModulAlat::create($modulalat);
        }

        foreach ($req['bahan'] as $key => $bahan) {
            $modulbahan = [
                'id_modul' => $modul->id_modul,
                'id_bahan' => $bahan,
                'jumlah' => $req['jumlah_bahan'][$key],
            ];
            ModulBahan::create($modulbahan);
        }

        return redirect('/modul')->with('success', 'Modul berhasil dibuat');

    }

    public function useModul(Request $request, $id)
    {
        $modul = ModulPraktikum::find($id);
        $modulbahan = $modul->bahan()->get();

        // dd($modulbahan);

        $msg = '';
        foreach ($modulbahan as  $b) {
            $bahan = BahanPraktikum::find($b->id_bahan);
            $bahan->jumlah = $bahan->jumlah - $b->jumlah;
            $msg = $msg."Nama Bahan : {$bahan->nama_bahan} Jumlah Dipakai : {$b->jumlah_bahan} Sisa Bahan : {$bahan->jumlah} \n";
            $bahan->save();
        }
        $modul->status = 'used';
        $modul->save();
        return redirect ('/modul')->with('success', $msg);
    }

    public function createTanggal($id)
    {
        $kelas = DB::table('kelas')->where('kelas.id_kelas', $id)
                    ->leftJoin('modulkelas','modulkelas.id_kelas','=','kelas.id_kelas')
                    ->leftJoin('modul','modul.id_modul','=','modulkelas.id_modul')
                    ->leftJoin('matkul','matkul.id_matkul','=','kelas.id_matkul')
                    ->whereNull('modulkelas.tanggal_praktek')
                    ->select(DB::raw('kelas.id_kelas, kelas.nama_kelas as nama_kelas,modulkelas.id_modulkelas,
                                        matkul.nama_matkul as matkul, modul.modul_name as modul'))
                    ->get();

        // dd($kelas);

        return view('modul.createtanggal', compact('kelas'));
    }

    public function storeTanggal(Request $request, $id)
    {
        // dd($request);
        ModulKelas::find($id)->update(['tanggal_praktek'=> \DateTime::createFromFormat('m/d/Y', $request->tanggal)]);

        return redirect('/kelas')->with('success', 'Tanggal Praktek sudah diUpdate');
    }

    public function editTanggal($id)
    {
        $kelas = DB::table('kelas')->where('kelas.id_kelas', $id)
                    ->leftJoin('modulkelas','modulkelas.id_kelas','=','kelas.id_kelas')
                    ->leftJoin('modul','modul.id_modul','=','modulkelas.id_modul')
                    ->leftJoin('matkul','matkul.id_matkul','=','kelas.id_matkul')
                    ->select(DB::raw('kelas.id_kelas, kelas.nama_kelas as nama_kelas,modulkelas.id_modulkelas,
                                        matkul.nama_matkul as matkul, modul.modul_name as modul, 
                                        modulkelas.tanggal_praktek as tanggal_praktek'))
                    ->get();

        // dd($kelas);

        return view('modul.edittanggal', compact('kelas'));
    }

    public function storeEditTanggal(Request $request, $id)
    {
        ModulKelas::find($id)->update(['tanggal_praktek'=> \DateTime::createFromFormat('m/d/Y', $request->tanggal)]);
        return redirect('/kelas')->with('success', 'Tanggal Praktek sudah diUpdate');
    }

}
