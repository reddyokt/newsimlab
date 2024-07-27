<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function indexAnalisa()
    {
        return view('transaksi.analisa.indexanalisa');
    }

    public function indexPenelitian()
    {
        return view('transaksi.penelitian.indexpenelitian');
    }
}
