<?php

namespace App\Http\Controllers;

use App\Models\Filetype;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FiletypeController extends Controller
{
    public function filetypeindex()
    {
        $filetypeindex = DB::table('filetype')
                        ->where('isActive', 'Yes')
                        ->get();

        return view('auth.masterdata.filetype.filetypeindex', compact('filetypeindex'));
    }

    public function createfiletype()
    {
        return view('auth.masterdata.filetype.createfiletype');
    }

    public function storecreatefiletype(Request $request)
    {
        // dd($request);
        $storecreatefiletype = $request->validate([
            'name' => 'required',
            'description' => 'required'
        ]);

        $storecreatefiletype['name'] = $request->name;
        $storecreatefiletype['description'] = $request->description;

        Filetype::create($storecreatefiletype);
        return redirect('/filetype')->with('success', 'Alhamdulillah data file type berhasil dibuat');
    }
}
