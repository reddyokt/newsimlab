<?php

namespace App\Http\Controllers;

use App\Models\NewsCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NewsCategoryController extends Controller
{
    public function categoryIndex()
    {
        $categoryindex = DB::table('newscategory')
        ->whereNull('newscategory.deleted_at')
        ->get()->toArray();

        return view('auth.news.newscategory.categoryindex',compact('categoryindex'));
    }

    public function storeCreateCategory(Request $request)
    {
        // dd($request);  
        $storecreatecategory = $request->validate([
            'name' => 'required'
        ]);

        $storecreatecategory['category'] = $request->name;


        NewsCategory::create($storecreatecategory);
        return redirect('/newscategory')->with('success', 'Alhamdulillah Category baru berhasil dibuat');
    }

}
