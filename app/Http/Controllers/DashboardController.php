<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Mahasiswa;
use App\Models\MahasiswaKelas;
use App\Models\ModulKelas;
use App\Models\NilaiTugas;
use App\Models\Tugas;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $role = Session::get('role_code');

        if ($role == 'MHS') {
            $mhs = Mahasiswa::where('user_id', Session::get('user_id'))->first();
            $mhskelas = MahasiswaKelas::where('id_mahasiswa', $mhs->id_mahasiswa)->first();
            $kelas = Kelas::where('id_kelas', $mhskelas->id_kelas)->first();

            $tugaspre = Tugas::where('id_kelas', $mhskelas->id_kelas)->where('status', 'used')->where('jenis', 'pre_test')->first();
            $tugaspost = Tugas::where('id_kelas', $mhskelas->id_kelas)->where('status', 'used')->where('jenis', 'post_test')->first();
            $tugasrep = Tugas::where('id_kelas', $mhskelas->id_kelas)->where('status', 'used')->where('jenis', 'report')->first();

            if ($tugaspre == null) {
                $nilaitugaspre = null;
            } else {
                $nilaitugaspre = NilaiTugas::where('id_mahasiswa_kelas', $mhskelas->id_mahasiswa_kelas)->where('id_tugas', $tugaspre->id_tugas)->where('jenis', 'pre_test')->first();
            }

            if ($tugaspost == null) {
                $nilaitugaspost = null;
            } else {
                $nilaitugaspost = NilaiTugas::where('id_mahasiswa_kelas', $mhskelas->id_mahasiswa_kelas)->where('id_tugas', $tugaspost->id_tugas)->where('jenis', 'post_test')->first();
            }

            if ($tugasrep == null) {
                $nilaitugasrep = null;
            } else {
                $nilaitugasrep = NilaiTugas::where('id_mahasiswa_kelas', $mhskelas->id_mahasiswa_kelas)->where('id_tugas', $tugasrep->id_tugas)->where('jenis', 'report')->first();
            }
        } else {
            $mhs = null;
            $mhskelas = null;
            $kelas =  null;
            $tugaspre =  null;
            $tugaspost =  null;
            $tugasrep =  null;
            $nilaitugaspre = null;
            $nilaitugaspost = null;
            $nilaitugasrep = null;
        }

        date_default_timezone_set('Asia/Jakarta');
        if ($role == 'LBO' || 'KAL' || 'SUP') {
            $notifikasi = DB::table('detail_alat')
                ->leftJoin('alat', 'alat.id_alat', '=', 'detail_alat.id_alat')
                ->whereRaw('DATEDIFF(deadline_calibration, NOW()) <= 30')
                ->get();
        } else {
            $notifikasi = null;
        }

        $modulkelas = ModulKelas::with(['moduls', 'kels'])->get();

        // Prepare array to store calendar events
        $events = [];

        // Iterate over each modulkelas record
        foreach ($modulkelas as $modulkelas) {
            $events[] = [
                'title' => 'Kelas' . '-' . $modulkelas->kels->nama_kelas . '|' . $modulkelas->kels->matkul->nama_matkul . '-' . $modulkelas->moduls->modul_name,
                'start' => $modulkelas->tanggal_praktek,
                'dosen' => $modulkelas->kels->dosen->nama_dosen,
                'aslab' => $modulkelas->kels->aslab->nama_aslab,
                'id_kelas' => $modulkelas->kels->id_kelas // Add id_kelas to the event data
            ];
        }

        return view('dashboard.index', compact(
            'role',
            'mhs',
            'mhskelas',
            'tugaspre',
            'tugaspost',
            'tugasrep',
            'nilaitugaspre',
            'nilaitugaspost',
            'nilaitugasrep',
            'kelas',
            'notifikasi',
            'events'
        ));
    }

    function setRole($id)
    {
        //fetch menu code
        $menu = DB::select("
            SELECT code
            FROM menu
            LEFT JOIN role_menu rm ON rm.menu_id = menu.menu_id
            LEFT JOIN user_role ur ON ur.role_id = rm.role_id WHERE ur.user_id = " . Session::get('user_id') . " AND ur.role_id = " . $id . " AND menu.deleted_at IS NULL");
        $m = array();
        foreach ($menu as $mn) {
            $m[] = $mn->code;
        }

        $role_current = DB::table('user_role')
            ->join('roles', 'roles.id', '=', 'user_role.role_id')
            ->where('user_id', Session::get('user_id'))
            ->where('roles.id', $id)
            ->select(DB::raw('roles.id, roles.CODE, roles.role_name'))
            ->first();

        $role_other = DB::table('user_role')
            ->join('roles', 'roles.id', '=', 'user_role.role_id')
            ->where('user_id', Session::get('user_id'))
            ->where('roles.id', '<>', $id)
            ->select(DB::raw('roles.id, roles.CODE, roles.role_name'))
            ->first();

        Session::put('menu', $m);
        Session::put('role_other', $role_other);
        Session::put('role_id', $role_current->role_id);
        Session::put('role_name', $role_current->role_name);
        Session::put('role_code', $role_current->CODE);

        return response()->json(['status' => true, 'message' => 'Success']);
    }
}
