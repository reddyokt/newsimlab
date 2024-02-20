<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Models\UserSetting;
use Illuminate\Support\Facades\App;
use SebastianBergmann\Type\NullType;

class AuthenticationController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return redirect()->intended('/dashboard');
        } else {
            return view('authentication.login');
        }
    }

    // public function forgot(){
    //     return view('authentication.forgot');
    // }

    // function forgotPassword(Request $request){
    // 	$input = $request->all();

    //     if($input['email'] !== null){

    //         $data = User::where('email', $input['email'])->first();
    //         if($data !== null){

    //             $token =  Str::random(32);
    //             $tempPass = Str::random(8);
    //             $data->password = Hash::make($tempPass);
    //             $data->reset_password_token = $token;
    //             $data->save();

    //             $to_name = $data->nama_lengkap;
    //             $to_email = $data->email;
    //             $pass = $tempPass;
    //             $data = array('to_name'=>$to_name, "name" => Session::get('nama'), 'url'=>url('newpassword/'.$token));
    //             Mail::send("mail.mailforgotpassword", $data, function($message) use ($to_name, $to_email) {
    //                 $message->to($to_email, $to_name)->subject('Reset Password');
    //                 $message->from(config('mail.from.address'),config('mail.from.name'));
    //             });

    //             // Response to Ajax
    //             return response()->json([
    //                 "status" => true,
    //                 "message" => 'Silahkan cek email Anda!',
    //                 "redirect_url" => url('login')
    //             ]);

    //         } else {
    //             return response()->json([
    //                 "status" => false,
    //                 "message" => 'Email yang Anda masukkan tidak terdaftar!',
    //             ]);
    //         }
    //     } else {
    //         return response()->json([
    //             "status" => false,
    //             "message" => 'Silakan isi email untuk mengatur kata sandi baru!',
    //         ]);
    //     }
    // }

    // function newPassword($token){
    //     $data = User::where('reset_password_token', $token)->first();
    //     if($data !== null){
    //         return view('authentication.newpassword', compact('token'));
    //     } else {
    //         return view('error.404');
    //     }
    // }

    // function updatePassword(Request $request){
    //     $input = $request->all();

    //     if($input['new_password_one'] !== null && $input['new_password_two'] !== null){

    //         if( strlen($input['new_password_one']) >= 8 ){

    //             if( strlen($input['new_password_two']) >= 8 ){

    //                 if($input['new_password_one'] == $input['new_password_two'] ){
    //                     $data = User::where('reset_password_token', $input['token_forgotpassword'])->first();
    //                     $new_password = Hash::make($input['new_password_one']);
    //                     $data->password = $new_password;
    //                     $data->reset_password_token = null;
    //                     $data->updated_at = date('Y-m-d H:i:s');
    //                     $data->save();

    //                     // Response to Ajax
    //                     return response()->json([
    //                         "status" => true,
    //                         "message" => 'Ganti password berhasil!',
    //                         "redirect_url" => url('login')
    //                     ]);

    //                 } else {
    //                     return response()->json([
    //                         "status" => false,
    //                         "message" => 'Gagal, password baru dan konfirmasi password baru harus sama!',
    //                     ]);
    //                 }

    //             } else {
    //                 return response()->json([
    //                     "status" => false,
    //                     "message" => 'Minimal karakter untuk password baru adalah 8 digit!',
    //                 ]);
    //             }

    //         } else {
    //             return response()->json([
    //                 "status" => false,
    //                 "message" => 'Minimal karakter untuk password baru adalah 8 digit!',
    //             ]);
    //         }

    //     } else {
    //         return response()->json([
    //             "status" => false,
    //             "message" => 'Silakan isi isian yang diperlukan untuk membuat kata sandi baru!',
    //         ]);
    //     }
    // }

    // public function changePassword(){
    //     $user_id = Session::get('user_id');

    //     $data = DB::table('user')
    //             ->where('user.user_id', $user_id)
    //             ->first();

    //     return view('authentication.forgotpassword', compact('data'));
    // }

    // function postNewPassword(Request $request){
    //     $user_id = Session::get('user_id');
    //     $input = $request->all();

    //     if($input['new_password'] !== null && $input['new_password_confirm'] !== null){

    //         if( strlen($input['new_password']) >= 8 ){

    //             if( strlen($input['new_password_confirm']) >= 8 ){

    //                 if($input['new_password'] == $input['new_password_confirm'] ){
    //                     $data = User::where('user_id', $user_id)->first();

    //                     if(password_verify($input['old_password'], $data->password)){
    //                         $new_password = Hash::make($input['new_password']);
    //                         $data->password = $new_password;
    //                         $data->updated_at = date('Y-m-d H:i:s');
    //                         $data->save();

    //                         // Response to Ajax
    //                         return response()->json([
    //                             "status" => true,
    //                             "message" => __('dashboard.msg_changepassword_success1'),
    //                             "redirect_url" => route("authentication.changePassword")
    //                         ]);
    //                     } else {
    //                         return response()->json([
    //                             "status" => false,
    //                             "message" => __('dashboard.msg_changepassword_success5'),
    //                         ]);
    //                     }

    //                 } else {
    //                     return response()->json([
    //                         "status" => false,
    //                         "message" => __('dashboard.msg_changepassword_success2'),
    //                     ]);
    //                 }

    //             } else {
    //                 return response()->json([
    //                     "status" => false,
    //                     "message" => __('dashboard.msg_changepassword_success3'),
    //                 ]);
    //             }

    //         } else {
    //             return response()->json([
    //                 "status" => false,
    //                 "message" => __('dashboard.msg_changepassword_success3'),
    //             ]);
    //         }

    //     } else {
    //         return response()->json([
    //             "status" => false,
    //             "message" => __('dashboard.msg_changepassword_success4'),
    //         ]);
    //     }
    // }

    public function postLogin(Request $request)
    {

        // dd($request);
        date_default_timezone_set('Asia/Jakarta');
        $username = $request->username;
        $password = $request->password;

        $data = DB::table('user')->where('user.username', $username)
            ->whereNull('user.delete_at')
            ->where('user.isActive', 'Y')
            ->first();

        $login = Auth::attempt(['username' => $username, 'password' => $password]);

        if ($data != null) { //apakah user tersebut ada atau tidak
            if (Hash::check($password, $data->password)) {
                // define user settings
                $userSetting = UserSetting::where(
                    'user_id',
                    $data->user_id
                )->whereNull('deleted_at')
                    ->first();

                //get role name
                $dataRole = DB::table('user_role')
                    ->join('user', 'user.user_id', '=', 'user_role.user_id')
                    ->join('roles', 'roles.id', '=', 'user_role.role_id')
                    ->where('user.user_id', '=', $data->user_id)
                    ->select(DB::raw('roles.role_name, roles.CODE, roles.id'))
                    ->first();

                $menu = array();

                $dataMenu = DB::table('menu')
                    ->join('role_menu', 'role_menu.menu_id', '=', 'menu.menu_id')
                    ->where('role_menu.role_id', $dataRole->id)
                    ->whereNull('menu.deleted_at')
                    ->select(DB::raw('menu.code'))
                    ->get()->toArray();
                foreach ($dataMenu as $key => $value) {
                    $menu[$key] = $value->code;
                }

                //put all data needed in session
                Session::put('user_id', $data->user_id);
                Session::put('name', $data->name);
                Session::put('email', $data->email);
                Session::put('menu', $menu);
                Session::put('roles', $dataRole);
                // Session::put('role_other', $role_other_data);
                Session::put('role_id', $dataRole->id);
                Session::put('role_name', $dataRole->role_name);
                Session::put('role_code', $dataRole->CODE);
                Session::put('picture', $data->profile_picture);
                Session::put('username', $data->username);
                Session::put('password', $data->password);
                // Session::put('settings', $userSetting->default_settings);
                Session::put('login', TRUE);
                // Session::put('dpc_id', $data->dpc_id);
                // Session::put('dpd_id', $data->dpd_id);

                // dd(Session::get('menu'));

                $arrsetting = explode('|', $userSetting->default_settings);
                \App::setlocale($arrsetting[count($arrsetting) - 1]);
                Session::put('locale', $arrsetting[count($arrsetting) - 1]);

                //redirect to main page
                return redirect('/dashboard/index')->with('success', 'Login Sukses');
            } else {
                return redirect('/login')->with('error', 'Password atau Username, Salah!');
            }
        } else {
            return redirect('/login')->with('error', 'Password atau Username, Salah!');
        }
    }

    // public function updateUserSetting(Request $request){
    //     $user_id = $request->user_id;
    //     $settings = $request->settings;

    //     $userSetting = UserSetting::where('user_id', $user_id)
    //         ->update([
    //             'default_settings'=>$settings
    //         ]);
    //     //store in current session
    //     Session::put('settings', $settings);

    //     return $userSetting;
    // }

    // function registrationPage($token){
    //     $periodePBL = PeriodePBL::where('token_periode_pbl',$token)->first();
    //     if($periodePBL == null){
    //         return redirect('error/404'); // response()->json(['status'=>false,'message'=>'Periode PBL tidak sesuai']);
    //     }
    //     $fakultas = Fakultas::whereNull('delete_at')->get()->toArray();

    //     $provinsi = Provinsi::all()->toArray();
    //     $mahasiswa = Mahasiswa::whereNull('delete_at')->get()->toArray();
    //     $peminatan = PeminatanPBL::whereNull('delete_at')->get()->toArray();
    //     $periode = PeriodePBL::where('token_periode_pbl',$token)->first();

    // 	return view('authentication.register', compact('fakultas','token','peminatan','mahasiswa','periode','provinsi'));
    // }

    // function postRegistration(Request $request){
    //     date_default_timezone_set('Asia/Jakarta');
    //     $req = $request->all();
    //     // dd($req);

    //     //get Periode PBL ID
    //     $periodePBL = PeriodePBL::where('token_periode_pbl',$req['token_periode_pbl'])->first();
    //     if($periodePBL == null){
    //         return response()->json(['status'=>false,'message'=>'Periode PBL tidak sesuai']);
    //     }

    //     $name = '';
    //     $email = '';
    //     $daftar = null;

    //     if($req['mahasiswa'] == null && $req['val_nama'] == null){
    //         return response()->json(['status'=>false,'message'=>'Silahkan pilih NIM Mahasiswa terlebih dahulu']);
    //     } else if ($req['provinsi'] == null){
    //         return response()->json(['status'=>false,'message'=>'Silahkan pilih Provinsi terlebih dahulu']);
    //     } else if ($req['email'] == null){
    //         return response()->json(['status'=>false,'message'=>'Silahkan isi Email terlebih dahulu']);
    //     } else if ($req['kabupaten_kota'] == null){
    //         return response()->json(['status'=>false,'message'=>'Silahkan pilih kabupaten/Kota terlebih dahulu']);
    //     } else if ($req['kecamatan'] == null){
    //         return response()->json(['status'=>false,'message'=>'Silahkan pilih Kecamatan terlebih dahulu']);
    //     } else if ($req['desa'] == null){
    //         return response()->json(['status'=>false,'message'=>'Silahkan pilih Desa terlebih dahulu']);
    //     } else if ($req['skema_pembayaran'] == null){
    //         return response()->json(['status'=>false,'message'=>'Silahkan pilih Skema Pembayaran terlebih dahulu']);
    //     }

    //     //save data mahasiswa
    //     if(empty($req['nim'])){
    //         $pendaftaran = PendaftaranPBL::where([
    //             'periode_pbl_id'=>$periodePBL->periode_pbl_id,
    //             'mahasiswa_id'=>$req['mahasiswa']
    //         ])->whereNull('delete_at')->first();

    //         if($pendaftaran != null){
    //             return response()->json(['status'=>false,'message'=>'NIM sudah terdaftar']);
    //         }
    //         // $userEmail = User::where('email',$req['email'])->first();
    //         // if($userEmail != null){
    //         //     return response()->json(['status'=>false,'message'=>'Email sudah terdaftar']);
    //         // }

    //         //1. Get first word in name
    //         $username = strtolower(explode(" ", $req['val_nama'])[0]);
    //         $username = $username.''.$this->generateRandomString(5);
    //         $password = 'qwerty';

    //         $filename = null;
    //         $filename2 = null;
    //         $filename3 = null;
    //         $user_id = null;

    //         if($request->file('profile_picture')!=null){
    //             if(!in_array($request->file('profile_picture')->getClientOriginalExtension(), ['JPG','PNG', 'jpg','png'])){
    //                 return response()->json([
    //                     "status" => false,
    //                     'message'=>'Berkas foto profil harus dengan ekstensi JPG atau PNG!'
    //                 ], 200);
    //             }

    //             if($request->file('profile_picture')->getSize() < 1048576 ){
    //                 if($request->file('profile_picture')->isValid()){
    //                     $filename = 'PP_'.$username.'.'.strtolower($request->file('profile_picture')->getClientOriginalExtension());
    //                     $request->file('profile_picture')->move(
    //                         base_path() . '/public/upload/profile_picture/', $filename
    //                     );
    //                 }
    //             } else {
    //                 return response()->json([
    //                     "status" => false,
    //                     'message'=>'Maksimal size berkas foto profil adalah 1 MB!'
    //                 ], 200);
    //             }
    //         }else{
    //             return response()->json(['status'=>false,'message'=>'Foto harus diupload']);
    //         }


    //         if($request->file('bukti_khs')!=null){
    //             if(!in_array($request->file('bukti_khs')->getClientOriginalExtension(), ['PDF', 'JPG','PNG', 'pdf', 'jpg','png'])){
    //                 return response()->json([
    //                     "status" => false,
    //                     'message'=>'Berkas bukti khs harus dengan ekstensi PDF, JPG atau PNG!'
    //                 ], 200);
    //             }

    //             if($request->file('bukti_khs')->getSize() < 2097152 ){
    //                 if($request->file('bukti_khs')->isValid()){
    //                     $filename2 = 'BuktiKHS_'.$username.'.'.strtolower($request->file('bukti_khs')->getClientOriginalExtension());
    //                     $request->file('bukti_khs')->move(
    //                         base_path() . '/public/upload/bukti_khs/', $filename2
    //                     );
    //                 }
    //             } else {
    //                 return response()->json([
    //                     "status" => false,
    //                     'message'=>'Maksimal size berkas bukti khs adalah 2 MB!'
    //                 ], 200);
    //             }
    //         }else{
    //             return response()->json(['status'=>false,'message'=>'Bukti KHS harus diupload']);
    //         }

    //         if($request->file('bukti_pembayaran')!=null){
    //             if(!in_array($request->file('bukti_pembayaran')->getClientOriginalExtension(), ['JPG','PNG', 'jpg','png'])){
    //                 return response()->json([
    //                     "status" => false,
    //                     'message'=>'Berkas bukti pembayaran harus dengan ekstensi JPG atau PNG!'
    //                 ], 200);
    //             }

    //             if($request->file('bukti_pembayaran')->getSize() < 2097152 ){
    //                 if($request->file('bukti_pembayaran')->isValid()){
    //                     $filename3 = 'BuktiBayar_'.$username.'.'.strtolower($request->file('bukti_pembayaran')->getClientOriginalExtension());
    //                     $request->file('bukti_pembayaran')->move(
    //                         base_path() . '/public/upload/bukti_pembayaran/', $filename3
    //                     );
    //                 }
    //             } else {
    //                 return response()->json([
    //                     "status" => false,
    //                     'message'=>'Maksimal size berkas bukti pembayaran adalah 2 MB!'
    //                 ], 200);
    //             }
    //         }else{
    //             return response()->json(['status'=>false,'message'=>'Bukti Pembayaran harus diupload']);
    //         }

    //         //2. create data mahasiswa in table User
    //         $mhs = Mahasiswa::where('mahasiswa_id', $req['mahasiswa'])->first();

    //         if($mhs->user_id == null){
    //             $user = new User;
    //             $user->username = $mhs->nim;
    //             $user->password = Hash::make($password);
    //             $user->email = $req['email'];
    //             $user->name = strtoupper($req['val_nama']);
    //             $user->profile_picture = $filename;
    //             $user->created_by = $req['val_nama'];
    //             $user->created_at = date('Y-m-d H:i:s');
    //             $user->save();

    //             $user_id = $user->user_id;

    //             //4. Add to User Role and User Setting
    //             $userRole = new UserRole;
    //             $userRole->role_id = Role::MAHASISWA_ID;
    //             $userRole->user_id = $user->user_id;
    //             $userRole->created_by = $req['val_nama'];
    //             $userRole->created_at = date('Y-m-d H:i:s');
    //             $userRole->save();

    //             $userSetting = new UserSettings;
    //             $userSetting->user_id = $user->user_id;
    //             $userSetting->created_by = $req['val_nama'];
    //             $userSetting->created_at = date('Y-m-d H:i:s');
    //             $userSetting->save();
    //         }else{
    //             $user_id = $mhs->user_id;
    //             $users = User::where('user_id', $user_id)->first();
    //             $users->email = $req['email'];
    //             $user->profile_picture = $filename;
    //             $users->save();
    //         }

    //         $name = strtoupper($req['val_nama']);
    //         $email = $req['email'];

    //         //3. Update to table mahasiswa
    //         $mahasiswa = Mahasiswa::where('mahasiswa_id', $req['mahasiswa'])->first();
    //         $mahasiswa->provinsi_id = $req['provinsi'];
    //         $mahasiswa->kota_id = $req['kabupaten_kota'];
    //         $mahasiswa->kecamatan_id = $req['kecamatan'];
    //         $mahasiswa->desa_id = $req['desa'];
    //         $mahasiswa->user_id = $user_id;
    //         $mahasiswa->nama = strtoupper($req['val_nama']);
    //         // $mahasiswa->no_hp = $req['no_hp'];
    //         $mahasiswa->updated_by = $req['val_nama'];
    //         $mahasiswa->updated_at = date('Y-m-d H:i:s');
    //         $mahasiswa->save();

    //         //5. Add to Pendaftaran PBL
    //         $pendaftaran = new PendaftaranPBL;
    //         $pendaftaran->periode_pbl_id = $periodePBL->periode_pbl_id;
    //         $pendaftaran->mahasiswa_id = $mahasiswa->mahasiswa_id;
    //         $pendaftaran->peminatan_pbl_id = $req['peminatan'];
    //         $pendaftaran->sudah_lunas = $req['skema_pembayaran'] == 'cash' ? 'Y':'N';
    //         $pendaftaran->skema_pembayaran = $req['skema_pembayaran'];
    //         $pendaftaran->tgl_pendaftaran = date('Y-m-d');
    //         // $pendaftaran->kode_pembayaran = Pembayaran::CODE.'-'.date('Ymdhis').'-'.strtoupper($this->generateRandomString(4));
    //         $pendaftaran->created_by = $req['val_nama'];
    //         $pendaftaran->created_at = date('Y-m-d H:i:s');
    //         $pendaftaran->save();

    //         //6. Add to Berkas Pendaftaran PBL
    //         $berkasPendaftaran = new BerkasPendaftaran;
    //         $berkasPendaftaran->pendaftaran_pbl_id = $pendaftaran->pendaftaran_pbl_id;
    //         $berkasPendaftaran->periode_pbl_id = $periodePBL->periode_pbl_id;
    //         $berkasPendaftaran->mahasiswa_id = $mahasiswa->mahasiswa_id;
    //         $berkasPendaftaran->profile_picture = $filename;
    //         $berkasPendaftaran->bukti_khs = $filename2;
    //         $berkasPendaftaran->bukti_pembayaran = $filename3;
    //         $berkasPendaftaran->created_by = $req['val_nama'];
    //         $berkasPendaftaran->created_at = date('Y-m-d H:i:s');
    //         $berkasPendaftaran->save();

    //         $order = DB::table('pendaftaran_pbl')
    //             ->join('mahasiswa','mahasiswa.mahasiswa_id','=','pendaftaran_pbl.mahasiswa_id')
    //             ->join('user','user.user_id','=','mahasiswa.user_id')
    //             ->join('periode_pbl','periode_pbl.periode_pbl_id','=','pendaftaran_pbl.periode_pbl_id')
    //             ->whereNull('mahasiswa.delete_at')
    //             ->where('pendaftaran_pbl.pendaftaran_pbl_id', $pendaftaran->pendaftaran_pbl_id)
    //             ->select(DB::raw('mahasiswa.nama, user.email, pendaftaran_pbl.created_at, harga_periode_pbl')) // mahasiswa.no_hp,
    //             ->first();

    //         // $this->generatePaymentToken($order, $req['skema_pembayaran']);

    //         $daftar = $pendaftaran->pendaftaran_pbl_id;
    //     }else{
    //         $filename = null;
    //         $filename3 = null;
    //         $filename2 = null;
    //         $user_id = null;

    //         $mhs = Mahasiswa::where([
    //             'nim'=>$req['nim']
    //         ])->whereNull('delete_at')->first();

    //         if($mhs!=null){
    //             $mhs_id = $mhs->mahasiswa_id;
    //             $user_id = $mhs->user_id;

    //             $pendaftaran = PendaftaranPBL::where([
    //                 'periode_pbl_id'=>$periodePBL->periode_pbl_id,
    //                 'mahasiswa_id'=>$mhs_id
    //             ])->whereNull('delete_at')->first();

    //             if($pendaftaran != null){
    //                 return response()->json(['status'=>false,'message'=>'NIM sudah terdaftar']);
    //             }
    //         }

    //         //1. Get first word in name
    //         $username = strtolower(explode(" ", $req['val_nama'])[0]);
    //         $username = $username.''.$this->generateRandomString(5);
    //         $password = 'qwerty';

    //         if($request->file('profile_picture')!=null){
    //             if($request->hasFile('profile_picture')){
    //                 if($request->file('profile_picture')->isValid()){
    //                     $filename = 'PP_'.$username.'.'.strtolower($request->file('profile_picture')->getClientOriginalExtension());
    //                     $request->file('profile_picture')->move(
    //                         base_path() . '/public/upload/profile_picture/', $filename
    //                     );
    //                 }
    //             }
    //         }else{
    //             return response()->json(['status'=>false,'message'=>'Foto harus diupload']);
    //         }

    //         if($request->file('bukti_khs')!=null){
    //             if($request->hasFile('bukti_khs')){
    //                 if($request->file('bukti_khs')->isValid()){
    //                     $filename2 = 'BuktiKHS_'.$username.'.'.strtolower($request->file('bukti_khs')->getClientOriginalExtension());
    //                     $request->file('bukti_khs')->move(
    //                         base_path() . '/public/upload/bukti_khs/', $filename2
    //                     );
    //                 }
    //             }
    //         }else{
    //             return response()->json(['status'=>false,'message'=>'Bukti KHS harus diupload']);
    //         }

    //         if($request->file('bukti_pembayaran')!=null){
    //             if($request->hasFile('bukti_pembayaran')){
    //                 if($request->file('bukti_pembayaran')->isValid()){
    //                     $filename3 = 'BuktiBayar_'.$username.'.'.strtolower($request->file('bukti_pembayaran')->getClientOriginalExtension());
    //                     $request->file('bukti_pembayaran')->move(
    //                         base_path() . '/public/upload/bukti_pembayaran/', $filename3
    //                     );
    //                 }
    //             }
    //         }else{
    //             return response()->json(['status'=>false,'message'=>'Bukti Pembayaran harus diupload']);
    //         }

    //         //2. create data mahasiswa in table User
    //         if($user_id == null){
    //             $user = new User;
    //             $user->username = $req['nim'];
    //             $user->password = Hash::make($password);
    //             $user->email = $req['email'];
    //             $user->name = strtoupper($req['val_nama']);
    //             $user->profile_picture = $filename;
    //             $user->created_by = $req['val_nama'];
    //             $user->created_at = date('Y-m-d H:i:s');
    //             $user->save();

    //             $user_id = $user->user_id;

    //             //4. Add to User Role and User Setting
    //             $userRole = new UserRole;
    //             $userRole->role_id = 4;
    //             $userRole->user_id = $user->user_id;
    //             $userRole->created_by = $req['val_nama'];
    //             $userRole->created_at = date('Y-m-d H:i:s');
    //             $userRole->save();

    //             $userSetting = new UserSettings;
    //             $userSetting->user_id = $user->user_id;
    //             $userSetting->created_by = $req['val_nama'];
    //             $userSetting->created_at = date('Y-m-d H:i:s');
    //             $userSetting->save();
    //         }else{
    //             $user_id = $mhs->user_id;
    //             $users = User::where('user_id', $user_id)->first();
    //             $users->email = $req['email'];
    //             $user->profile_picture = $filename;
    //             $users->save();
    //         }

    //         $name = strtoupper($req['val_nama']);
    //         $email = $req['email'];

    //         //3. Update to table mahasiswa
    //         $mahasiswa = new Mahasiswa;
    //         $mahasiswa->nim = $req['nim'];
    //         $mahasiswa->nama = strtoupper($req['val_nama']);
    //         $mahasiswa->prodi_id = $req['prodi'];
    //         $mahasiswa->provinsi_id = $req['provinsi'];
    //         $mahasiswa->kota_id = $req['kabupaten_kota'];
    //         $mahasiswa->kecamatan_id = $req['kecamatan'];
    //         $mahasiswa->desa_id = $req['desa'];
    //         $mahasiswa->user_id = $user_id;
    //         // $mahasiswa->no_hp = $req['no_hp'];
    //         $mahasiswa->created_by = $req['val_nama'];
    //         $mahasiswa->created_at = date('Y-m-d H:i:s');
    //         $mahasiswa->save();

    //         //5. Add to Pendaftaran PBL
    //         $pendaftaran = new PendaftaranPBL;
    //         $pendaftaran->periode_pbl_id = $periodePBL->periode_pbl_id;
    //         $pendaftaran->mahasiswa_id = $mahasiswa->mahasiswa_id;
    //         $pendaftaran->peminatan_pbl_id = $req['peminatan'];
    //         $pendaftaran->sudah_lunas = $req['skema_pembayaran'] == 'cash' ? 'Y':'N';
    //         $pendaftaran->skema_pembayaran = $req['skema_pembayaran'];
    //         $pendaftaran->tgl_pendaftaran = date('Y-m-d');
    //         // $pendaftaran->kode_pembayaran = Pembayaran::CODE.'-'.date('Ymdhis').'-'.strtoupper($this->generateRandomString(4));
    //         $pendaftaran->created_by = $req['val_nama'];
    //         $pendaftaran->created_at = date('Y-m-d H:i:s');
    //         $pendaftaran->save();

    //         //6. Add to Berkas Pendaftaran PBL
    //         $berkasPendaftaran = new BerkasPendaftaran;
    //         $berkasPendaftaran->pendaftaran_pbl_id = $pendaftaran->pendaftaran_pbl_id;
    //         $berkasPendaftaran->periode_pbl_id = $periodePBL->periode_pbl_id;
    //         $berkasPendaftaran->mahasiswa_id = $mahasiswa->mahasiswa_id;
    //         $berkasPendaftaran->profile_picture = $filename;
    //         $berkasPendaftaran->bukti_khs = $filename2;
    //         $berkasPendaftaran->bukti_pembayaran = $filename3;
    //         $berkasPendaftaran->created_by = $req['val_nama'];
    //         $berkasPendaftaran->created_at = date('Y-m-d H:i:s');
    //         $berkasPendaftaran->save();

    //         $order = DB::table('pendaftaran_pbl')
    //             ->join('mahasiswa','mahasiswa.mahasiswa_id','=','pendaftaran_pbl.mahasiswa_id')
    //             ->join('user','user.user_id','=','mahasiswa.user_id')
    //             ->join('periode_pbl','periode_pbl.periode_pbl_id','=','pendaftaran_pbl.periode_pbl_id')
    //             ->whereNull('mahasiswa.delete_at')
    //             ->where('pendaftaran_pbl.pendaftaran_pbl_id', $pendaftaran->pendaftaran_pbl_id)
    //             ->select(DB::raw('mahasiswa.nama, user.email, pendaftaran_pbl.created_at, harga_periode_pbl, kode_pembayaran')) //mahasiswa.no_hp,
    //             ->first();

    //         $daftar = $pendaftaran->pendaftaran_pbl_id;
    //         // $this->generatePaymentToken($order,$req['skema_pembayaran']);
    //     }

    //     $order =  DB::table('pendaftaran_pbl')
    //         ->join('periode_pbl','periode_pbl.periode_pbl_id','=', 'pendaftaran_pbl.periode_pbl_id')
    //         ->select(DB::raw('pendaftaran_pbl.*, url_info'))
    //         ->where('pendaftaran_pbl_id', $daftar)->first();

    //     //send email
    //     $to_name = $name;
    //     $to_email = $email;
    //     $data = array(
    //         'to_name'=>$to_name,
    //         // 'url'=>$order->url_pembayaran,
    //         'url_info'=>$order->url_info
    //     );

    //     /*
    //     Mail::send("mail.mailpendaftaranberhasil", $data, function($message) use ($to_name, $to_email) {
    //         $message->to($to_email, $to_name)->subject('Pendaftaran berhasil');
    //         $message->from(config('mail.from.address'),config('mail.from.name'));
    //     });
    //     */

    //     return response()->json([
    //         'status'=>true,
    //         'message'=>'Anda Telah berhasil mengisi data pendaftaran PBL anda. Silahkan tunggu hingga admin melakukan validasi terhadap data anda dan silahkan Check email yang anda daftarkan secara berkala untuk untuk mengetahui password default login, Minimal 1 Hari setelah Pendaftaran'
    //     ]);
    // }

    public function logout(Request $request)
    {
        Auth::logout();
        Session::flush();
        return redirect('login')->with('error', 'Anda Telah Logout');
    }

    // /**
    //  * Show the form for creating a new resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function create()
    // {
    //     //
    // }

    // /**
    //  * Store a newly created resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
    //  */
    // public function store(Request $request)
    // {
    //     //
    // }

    // function generateRandomString($length = 10) {
    //     $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    //     $charactersLength = strlen($characters);
    //     $randomString = '';
    //     for ($i = 0; $i < $length; $i++) {
    //         $randomString .= $characters[rand(0, $charactersLength - 1)];
    //     }
    //     return $randomString;
    // }

    public function verifiedAccount($token)
    {
        $user = User::where('token_verified', $token)->first();
        if ($user !== null) {
            $user->isActive = 'Y';
            $user->updated_at = date('Y-m-d H:i:s');
            $user->updated_by = Session::get('user_id');
            $user->save();

            return redirect('login');
        } else {
            return redirect('login')->with('alert', 'Gagal melakukan verifikasi akun!');
        }
    }

    // private function initPaymentGateway(){
    //     // Set your Merchant Server Key
    //     \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
    //     // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
    //     \Midtrans\Config::$isProduction = true;
    //     // Set sanitization on (default)
    //     \Midtrans\Config::$isSanitized = true;
    //     // Set 3DS transaction for credit card to true
    //     \Midtrans\Config::$is3ds = true;
    // }

    // private function generatePaymentToken($order, $skema){
    //     $this->initPaymentGateway();

    //     $customer_details = [
    //         'first_name'=>$order->nama,
    //         'email'=>$order->email,
    //         'phone'=>$order->no_hp
    //     ];

    //     $harga_total = 0;
    //     if($skema == 'cash'){
    //         $harga_total = $order->harga_periode_pbl + 5000;
    //     }else{
    //         $harga_total = ($order->harga_periode_pbl/2) + 5000;
    //     }

    //     $items = array(
    //         array(
    //             'id'       => 'item1',
    //             'price'    => $skema == 'cash' ? $order->harga_periode_pbl : ($order->harga_periode_pbl/2),
    //             'quantity' => 1,
    //             'name'     => $skema == 'cash' ? 'Biaya Pelunasan PBL' : 'Biaya PBL Tahap 1'
    //         ),
    //         array(
    //             'id'       => 'item2',
    //             'price'    => 5000,
    //             'quantity' => 1,
    //             'name'     => 'Biaya Admin'
    //         )
    //     );

    //     $params = [
    //         'enable_payments' => Pembayaran::CHANNELS,
    //         'transaction_details' => [
    //             'order_id'=>$order->kode_pembayaran,
    //             'gross_amount'=>$harga_total
    //         ],
    //         'item_details'=> $items,
    //         'customer_details'=>$customer_details,
    //         'expiry'=>[
    //             'start_time'=>date('Y-m-d H:i:s T'),
    //             'unit'=>Pembayaran::EXPIRY_UNIT,
    //             'duration'=>Pembayaran::EXPIRY_DURATION
    //         ]
    //     ];

    //     $snap = \Midtrans\Snap::createTransaction($params);

    //     if($snap->token){
    //         $d = PendaftaranPBL::where('kode_pembayaran', $order->kode_pembayaran)->first();
    //         $d->token_pembayaran = $snap->token;
    //         $d->url_pembayaran = $snap->redirect_url;
    //         $d->save();
    //     }
    // }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show($id)
    // {
    //     //
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function edit($id)
    // {
    //     //
    // }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function update(Request $request, $id)
    // {
    //     //
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function destroy($id)
    // {
    //     //
    // }
}
