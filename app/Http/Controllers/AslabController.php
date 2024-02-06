<?php

namespace App\Http\Controllers;

use App\Models\Aslab;
use App\Models\User;
use App\Models\UserRole;
use App\Models\UserSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;


class AslabController extends Controller
{
    public function aslabIndex()
    {
        $aslab = Aslab::where('status', 'active')->get();

        return view('aslab.indexaslab', compact('aslab'));
    }

    public function createAslab()
    {
        return view('aslab.createaslab');
    }

    public function storeAslab(Request $request)
    {
        $checkExist = DB::table('user')
        ->where('username', $request->nim)
        ->whereNull('delete_at')
        ->first();

        if ($checkExist) {
            return back()->with('warning', 'Data dengan Username tersebut sudah ada!');
        } else {

        $user = $request->validate([
            'nim' => 'required|numeric|min:10|max:14',
            'name' => 'required',
            'email'=> 'email|required',
            'phone'=> 'required|numeric|min:10|max:15'
        ]);
        $extension = $request->file('image')->getClientOriginalExtension();
        $pp = $request->username.'.'.$extension;

            if ($request->file('image')) {

                $extension = $request->file('image')->getClientOriginalExtension();
                $pp = $request->nim.'.'.$extension;
                $dataImage = $request->file('image')->get();
                File::put(public_path('upload/profile_picture/'.$pp), $dataImage);

            }

        $user = new User();
        $user->username = $request->nim;
        $user->password = Hash::make('qwerty');
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->profile_picture = $pp;
        $user->created_at = date('Y-m-d H:i:s');
        $user->created_by = Session::get('user_id');
        $user->save();

        $aslab = new Aslab();
        $aslab->user_id = $user->user_id;
        $aslab->nim = $request->nim;
        $aslab->nama_aslab = $request->name;
        $aslab->save();

        $user_role = new UserRole();
        $user_role->user_id = $user->user_id;
        $user_role->role_id = '5';
        $user_role->save();

        $user_setting = new UserSetting();
        $user_setting->user_id = $user->user_id;
        $user_setting->created_by = Session::get('user_id');
        $user_setting->save();
        
        return redirect('/aslab')->with('success', 'Asisten Lab berhasil ditambahkan');
        }
    }
}
