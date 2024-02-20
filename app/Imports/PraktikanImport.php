<?php

namespace App\Imports;

use App\Models\Kelas;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\User;
use App\Models\Mahasiswa;
use App\Models\MahasiswaKelas;
use App\Models\UserRole;
use App\Models\UserSetting;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;


class PraktikanImport implements ToCollection, WithHeadingRow
{

    private $id_periode;
    public function __construct($id_periode)
    {
        $this->id_periode = $id_periode;
    }

    public function collection(Collection $collection)
    {

        foreach ($collection as $row) {

            $user = User::updateOrcreate(
                [
                    'username' => $row['nim'],
                    'name' => $row['nama_mahasiswa'],
                    'password' => Hash::make('qwerty'),
                    'created_by' => Session::get('user_id')
                ]
            );
            $newmhs = Mahasiswa::updateOrcreate(
                [
                    'nim' => $user->username,
                    'nama_mahasiswa' => $user->name,
                    'user_id' => $user->user_id
                ]
            );
            UserRole::updateOrcreate(
                [
                    'user_id' => $user->user_id,
                    'role_id' => '6'

                ]
            );
            UserSetting::updateOrcreate(
                [
                    'user_id' => $user->user_id,
                    'created_by' => Session::get('user_id')
                ]
            );
                
            $kelas = Kelas::where('kode_kelas', $row['kode_kelas'])                
            ->where('kelas.id_periode', $this->id_periode)
            ->first();

            MahasiswaKelas::updateOrcreate([
                'id_mahasiswa' => $newmhs->id_mahasiswa,
                'id_kelas' => $kelas->id_kelas
            ]);
        }
    }
}
