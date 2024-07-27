<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\UserSetting;
use App\Notifications\ForgotPassword;
use Illuminate\Support\Facades\Validator;
use Anhskohbo\NoCaptcha\NoCaptcha;
use App\Notifications\ActivationUser;

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

    public function forgot()
    {
        return view('authentication.forgot');
    }

    function forgotPassword(Request $request)
    {
        $input = $request->all();

        if ($input['email'] !== null) {

            $data = User::where('email', $input['email'])->first();
            if ($data !== null) {

                $token =  Str::random(32);
                $data->token = $token;
                $data->save();

                $data->notify(new ForgotPassword($token));

                // Response to Ajax
                return redirect()->back()->with('success', 'Link Reset password telah dikirim, Silahkan cek email anda');
            } else {
                return redirect()->back()->with('success', 'Email Yang anda masukkan tidak terdaftar');
            }
        } else {
            return redirect()->back()->with('success', 'Masukkan email dengan benar');
        }
    }

    public function updatePassword(Request $request, $id)
    {

        $request->validate([
            'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'required|min:6'
        ]);

        $new_password = Hash::make($request->password);
        $cek = User::where('email', $request->email)->where('token', $id)->first();
        if ($cek != null) {
            $cek->update([
                'password' => $new_password
            ]);

            return redirect('/login')->with('success', 'Password anda sudah di-Reset, silahkan coba login');
        } else {
            return redirect()->back()->with('error', 'Oops! email Yang anda masukkan salah');
        }
    }

    public function postLogin(Request $request)
    {

        // $validator = Validator::make($request->all(), [
        //     'g-recaptcha-response' => 'required|captcha',
        //     // other validation rules
        // ]);

        // if ($validator->fails()) {
        //     'Ulangi Lagi';
        // }

        date_default_timezone_set('Asia/Jakarta');
        $username = $request->username;
        $password = $request->password;

        $data = DB::table('user')->where('user.username', $username)
            ->whereNull('user.delete_at')
            ->where('user.isActive', 'Y')
            ->first();
        $mustchange = DB::table('user')->where('user.username', $username)
            ->whereNull('user.delete_at')
            ->where('user.password_change', 'N')
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

                // if ($data->password_change == 'N') {
                //     return view('authentication.mustchangepassword', compact('data'));
                // }

                //redirect to main page
                return redirect('/dashboard/index')->with('success', 'Login Sukses');
            } else {
                return redirect('/login')->with('error', 'Password atau Username, Salah!');
            }
        } else {
            return redirect('/login')->with('error', 'Password atau Username, Salah!');
        }
    }

    public function mustChangePassword(Request $request)
    {
        $request->validate([
            'password' => 'min:6|required_with:password_confirmation|different:current_password|same:password_confirmation',
            'password_confirmation' => 'required|min:6'
        ]);

        $user = User::where('user_id', $request->user_id)->first();

        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->with('warning', 'Password lama tidak sesuai');
        }

        if ($request->password != $request->password_confirmation) {
            return redirect()->back()->with('warning', 'Password dan konfirmasi password tidak sama');
        }

        if (Hash::check($request->password, $user->password)) {
            return redirect()->back()->with('warning', 'Password baru tidak boleh sama dengan password lama');
        }

        $user->update([
            'password' => bcrypt($request->password),
            'password_change' => 'Y',
            'email' => $request->email
        ]);

        Auth::logout();
        Session::flush();

        $user->notify(new ActivationUser($request->email));

        return redirect('login')->with('success', 'Password berhasil diubah. Silakan login kembali.');
    }


    public function logout(Request $request)
    {
        Auth::logout();
        Session::flush();
        return redirect('login')->with('error', 'Anda Telah Logout');
    }

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
}
