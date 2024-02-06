<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserRole;
use App\Models\UserSetting;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class DosenController extends Controller
{
    public function dosenIndex()
    {
        $dosen = Dosen::where('isActive', 'Yes')->get();

        return view('dosen.indexdosen', compact('dosen'));
    }

    public function createDosen()
    {
        return view('dosen.createdosen');
    }

    public function storeDosen(Request $request)
    {
        $checkExist = DB::table('user')
        ->where('username', $request->nidn)
        ->whereNull('delete_at')
        ->first();

        if ($checkExist) {
            return back()->with('warning', 'Data dengan Username tersebut sudah ada!');
        } else { 

        $extension = $request->file('image')->getClientOriginalExtension();
        $pp = $request->username.'.'.$extension;

            if ($request->file('image')) {

                $extension = $request->file('image')->getClientOriginalExtension();
                $pp = $request->nidn.'.'.$extension;
                $dataImage = $request->file('image')->get();
                File::put(public_path('upload/profile_picture/'.$pp), $dataImage);

            }

        $user = new User();
        $user->username = $request->nidn;
        $user->password = Hash::make('qwerty');
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->profile_picture = $pp;
        $user->created_at = date('Y-m-d H:i:s');
        $user->created_by = Session::get('user_id');
        $user->save();

        $dosen = new Dosen();
        $dosen->user_id = $user->user_id;
        $dosen->nidn = $request->nidn;
        $dosen->nama_dosen = $request->name;
        $dosen->save();

        $user_role = new UserRole();
        $user_role->user_id = $user->user_id;
        $user_role->role_id = '3';
        $user_role->save();

        $user_setting = new UserSetting();
        $user_setting->user_id = $user->user_id;
        $user_setting->created_by = Session::get('user_id');
        $user_setting->save();
        
        return redirect('/dosen')->with('success', 'Dosen berhasil ditambahkan');
        }
    }
}
