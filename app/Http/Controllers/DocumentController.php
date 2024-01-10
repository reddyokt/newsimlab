<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;

class DocumentController extends Controller
{
    public function documentindex()
    {
        $documentindex = DB::table('document')
                    ->leftJoin('filetype', 'filetype.id_filetype', '=' ,'document.id_filetype')
                    ->leftJoin('pda', 'pda.pda_id', '=' ,'document.pda_id')
                    ->leftJoin('pca', 'pca.pca_id', '=' ,'document.pca_id')
                    ->leftJoin('user',  'user.user_id', '=' , 'document.created_by')
                    ->whereNull('document.deleted_at')
                    ->select(DB::raw('document.id_doc, document.pda_id, document.uploaded_doc ,document.docname as docname, user.name as name ,filetype.filename as filename, pda.pda_name, pca.pca_name'))
                    ->get()->toArray();

        return view('auth.document.documentindex', compact('documentindex'));
    }

    public function createdocument()
    {
        $filetype = DB::table('filetype')->where('isActive', 'Yes')->get();

        return view('auth.document.createdocument', compact('filetype'));
    }

    public function storecreatedocument(Request $request)
    {
        //  dd($request);
        date_default_timezone_set('Asia/Jakarta');
        $waktu = Carbon::now()->toDateString();
        $req = $request->all();


        if ($request->file('uploaded_doc')) {
            $doc = new Document;

                $extension = $request->file('uploaded_doc')->getClientOriginalExtension();
                $pp = 'uploaded_doc'.'-'.$waktu.'.'.$extension;
                $dataImage = $request->file('uploaded_doc')->get();

            File::put(public_path('upload/document/'.$pp), $dataImage);


            $doc->docname = $req['name'];
            $doc->id_filetype = $req['filetype'];
            $doc->pda_id = Auth::user()->pda_id;
            $doc->created_by = Session::get('user_id');
            $doc->uploaded_doc = $pp;

            $doc->save();
        }
            return redirect('/document')->with('succes', 'Alhamdulillah Document berhasil disimpan');

    }
}
