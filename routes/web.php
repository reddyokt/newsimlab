<?php

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


/*----------------------------------Daftar Penelitian-----------------------------------------------------------*/
Route::get('form-daftar-penelitian/{id}', [App\Http\Controllers\LandingPageController::class, 'formPenelitian'])->name('formPenelitian');



Route::get('index/{locale}', [App\Http\Controllers\HomeController::class, 'lang']);
Route::post('/formsubmit', [App\Http\Controllers\HomeController::class, 'FormSubmit'])->name('FormSubmit');

Route::post('/postlogin', [App\Http\Controllers\AuthenticationController::class, 'postLogin'])->name('authentication.login.post');
// Route::get('/pageChangePassword', [App\Http\Controllers\AuthenticationController::class, 'pageChangePassword']);
Route::post('/postmustchangepassword', [App\Http\Controllers\AuthenticationController::class, 'mustChangePassword']);


Route::get('/', [App\Http\Controllers\LandingPageController::class, 'index']);

Route::group(['middleware' => 'prevent-back-history'], function () {

    Route::get('login', [App\Http\Controllers\AuthenticationController::class, 'index'])->name('login');
    Route::post('/logout', [App\Http\Controllers\AuthenticationController::class, 'logout'])->name('logout');

    /* Dashboard */
    Route::middleware('auth:web')->group(function () {
        // Routes that require authentication
        Route::get('dashboard', function () {
            return redirect('dashboard/index');
        });
        Route::get('dashboard/index', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard.index');
        Route::get('dashboard/setrole/{id}', [App\Http\Controllers\DashboardController::class, 'setrole'])->name('dashboard.setrole');
        Route::get('set-language/{lang}', [App\Http\Controllers\DashboardController::class, 'setlanguage'])->name('dashboard.setlanguage');


        /*----------------------------------Master Data-----------------------------------------------------------*/
        /*---------------1.role--------------------------------------*/
        Route::get('/role', [App\Http\Controllers\RoleController::class, 'roleIndex']);
        Route::get('/role/add', [App\Http\Controllers\RoleController::class, 'addRole']);
        Route::post('/role/add', [App\Http\Controllers\RoleController::class, 'storeNewRole']);
        Route::get('/role/edit/{id}', [App\Http\Controllers\RoleController::class, 'roleEdit']);
        Route::post('/role/edit/{id}', [App\Http\Controllers\RoleController::class, 'storeRoleEdit']);
        /*---------------2.account--------------------------------------*/
        Route::get('/account', [App\Http\Controllers\AccountController::class, 'accountIndex']);
        Route::get('/account/create', [App\Http\Controllers\AccountController::class, 'createAccount']);
        Route::post('/account/create', [App\Http\Controllers\AccountController::class, 'storeAccount']);
        Route::get('/account/edit/{id}', [App\Http\Controllers\AccountController::class, 'editAccount']);
        Route::post('/account/edit/{id}', [App\Http\Controllers\AccountController::class, 'updateAccount']);
        Route::get('/account/delete/{id}', [App\Http\Controllers\AccountController::class, 'deleteAccount']);
        Route::get('/account/pda', [App\Http\Controllers\AccountController::class, 'getPDA']);
        Route::get('/account/majelis', [App\Http\Controllers\AccountController::class, 'getMajelis']);
        Route::post('/changepassword', [App\Http\Controllers\AccountController::class, 'changePassword']);
        Route::get('/forgotpassword', [App\Http\Controllers\AuthenticationController::class, 'forgot']);
        Route::post('/forgotpassword', [App\Http\Controllers\AuthenticationController::class, 'forgotPassword']);
        Route::get('/password/reset/{id}', [App\Http\Controllers\AuthenticationController::class, 'resetPassword']);
        Route::post('/password/reset/{id}', [App\Http\Controllers\AuthenticationController::class, 'updatePassword']);
        Route::get('verified/{token}', [App\Http\Controllers\AuthenticationController::class, 'verifiedAccount'])->name('authentication.verifiedAccount');
        Route::get('/profile/{id}', [App\Http\Controllers\AccountController::class, 'profile']);
        Route::post('/profile/edit/{id}', [App\Http\Controllers\AccountController::class, 'editProfile']);


        /*------------------12.Praktikum-----------------------------------------------*/
        Route::get('/periode', [App\Http\Controllers\PraktikumController::class, 'periodeIndex']);
        Route::get('/periode/create', [App\Http\Controllers\PraktikumController::class, 'createPeriode']);
        Route::post('/periode/create', [App\Http\Controllers\PraktikumController::class, 'storePeriode']);
        Route::get('/periode/edit/{id}', [App\Http\Controllers\PraktikumController::class, 'editPeriode']);
        Route::post('/periode/edit/{id}', [App\Http\Controllers\PraktikumController::class, 'storeEditPeriode']);

        Route::get('/kelas', [App\Http\Controllers\PraktikumController::class, 'kelasIndex']);
        Route::get('/kelas/create', [App\Http\Controllers\PraktikumController::class, 'createKelas']);
        Route::post('/kelas/create', [App\Http\Controllers\PraktikumController::class, 'storeKelas']);
        Route::get('/kelas/detail/{id}', [App\Http\Controllers\PraktikumController::class, 'kelasDetail']);
        Route::get('/kelas/edit/{id}', [App\Http\Controllers\PraktikumController::class, 'editKelas']);
        Route::post('/kelas/edit/{id}', [App\Http\Controllers\PraktikumController::class, 'storeEditProker']);
        Route::post('/kelas/aslab/{id}', [App\Http\Controllers\PraktikumController::class, 'storeAslab']);

        Route::get('/kelas/detail/{$id}', [App\Http\Controllers\PraktikumController::class, 'detailKelas'])->name('kelas_detail');
        Route::get('/matkul', [App\Http\Controllers\PraktikumController::class, 'matkulIndex']);
        Route::get('/matkul/create', [App\Http\Controllers\PraktikumController::class, 'createMatkul']);
        Route::post('/matkul/create', [App\Http\Controllers\PraktikumController::class, 'storeMatkul']);
        Route::get('/matkul/edit/{id}', [App\Http\Controllers\PraktikumController::class, 'editMatkul']);
        Route::post('/matkul/edit/{id}', [App\Http\Controllers\PraktikumController::class, 'storeEditMatkul']);
        Route::get('/matkul/kode/{id}', [App\Http\Controllers\PraktikumController::class, 'kodeMatkul']);
        Route::get('/matkul/moduls/{id}', [App\Http\Controllers\PraktikumController::class, 'idModul']);

        /*------------------13.Landing Property-----------------------------------------------*/
        Route::get('/landingproperty', [App\Http\Controllers\LandingPageController::class, 'landingProperty']);
        Route::post('/landingprop/update', [App\Http\Controllers\LandingPageController::class, 'updateProperty']);

        /*------------------Komposisi Nilai-----------------------------------------------*/
        Route::get('/komposisi', [App\Http\Controllers\KomposisiNilaiController::class, 'komposisiIndex']);
        Route::post('/komposisi/edit/{id}', [App\Http\Controllers\KomposisiNilaiController::class, 'editKomposisi']);

        /*------------------Alat Praktikum-----------------------------------------------*/
        Route::get('/alat', [App\Http\Controllers\AlatPraktikumController::class, 'alatIndex']);
        Route::get('/alat/create', [App\Http\Controllers\AlatPraktikumController::class, 'createAlat']);
        Route::post('/alat/create', [App\Http\Controllers\AlatPraktikumController::class, 'storeAlat']);
        Route::get('/alat/edit/{id}', [App\Http\Controllers\AlatPraktikumController::class, 'editlAlat']);
        Route::post('/alat/edit/{id}', [App\Http\Controllers\AlatPraktikumController::class, 'storeEditAlat']);
        Route::get('/alat/detail/{id}', [App\Http\Controllers\AlatPraktikumController::class, 'detailAlat']);
        Route::get('/alat/view/{id_alat}/{sub_id_alat}', [App\Http\Controllers\AlatPraktikumController::class, 'viewAlat'])->name('alat.viewDetail');
        Route::post('/detail/edit/{id1}/{id2}', [App\Http\Controllers\AlatPraktikumController::class, 'editDetailAlat']);
        Route::get('/generate-qrcode/{id}', [App\Http\Controllers\AlatPraktikumController::class, 'generateQRCode']);

        /*------------------Bahan Praktikum-----------------------------------------------*/
        Route::get('/bahan', [App\Http\Controllers\BahanPraktikumController::class, 'bahanIndex']);
        Route::get('/bahan/create', [App\Http\Controllers\BahanPraktikumController::class, 'createBahan']);
        Route::post('/bahan/create', [App\Http\Controllers\BahanPraktikumController::class, 'storeBahan']);

        /*------------------Lokasi/Lemari-----------------------------------------------*/
        Route::get('/lokasi', [App\Http\Controllers\LokasiController::class, 'lokasiIndex']);
        Route::post('/lokasi/create', [App\Http\Controllers\LokasiController::class, 'createLokasi']);
        Route::post('/lemari/create', [App\Http\Controllers\LokasiController::class, 'createLemari']);

        /*------------------Modul Praktikum-----------------------------------------------*/
        Route::get('/modul', [App\Http\Controllers\ModulPraktikumController::class, 'modulIndex']);
        Route::get('/modul/create', [App\Http\Controllers\ModulPraktikumController::class, 'createModul']);
        Route::post('/modul/create', [App\Http\Controllers\ModulPraktikumController::class, 'storeModul']);
        Route::get('/modul/finish/{id}', [App\Http\Controllers\ModulPraktikumController::class, 'finishModul']);
        Route::post('/modul/finish/{id}', [App\Http\Controllers\ModulPraktikumController::class, 'storeReport']);
        Route::get('/modul/used/{id}', [App\Http\Controllers\ModulPraktikumController::class, 'useModul']);
        Route::get('/tanggal/create/{id}', [App\Http\Controllers\ModulPraktikumController::class, 'createTanggal']);
        Route::post('/tanggal/create/{id}', [App\Http\Controllers\ModulPraktikumController::class, 'storeTanggal']);
        Route::get('/tanggal/edit/{id}', [App\Http\Controllers\ModulPraktikumController::class, 'editTanggal']);
        Route::post('/tanggal/edit/{id}', [App\Http\Controllers\ModulPraktikumController::class, 'storeEditTanggal']);

        /*------------------Praktikan Peserta-----------------------------------------------*/
        Route::get('/peserta', [App\Http\Controllers\PraktikanController::class, 'pesertaIndex']);
        Route::post('/peserta/import', [App\Http\Controllers\PraktikanController::class, 'import']);

        /*------------------Praktikan Kelompok-----------------------------------------------*/
        Route::get('/kelompok', [App\Http\Controllers\PraktikanController::class, 'kelompokIndex']);
        Route::post('/kelompok/create', [App\Http\Controllers\PraktikanController::class, 'storeKelompok']);
        Route::get('/kelompok/edit/{id}', [App\Http\Controllers\PraktikanController::class, 'editKelompok']);
        Route::post('/kelompok/tambahmhs/{id}', [App\Http\Controllers\PraktikanController::class, 'tambahMhs']);
        Route::get('/kelompok/deletemhs/{id}', [App\Http\Controllers\PraktikanController::class, 'deleteMhs']);
        Route::get('/kelompok/delete/{id}', [App\Http\Controllers\PraktikanController::class, 'hapusKelompok']);

        /*------------------Praktikan Absen-----------------------------------------------*/
        Route::get('/absen', [App\Http\Controllers\AbsenController::class, 'absenIndex']);
        // Route::get('/isiabsen/modul/{id}', [App\Http\Controllers\AbsenController::class, 'isiAbsen']);
        Route::post('/absen/modul/{id}', [App\Http\Controllers\AbsenController::class, 'storeAbsen']);
        Route::post('/rekap', [App\Http\Controllers\AbsenController::class, 'rekapAbsen']);

        /*------------------Asisten Lab-----------------------------------------------*/
        Route::get('/aslab', [App\Http\Controllers\AslabController::class, 'aslabIndex']);
        Route::get('/aslab/create', [App\Http\Controllers\AslabController::class, 'createAslab']);
        Route::post('/aslab/create', [App\Http\Controllers\AslabController::class, 'storeAslab']);

        /*------------------Laboran-----------------------------------------------*/
        Route::get('/laboran', [App\Http\Controllers\LaboranController::class, 'laboranIndex']);
        Route::get('/laboran/create', [App\Http\Controllers\LaboranController::class, 'createLaboran']);
        Route::post('/laboran/create', [App\Http\Controllers\LaboranController::class, 'storeLaboran']);

        /*------------------Dosen Lab-----------------------------------------------*/
        Route::get('/dosen', [App\Http\Controllers\DosenController::class, 'dosenIndex']);
        Route::get('/dosen/create', [App\Http\Controllers\DosenController::class, 'createDosen']);
        Route::post('/dosen/create', [App\Http\Controllers\DosenController::class, 'storeDosen']);

        /*------------------Ujian-----------------------------------------------*/
        Route::get('/ujian/create/{id}', [App\Http\Controllers\UjianController::class, 'createUjian']);
        Route::post('/ujian/create/{id}', [App\Http\Controllers\UjianController::class, 'storeUjian']);
        Route::get('/ujian/detail/{id}', [App\Http\Controllers\UjianController::class, 'detailUjian']);

        /*------------------Tugas-----------------------------------------------*/
        Route::get('/tugas/create/{id}', [App\Http\Controllers\TugasController::class, 'createTugas']);
        Route::post('/tugas/create/{id}', [App\Http\Controllers\TugasController::class, 'storeTugas']);
        Route::get('/tugas/detail/{id}', [App\Http\Controllers\TugasController::class, 'detailTugas']);
        Route::get('/mhs/tugas/detail/{id}', [App\Http\Controllers\TugasController::class, 'detailTugasMhs']);
        Route::post('/mhs/tugas/jawab/{id}', [App\Http\Controllers\TugasController::class, 'mhsJawabTugas']);
        Route::post('/tugas/validasi/{id}', [App\Http\Controllers\TugasController::class, 'validasiTugas']);
        Route::get('/tugas/publishTugas/{id}', [App\Http\Controllers\TugasController::class, 'publishTugas']);
        Route::post('/tugas/takeDown/{id}', [App\Http\Controllers\TugasController::class, 'takeDownTugas'])->name('takedowntugas');

        /*------------------Penilaian Tugas-----------------------------------------------*/
        Route::get('/nilaitugas', [App\Http\Controllers\NilaiTugasController::class, 'nilaiTugas']);
        Route::get('/nilaitugas/modul/{id}', [App\Http\Controllers\NilaiTugasController::class, 'nilaiTugasByModul']);
        Route::get('nilaitugas/mhs/', [App\Http\Controllers\NilaiTugasController::class, 'detailJawaban'])->name('nilaitugaspermodul');
        Route::post('tugas/isinilai/{id}', [App\Http\Controllers\NilaiTugasController::class, 'isiNilaiTugas']);
        Route::post('subjektif/isinilai/{id}', [App\Http\Controllers\NilaiTugasController::class, 'isiNilaiSubjektif']);

        /*------------------Penilaian Ujian-----------------------------------------------*/
        Route::get('/nilaiujian', [App\Http\Controllers\NilaiUjianController::class, 'nilaiUjian']);
        Route::get('/nilaiujian/kelas/{id}', [App\Http\Controllers\NilaiUjianController::class, 'nilaiUjianbyKelas']);
        Route::get('/nilaiujian/mhs/', [App\Http\Controllers\NilaiUjianController::class, 'detailJawaban'])->name('nilaiujianperkelas');
        Route::post('/ujian/isinilai/{id}', [App\Http\Controllers\NilaiUjianController::class, 'isiNilaiUjian']);
        Route::post('/ujian/isinilailisan/{id}', [App\Http\Controllers\NilaiUjianController::class, 'isiNilaiLisan']);

        /*------------------Penilaian Ujian-----------------------------------------------*/
        Route::get('/nilaiakhir', [App\Http\Controllers\KomposisiNilaiController::class, 'indexPenilaianAkhir']);
        Route::post('/nilaiakhir/byperiode', [App\Http\Controllers\KomposisiNilaiController::class, 'nilaiAkhirByPeriode'])->name('nilaiakhirbyperiode');

        /*------------------Analisa-----------------------------------------------*/
        Route::get('/analisa', [App\Http\Controllers\TransaksiController::class, 'indexAnalisa']);
        Route::get('/penelitian', [App\Http\Controllers\TransaksiController::class, 'indexPenelitian']);

        /*------------------Pertemuan-----------------------------------------------*/
        Route::get('/pertemuan/edit/{id}', [App\Http\Controllers\PertemuanController::class, 'editPertemuan']);



    });
});
