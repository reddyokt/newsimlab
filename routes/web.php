<?php

use App\Http\Controllers\PCAController;
use App\Http\Controllers\RoleController;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();

// Route::get('/', [App\Http\Controllers\HomeController::class, 'root']);
// Route::get('{any}', [App\Http\Controllers\HomeController::class, 'index']);
// //Language Translation
Route::get('index/{locale}', [App\Http\Controllers\HomeController::class, 'lang']);
Route::post('/formsubmit', [App\Http\Controllers\HomeController::class, 'FormSubmit'])->name('FormSubmit');

Route::post('/postlogin', [App\Http\Controllers\AuthenticationController::class, 'postLogin'])->name('authentication.login.post');

Route::get('/', [App\Http\Controllers\LandingPageController::class, 'index']);
Route::get('/landingpage/post', [App\Http\Controllers\LandingPageController::class, 'postLanding']);
Route::get('/Category/{id_category}/{news_id}', [App\Http\Controllers\LandingPageController::class, 'postBlog']);


Route::group(['middleware' => 'prevent-back-history'], function () {
// Route::group(['middleware'], function () {

    Route::get('login', [App\Http\Controllers\AuthenticationController::class, 'index'])->name('login');

    /* Dashboard */
    Route::group(['middleware' => ['auth:web']], function () {
        Route::get('dashboard', function () {
            return redirect('dashboard/index');
        });
        Route::get('dashboard/index', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard.index');
        Route::get('dashboard/setrole/{id}', [App\Http\Controllers\DashboardController::class, 'setrole'])->name('dashboard.setrole');
        Route::get('set-language/{lang}', [App\Http\Controllers\DashboardController::class, 'setlanguage'])->name('dashboard.setlanguage');
    });


    /*----------------------------------Master Data-----------------------------------------------------------*/
    /*---------------1.role--------------------------------------*/
    Route::get('/role', [App\Http\Controllers\RoleController::class, 'roleindex']);
    Route::get('/role/add', [App\Http\Controllers\RoleController::class, 'addrole']);
    Route::post('/role/add', [App\Http\Controllers\RoleController::class, 'storenewrole']);
    Route::get('/role/edit/{id}', [App\Http\Controllers\RoleController::class, 'roleedit']);
    Route::post('/role/edit/{id}', [App\Http\Controllers\RoleController::class, 'storeroleedit']);
    /*---------------2.account--------------------------------------*/
    Route::get('/account', [App\Http\Controllers\AccountController::class, 'accountindex']);
    Route::get('/account/create', [App\Http\Controllers\AccountController::class, 'createaccount']);
    Route::post('/account/create', [App\Http\Controllers\AccountController::class, 'storeaccount']);
    Route::get('/account/edit/{id}', [App\Http\Controllers\AccountController::class, 'editaccount']);
    Route::post('/account/edit/{id}', [App\Http\Controllers\AccountController::class, 'updateaccount']);
    Route::get('/account/delete/{id}', [App\Http\Controllers\AccountController::class, 'deleteaccount']);
    Route::get('/account/pda', [App\Http\Controllers\AccountController::class, 'getPDA']);
    Route::get('/account/majelis', [App\Http\Controllers\AccountController::class, 'getMajelis']);

    /*--------------------3.pda------------------------------------------------*/
    Route::get('/pda', [App\Http\Controllers\PdaController::class, 'pdaindex']);
    Route::get('/pda/create', [App\Http\Controllers\PdaController::class, 'createpda']);
    Route::post('/pda/create', [App\Http\Controllers\PdaController::class, 'storecreatepda']);
    Route::get('/pda/edit/{id}', [App\Http\Controllers\PdaController::class, 'editpda']);
    Route::post('/pda/edit/{id}', [App\Http\Controllers\PdaController::class, 'storeeditpda']);
    Route::post('/pda/delete/{id}', [App\Http\Controllers\PdaController::class, 'deletepda']);
    /*--------------------4.pca------------------------------------------------*/
    Route::get('/pca', [App\Http\Controllers\PcaController::class, 'pcaindex']);
    Route::get('/pca/create', [App\Http\Controllers\PcaController::class, 'createpca']);
    Route::post('/pca/create', [App\Http\Controllers\PcaController::class, 'storecreatepca']);
    Route::get('/pca/edit/{id}', [App\Http\Controllers\PcaController::class, 'editpca']);
    Route::post('/pca/edit/{id}', [App\Http\Controllers\PcaController::class, 'storeeditpca']);
    Route::post('/pca/delete/{id}', [App\Http\Controllers\PcaController::class, 'deletepca']);
    Route::get('/pca/pdabydistricts/{id}', [App\Http\Controllers\PcaController::class, 'pdaBydistricts']);
    /*------------------5.kader-----------------------------------------------*/
    Route::get('/kader', [App\Http\Controllers\KaderController::class, 'kaderindex']);
    Route::get('/kader/create', [App\Http\Controllers\KaderController::class, 'createkader']);
    Route::post('/kader/create', [App\Http\Controllers\KaderController::class, 'storekader']);
    Route::get('/kader/pcabypda/{id}', [App\Http\Controllers\KaderController::class, 'PCAbyPDA']);
    Route::get('/kader/detail/{id}', [App\Http\Controllers\KaderController::class, 'kaderdetail']);
    Route::get('/kader/print/{id}', [App\Http\Controllers\KaderController::class, 'kaderprint']);
    /*------------------6.majelis-----------------------------------------------*/
    Route::get('/majelis', [App\Http\Controllers\MajelisController::class, 'majelisindex']);
    Route::get('/majelis/create', [App\Http\Controllers\MajelisController::class, 'createmajelis']);
    Route::post('/majelis/create', [App\Http\Controllers\MajelisController::class, 'storecreatemajelis']);
    /*------------------7.filetype-----------------------------------------------*/
    Route::get('/filetype', [App\Http\Controllers\FiletypeController::class, 'filetypeindex']);
    Route::get('/filetype/create', [App\Http\Controllers\FiletypeController::class, 'createfiletype']);
    Route::post('/filetype/create', [App\Http\Controllers\FiletypeController::class, 'storecreatefiletype']);
    /*------------------7.bidang_usaha-----------------------------------------------*/
    Route::get('/bidangusaha', [App\Http\Controllers\BidangUsahaController::class, 'bidangusahaindex']);
    Route::get('/bidangusaha/create', [App\Http\Controllers\BidangUsahaController::class, 'createbidangusaha']);
    Route::post('/bidangusaha/create', [App\Http\Controllers\BidangUsahaController::class, 'storecreatebidangusaha']);
    /*------------------8.Document-----------------------------------------------*/
    Route::get('/document', [App\Http\Controllers\DocumentController::class, 'documentindex']);
    Route::get('/document/create', [App\Http\Controllers\DocumentController::class, 'createdocument']);
    Route::post('/document/create', [App\Http\Controllers\DocumentController::class, 'storecreatedocument']);
    /*------------------8.Surat-----------------------------------------------*/
    Route::get('/inbox/{id}', [App\Http\Controllers\SuratController::class, 'inbox']);
    Route::get('/sent/{id}', [App\Http\Controllers\SuratController::class, 'sent']);
    Route::get('/surat/create', [App\Http\Controllers\SuratController::class, 'createsurat']);
    Route::post('/surat/create', [App\Http\Controllers\SuratController::class, 'storecreatesurat']);
    Route::get('/inbox/read/{id}', [App\Http\Controllers\SuratController::class, 'readinbox']);
    Route::get('/sent/read/{id}', [App\Http\Controllers\SuratController::class, 'readsend']);
    /*------------------9.ranting-----------------------------------------------*/
    Route::get('/ranting', [App\Http\Controllers\RantingController::class, 'rantingindex']);
    Route::get('/ranting/create', [App\Http\Controllers\RantingController::class, 'createranting']);
    Route::post('/ranting/create', [App\Http\Controllers\RantingController::class, 'storecreateranting']);
    Route::get('/ranting/edit/{id}', [App\Http\Controllers\RantingController::class, 'editranting']);
    Route::post('/ranting/edit/{id}', [App\Http\Controllers\RantingController::class, 'storeeditranting']);
    Route::post('/ranting/delete/{id}', [App\Http\Controllers\RantingController::class, 'deleteranting']);
    Route::get('/ranting/pcabyvillages/{id}', [App\Http\Controllers\PcaController::class, 'pcaByvillages']);
    /*------------------10.AUM-----------------------------------------------*/
    Route::get('/aum', [App\Http\Controllers\AumController::class, 'aumindex']);
    Route::get('/aum/create', [App\Http\Controllers\AumController::class, 'createaum']);
    Route::post('/aum/create', [App\Http\Controllers\AumController::class, 'storecreateaum']);
    Route::get('/aum/edit/{id}', [App\Http\Controllers\Aumcontroller::class, 'editaum']);
    Route::post('/aum/edit/{id}', [App\Http\Controllers\AumController::class, 'storeeditaum']);
    Route::post('/aum/delete/{id}', [App\Http\Controllers\AumController::class, 'deleteaum']);
    Route::get('/aum/aumbyranting', [App\Http\Controllers\AumController::class, 'aumbyranting']);
    Route::get('/aum/aumbypca', [App\Http\Controllers\AumController::class, 'aumbypca']);
    Route::get('/aum/aumbypda', [App\Http\Controllers\AumController::class, 'aumbypda']);
    /*------------------11.News-----------------------------------------------*/
    Route::get('/newscategory', [App\Http\Controllers\NewsCategoryController::class, 'categoryindex']);
    Route::get('/newscategory/create', [App\Http\Controllers\NewsCategoryController::class, 'createcategory']);
    Route::post('/newscategory/create', [App\Http\Controllers\NewsCategoryController::class, 'storecreatecategory']);
    Route::get('/newscategory/edit/{id}', [App\Http\Controllers\NewsCategoryController::class, 'editcategory']);
    Route::post('/newscategory/edit/{id}', [App\Http\Controllers\NewsCategoryController::class, 'storeeditcategory']);
    Route::post('/newscategory/delete/{id}', [App\Http\Controllers\NewsCategoryController::class, 'deletecategory']);

    Route::get('/post', [App\Http\Controllers\NewsController::class, 'postindex']);
    Route::get('/post/create', [App\Http\Controllers\NewsController::class, 'createpost']);
    Route::post('/post/create', [App\Http\Controllers\NewsController::class, 'storecreatepost']);
    Route::get('/post/edit/{id}', [App\Http\Controllers\NewsController::class, 'editpost']);
    Route::post('/post/edit/{id}', [App\Http\Controllers\NewsController::class, 'storeeditpost']);
    Route::post('/post/delete/{id}', [App\Http\Controllers\NewsController::class, 'deletepost']);

     /*------------------12.Proker-----------------------------------------------*/
     Route::get('/periode', [App\Http\Controllers\ProgramKerjaController::class, 'periodeindex']);
     Route::get('/periode/create', [App\Http\Controllers\ProgramKerjaController::class, 'createperiode']);
     Route::post('/periode/create', [App\Http\Controllers\ProgramKerjaController::class, 'storecreateperiode']);

     Route::get('/proker', [App\Http\Controllers\ProgramKerjaController::class, 'prokerindex']);
     Route::get('/proker/create', [App\Http\Controllers\ProgramKerjaController::class, 'createproker']);
     Route::post('/proker/create', [App\Http\Controllers\ProgramKerjaController::class, 'storecreateproker']);

});
