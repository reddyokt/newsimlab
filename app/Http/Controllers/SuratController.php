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
        $reader_id = Session::get('user_id');

        // dd($reader_id);


        $inbox = DB::table('surat')
            ->leftJoin('surat_detail', 'surat_detail.surat_id', '=', 'surat.id_surat')
            // ->leftJoin('user', 'user.user_id', '=' ,'user_detail.kepada_id')
            ->leftJoin('user', 'user.user_id', '=', 'surat.created_by')
            ->where('surat_detail.kepada_id', $id)
            ->select(DB::raw('surat.id_surat as id_surat, surat.created_at as created_at, user.name as dari,
                              surat.subject as subject, surat.body as body, surat_detail.kepada_id as untuk,
                              surat_detail.isOpened as isOpened'))
            ->get()->toArray();

        $sent = DB::table('surat')
            ->leftJoin('surat_detail', 'surat_detail.surat_id', '=', 'surat.id_surat')
            ->leftJoin('user', 'user.user_id', '=', 'surat_detail.kepada_id')
            ->where('surat.created_by', $reader_id)
            ->select(DB::raw('surat.id_surat as id_surat, surat.created_at as created_at, user.name as kepada,
                            surat.subject as subject, surat.body as body, surat_detail.kepada_id as untuk,
                            surat_detail.isOpened as isOpened, surat_detail.id_detail as id_detail'))
            ->get()->toArray();

        return view('auth.surat.inbox', compact('inbox','sent'));
    }

    public function sent($id)
    {
        $reader_id = Session::get('user_id');

        $inbox = DB::table('surat')
        ->leftJoin('surat_detail', 'surat_detail.surat_id', '=', 'surat.id_surat')
        // ->leftJoin('user', 'user.user_id', '=' ,'user_detail.kepada_id')
        ->leftJoin('user', 'user.user_id', '=', 'surat.created_by')
        ->where('surat_detail.kepada_id', $id)
        ->select(DB::raw('surat.id_surat as id_surat, surat.created_at as created_at, user.name as dari,
                          surat.subject as subject, surat.body as body, surat_detail.kepada_id as untuk,
                          surat_detail.isOpened as isOpened'))
        ->get()->toArray();

        $sent = DB::table('surat')
            ->leftJoin('surat_detail', 'surat_detail.surat_id', '=', 'surat.id_surat')
            ->leftJoin('user', 'user.user_id', '=', 'surat_detail.kepada_id')
            ->leftJoin('user_role', 'user_role.user_id', '=' , 'user.user_id')
            ->leftJoin('roles', 'roles.id', '=' , 'user_role.role_id')
            ->where('surat_detail.created_by', $id)
            ->select(DB::raw('surat.id_surat as id_surat, surat.created_at as created_at, user.name as kepada,
                            surat.subject as subject, surat.body as body, surat_detail.kepada_id as untuk,
                            surat_detail.isOpened as isOpened, surat_detail.id_detail as id_detail, roles.role_name as role_name'))
            ->get();

        return view('auth.surat.sent', compact('sent','inbox'));

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

    public function readinbox($id)
    {
        $reader_id = Session::get('user_id');

        $readinbox = DB::table('surat')
        ->leftJoin('surat_detail', 'surat_detail.surat_id', '=', 'surat.id_surat')
        ->leftJoin('user', 'user.user_id', '=', 'surat.created_by')
        ->leftJoin('user_role', 'user_role.user_id', '=' , 'user.user_id')
        ->leftJoin('roles', 'roles.id', '=' , 'user_role.role_id')
        ->where('surat.id_surat', $id)
        ->select(DB::raw('surat.id_surat as id_surat, surat.created_at as created_at, user.name as dari,
                          surat.subject as subject, surat.body as body, surat_detail.kepada_id as untuk,
                          surat_detail.isOpened as isOpened, roles.role_name as role_name,
                          surat.file_uploaded as uploaded_file, surat_detail.id_detail as id_detail, user.profile_picture as photo'))
        ->get()->toArray();

        $inbox = DB::table('surat')
        ->leftJoin('surat_detail', 'surat_detail.surat_id', '=', 'surat.id_surat')
        // ->leftJoin('user', 'user.user_id', '=' ,'user_detail.kepada_id')
        ->leftJoin('user', 'user.user_id', '=', 'surat.created_by')
        ->where('surat_detail.surat_id', $id)
        ->select(DB::raw('surat.id_surat as id_surat, surat.created_at as created_at, user.name as dari,
                          surat.subject as subject, surat.body as body, surat_detail.kepada_id as untuk,
                          surat_detail.isOpened as isOpened'))
        ->get()->toArray();

        $sent = DB::table('surat_detail')
                ->leftJoin('surat', 'surat.id_surat', '=', 'surat_detail.surat_id')
                ->leftJoin('user', 'user.user_id', '=', 'surat_detail.kepada_id')
                ->where('surat_detail.created_by', $reader_id)
                ->select(DB::raw('surat.id_surat as id_surat, surat.created_at as created_at, user.name as kepada,
                                surat.subject as subject, surat.body as body, surat_detail.kepada_id as untuk,
                                surat_detail.isOpened as isOpened'))
                ->get();

        return view('auth.surat.readinbox', compact('readinbox','inbox', 'sent'));
    }

    public function readsend($id)
    {
        $reader_id = Session::get('user_id');

        $readsend = DB::table('surat_detail')
        ->leftJoin('surat', 'surat.id_surat', '=', 'surat_detail.surat_id')
        ->leftJoin('user', 'user.user_id', '=', 'surat_detail.kepada_id')
        ->leftJoin('user_role', 'user_role.user_id', '=' , 'user.user_id')
        ->leftJoin('roles', 'roles.id', '=' , 'user_role.role_id')
        ->where('surat_detail.id_detail', $id)
        ->select(DB::raw('surat.id_surat as id_surat, surat.created_at as created_at, user.name as kepada,
                        surat.subject as subject, surat.body as body, surat_detail.kepada_id as untuk,
                        surat_detail.isOpened as isOpened, roles.role_name as role_name,
                        surat.file_uploaded as uploaded_file, surat_detail.id_detail as id_detail, user.profile_picture as photo'))
        ->get()->toArray();

        $inbox = DB::table('surat')
        ->leftJoin('surat_detail', 'surat_detail.surat_id', '=', 'surat.id_surat')
        // ->leftJoin('user', 'user.user_id', '=' ,'user_detail.kepada_id')
        ->leftJoin('user', 'user.user_id', '=', 'surat.created_by')
        ->where('surat_detail.kepada_id', $reader_id)
        ->select(DB::raw('surat.id_surat as id_surat, surat.created_at as created_at, user.name as dari,
                          surat.subject as subject, surat.body as body, surat_detail.kepada_id as untuk,
                          surat_detail.isOpened as isOpened'))
        ->get()->toArray();

        $sent = DB::table('surat_detail')
                ->leftJoin('surat', 'surat.id_surat', '=', 'surat_detail.surat_id')
                ->leftJoin('user', 'user.user_id', '=', 'surat_detail.kepada_id')
                ->where('surat_detail.created_by', $reader_id)
                ->select(DB::raw('surat.id_surat as id_surat, surat.created_at as created_at, user.name as kepada,
                                surat.subject as subject, surat.body as body, surat_detail.kepada_id as untuk,
                                surat_detail.isOpened as isOpened'))
                ->get();

        return view('auth.surat.readsend', compact('readsend','inbox', 'sent'));
    }
}
