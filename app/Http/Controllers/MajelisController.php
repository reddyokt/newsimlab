<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MajelisController extends Controller
{
    public function majelisindex()
    {
        $majelisindex = DB::table('majelis');

        return view ('auth.masterdata.majelis.majelisindex', compact('majelisindex'));
    }

    public function createmajelis()
    {
        return view('auth.masterdata.majelis.createmajelis');
    }

    public function storecreatemajelis(Request $request)
    {
        dd($request);
        return view('auth.masterdata.majelis.storecreatemajelis');
    }
}
