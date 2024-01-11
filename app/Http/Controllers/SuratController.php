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
    public function inbox($id)
    {

        $inbox = DB::table('surat')
            ->leftJoin('surat_detail', 'surat_detail.surat_id', '=', 'surat.id_surat')
            // ->leftJoin('user', 'user.user_id', '=' ,'user_detail.kepada_id')
            ->leftJoin('user', 'user.user_id', '=', 'surat.created_by')
            ->where('surat_detail.kepada_id', $id)
            ->select(DB::raw('surat.id_surat as id_surat, surat.created_at as created_at, user.name as dari, surat.subject as subject, surat.body as body, surat_detail.kepada_id as untuk'))
            ->get()->toArray();



        return view('auth.surat.inbox', compact('inbox'));
    }

    public function createsurat()
    {
        $creatorid = Session::get('user_id');


        // dd($creator);

        $user = DB::table('user')
            ->leftJoin('user_role', 'user_role.user_id', '=', 'user.user_id')
            ->leftJoin('roles', 'roles.id', '=', 'user_role.role_id')
            ->whereNot('user.user_id', $creatorid)
            ->whereNull('user.delete_at')
            ->where('user.isActive', 'Y')
            ->whereNull('user_role.delete_at')
            ->select(DB::raw('user.user_id as user_id, user.name as name, roles.role_name as role_name'))
            ->get()->toArray();;
        return view('auth.surat.createsurat', compact('user'));
    }

    public function storecreatesurat(Request $request)
    {

        date_default_timezone_set('Asia/Jakarta');
        $req = $request->all();

        $waktu = Carbon::now()->format('YmdHis');
        $usercreator = Session::get('name');
        $creatorid = Session::get('user_id');

        if ($request->file('uploaded_file')) {

            $extension = $request->file('uploaded_file')->getClientOriginalExtension();
            $pp = $usercreator . '-' . $waktu . '.' . $extension;
            $dataImage = $request->file('uploaded_file')->get();
            File::put(public_path('upload/attachment/' . $pp), $dataImage);
        }

        $surat = new Surat;
        $surat->subject = $req['subject'];
        $surat->body = $req['body'];
        $surat->file_uploaded = $pp;
        $surat->created_by = $creatorid;
        $surat->save();

        foreach ($req['kepada'] as $kepada_id) {
            $detailsurat = new Detailsurat;
            $detailsurat->surat_id = $surat->id_surat;
            $detailsurat['kepada_id'] = $kepada_id;
            $detailsurat->created_by = $creatorid;
            $detailsurat->save();
        }

        return redirect('/inbox/{$id}')->with('success', 'Alhamdulillah Surat berhasil dikirim');
    }
}
