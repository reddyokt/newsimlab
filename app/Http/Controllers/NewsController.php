<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    public function postIndex()
    {

        $role = Session::get('role_code');

        if ($role == "SUP" || $role == "PWA1") {
            $postindex = News::leftJoin('user', 'user.user_id', '=' ,'news.created_by')
            ->leftJoin('newscategory', 'newscategory.id_category', '=' ,'news.id_category')
            ->leftJoin('user_role', 'user_role.user_id', '=' ,'user.user_id')
            ->leftJoin('roles', 'roles.id', '=' ,'user_role.role_id' )
            ->whereNull('news.deleted_at')
            ->select(DB::raw('news.news_id, news.news_title as news_title,
                            news.news_body as news_body, news.feature_image as feature_image,
                            news.images as images, user.name as author,
                            newscategory.category as category,news.status as status'))
            ->get()->toArray();
        }else {
            $postindex = News::leftJoin('user', 'user.user_id', '=' ,'news.created_by')
            ->leftJoin('newscategory', 'newscategory.id_category', '=' ,'news.id_category')
            ->leftJoin('user_role', 'user_role.user_id', '=' ,'user.user_id')
            ->leftJoin('roles', 'roles.id', '=' ,'user_role.role_id' )
            ->whereNull('news.deleted_at')
            ->where('news.created_by', Session::get('user_id'))
            ->select(DB::raw('news.news_id, news.news_title as news_title,
                                    news.news_body as news_body, news.feature_image as feature_image,
                                    news.images as images, user.name as author,
                                    newscategory.category as category,news.status as status'))
                    ->get()->toArray();
        }

        return view('auth.news.post.postindex', compact('postindex','role'));
    }

    public function createPosty()
    {
        $category = DB::table('newscategory')
                    ->where('isActive', 'Yes')
                    ->whereNull('deleted_at')
                    ->get()->toArray();

        return view('auth.news.post.createpost', compact('category'));
    }

    public function storeCreatePost(Request $request)
    {
        // dd($request);

        date_default_timezone_set('Asia/Jakarta');
        $req = $request->all();

        $waktu = Carbon::now()->format('YmdHis');
        $usercreator = Session::get('username');
        $creatorid = Session::get('user_id');

        if ($request->file('feature_image')) {

            $extension = $request->file('feature_image')->getClientOriginalExtension();
            $pp = 'feature_image'. '-' .$usercreator. '-' . $waktu . '.' . $extension;
            $dataImage = $request->file('feature_image')->get();
            File::put(public_path('upload/feature_image/' . $pp), $dataImage);
        }

        $storecreatepost = new News();
        $storecreatepost->news_title = $req['title'];
        $storecreatepost->slug = Str::slug($req['title']);
        $storecreatepost->news_body = $req['body'];
        $storecreatepost->id_category = $req['category'];
        $storecreatepost->feature_image = $pp;
        $storecreatepost->created_by = $creatorid;
        $storecreatepost->save();

        return redirect('/post')->with('success', 'Alhamdulillah News berhasil dibuat');
    }

    public function validasiPost($news_id)
    {
        $validasi = News::find($news_id);
        $validasi->update(['status'=>'published', 'updated_by' => Session::get('user_id')]);

        return redirect('/post')->with('success', 'Alhamdulillah News berhasil dipublish');

    }

    public function editPost($id)
    {
        $enc = $id;
        $newscategory = DB::table('newscategory')
            ->where('isActive', 'Yes')
            ->get()->toArray();

        $editpost = DB::table('news')
                    ->where('news.news_id', $id)
                    ->whereNull('news.deleted_at')
                    ->leftJoin('newscategory', 'newscategory.id_category', '=' ,'news.id_category')
                    ->leftJoin('user', 'user.user_id', '=' , 'news.created_by')
                    ->select(DB::raw('news.news_id as news_id, news.news_title as news_title,
                                    news.news_body as news_body, news.feature_image as feature_image,
                                    news.images as images, news.status as status, newscategory.id_category as id_category,
                                    newscategory.category as category'))
                    ->first();

        return view('auth.news.post.editpost', compact('editpost', 'newscategory', 'enc'));
    }
}
