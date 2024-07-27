<?php

namespace App\Http\Controllers;

use App\Models\Laboran;
use App\Models\User;
use App\Models\UserRole;
use App\Models\UserSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class LaboranController extends Controller
{
    public function laboranIndex()
    {
        $data = DB::table('laboran')->whereNull('deleted_at')->get();
        return view('laboran.indexlaboran', compact('data'));
    }

    public function createLaboran()
    {
        // $data = DB::table('laboran')->whereNull('deleted_at')->get();
        return view('laboran.createlaboran');
    }

    public function storeLaboran(Request $request)
    {
        // dd($request);
        $checkExist = DB::table('user')
            ->where('username', $request->nip)
            ->whereNull('delete_at')
            ->first();
        $pp = null;

        if ($checkExist) {
            return back()->with('warning', 'Data dengan Username tersebut sudah ada!');
        } else {

            $user = $request->validate([
                'nip' => 'required|numeric|digits_between:5,10',
                'phone' => 'required|numeric|digits_between:10,15',
                'name' => 'required',
                'email' => 'email|required',
            ]);

            if ($request->file('image')) {

                $extension = $request->file('image')->getClientOriginalExtension();
                $pp = $request->nip . '.' . $extension;
                $dataImage = $request->file('image')->get();
                File::put(public_path('upload/profile_picture/' . $pp), $dataImage);
            }

            $user = new User();
            $user->username = $request->nip;
            $user->password = Hash::make('qwerty');
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->profile_picture = $pp;
            $user->created_at = date('Y-m-d H:i:s');
            $user->created_by = Session::get('user_id');
            $user->save();

            $aslab = new Laboran();
            $aslab->user_id = $user->user_id;
            $aslab->nip = $request->nip;
            $aslab->nama_laboran = $request->name;
            $aslab->created_by = Session::get('user_id');
            $aslab->save();

            $user_role = new UserRole();
            $user_role->user_id = $user->user_id;
            $user_role->role_id = '4';
            $user_role->save();

            $user_setting = new UserSetting();
            $user_setting->user_id = $user->user_id;
            $user_setting->created_by = Session::get('user_id');
            $user_setting->save();

            return redirect('/laboran')->with('success', 'Laboran berhasil ditambahkan');
        }
    }
}
