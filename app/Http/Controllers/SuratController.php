<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Carbon;
use App\Models\Detailsurat;

class SuratController extends Controller
{
    public function inbox()
    {
        $creatorid= Session::get('user_id');


        // dd($creator);

        $user = DB::table('user')
                ->leftJoin('user_role', 'user_role.user_id', '=' , 'user.user_id')
                ->leftJoin('roles', 'roles.id', '=' , 'user_role.role_id')
                ->whereNot('user.user_id', $creatorid)
                ->whereNull('user.delete_at')
                ->whereNull('user_role.delete_at')
                ->select(DB::raw('user.user_id as user_id, user.name as name, roles.role_name as role_name'))
                ->get()->toArray();
                ;
        return view('auth.surat.inbox', compact('user'));

    }

    public function createsurat()
    {
        $creatorid= Session::get('user_id');


        // dd($creator);

        $user = DB::table('user')
                ->leftJoin('user_role', 'user_role.user_id', '=' , 'user.user_id')
                ->leftJoin('roles', 'roles.id', '=' , 'user_role.role_id')
                ->whereNot('user.user_id', $creatorid)
                ->whereNull('user.delete_at')
                ->whereNull('user_role.delete_at')
                ->select(DB::raw('user.user_id as user_id, user.name as name, roles.role_name as role_name'))
                ->get()->toArray();
                ;
        return view('auth.surat.createsurat', compact('user'));

    }

    public function storecreatesurat(Request $request)
    {

        date_default_timezone_set('Asia/Jakarta');
        $req = $request->all();

        $waktu = Carbon::now()->toDateString();
        $usercreator = Session::get('name');
        $creatorid= Session::get('user_id');

        if ($request->file('uploaded_file')) {

                $extension = $request->file('uploaded_file')->getClientOriginalExtension();
                $pp = $usercreator.'-'.$waktu.'.'.$extension;
                $dataImage = $request->file('uploaded_file')->get();
                File::put(public_path('upload/attachment/'.$pp), $dataImage);
        }

         $surat = new Surat;
         $surat->subject = $req['subject'];
         $surat->body = $req['body'];
         $surat->file_uploaded = $pp;
         $surat->created_by = $creatorid;
         $surat->save();

         $detailsurat = new Detailsurat;
         $id_surat = $surat->id_surat;

         dd($id_surat);
         foreach ($id_surat as  $id_surat){
            $detailsurat['surat_id'] = $id_surat;
         }
         $detailsurat->surat_id = $surat->id_surat;
        foreach ($kepada_id = $req['kepada'] as $key => $kepada_id)
        {
            $detailsurat['kepada_id'] = $kepada_id;
        }
         $detailsurat->created_by = $creatorid;
         $detailsurat->save();

        return redirect('/inbox')->with('succes', 'Alhamdulillah Surat berhasil dikirim');

    }


}
