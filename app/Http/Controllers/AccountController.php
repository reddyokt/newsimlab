<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Encryption\DecryptException;
Use Illuminate\Support\Facades\Crypt;

class AccountController extends Controller
{
    public function accountindex()
    {
        $accountindex = User::leftJoin('user_role', 'user_role.user_id', '=', 'user.user_id')
            ->leftJoin('roles', 'roles.id', '=', 'user_role.role_id')
            ->leftJoin('pda', 'pda.pda_id', '=', 'user.pda_id')
            ->whereNull('user.delete_at')
            ->whereNull('user_role.delete_at')
            ->select(DB::raw('user.user_id, phone, user.name, username, roles.role_name as role_name, email, profile_picture , pda.pda_name'))
            ->get()->toArray();


        foreach ($accountindex as $key => $value) {
            $accountindex[$key]['nomor'] = $key + 1;
        }

        return view('auth.masterdata.account.accountindex', compact('accountindex'));
    }

    public function createaccount()
    {

        $roleList = DB::table('roles')
            ->whereNotIn('CODE', ['SUP'])
            ->get()->toArray();
        return view('auth.masterdata.account.createaccount', compact('roleList'));
    }

    public function storeaccount(Request $request)
    {
        // dd($request);

        date_default_timezone_set('Asia/Jakarta');
        $req = $request->all();

        $checkExist = DB::table('user')
        ->where('email', $req['email'])
        ->orWhere('username', $req['username'])
        ->whereNull('delete_at')
        ->first();

        // $dataImage = $request->file('image');
     
        if ($checkExist) {
            return back()->with('warning', 'Data dengan Username/Email tersebut sudah ada!');
        } else {    
            $user = new User;
            // $dataImage = null;
            // $extension = '';
            // if (preg_match('#^data:image/\w+;base64,#i', $req['image'])) {
            //     $dataImage = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $req['image']));
            //     $extension = explode('/', mime_content_type($req['image']))[1];
            // }
            // dd($req['image']);
    
            // $eight_random_str = strtolower(Str::random(6));
            // $three_random_num = mt_rand(1000, 9999);
            // $token_verified =  Str::random(32);
            // $pp = null;
            // if($dataImage=$req['image']){

            
                

                // dd($dataImage);


                // dd ($pp);
                // File::put(public_path('upload/profile_picture/'.$pp), $dataImage);

                if ($request->file('image')) {

                    $extension = $request->file('image')->getClientOriginalExtension();  
                    $pp = $req['username'].'.'.$extension;
                    $dataImage = $request->file('image')->get();
                    // $user->profile_picture = $request->file('image')->store(public_path('storage/profile_picture'), $pp);
                    File::put(public_path('upload/profile_picture/'.$pp), $dataImage);

                }
            

            
            $user->username = $req['username'];
            $user->password = Hash::make('qwerty');
            $user->name = $req['name'];
            $user->email = $req['email'];
            $user->phone = str_replace('-', '', $req['phone_number']);
            $user->isActive = 'N';
            $user->pda_id = $req['pda'];
            // $user->token_verified = $token_verified;
            $user->profile_picture = $pp;
            $user->created_at = date('Y-m-d H:i:s');
            $user->created_by = $req['id'];
            $user->save();
            // User::create($user);
    
            $user_role = new UserRole();
            $user_role->user_id = $user->user_id;
            $user_role->role_id = $req['role'];
            $user_role->created_at = date('Y-m-d H:i:s');
            // $user_role->created_by = $req['id'];
            $user_role->save();
    
            // $user_settings = new UserSettings;
            // $user_settings->user_id = $user->user_id;
            // $user_settings->created_at = date('Y-m-d H:i:s');
            // $user_settings->created_by = Session::get('username');
            // $user_settings->save();
    
            // //user Log
            // $userLog = new UserLog;
            // $userLog->user_id = Session::get('user_id');
            // $userLog->role_id = Session::get('role_id');
            // $userLog->action = UserLog::AKSI_INSERT;
            // $userLog->action_date = date('Y-m-d H:i:s');
            // $userLog->description = 'Menambah akun baru atas nama '.$user->name;
            // $userLog->created_at = date('Y-m-d H:i:s');
            // $userLog->created_by = Session::get('user_id');
            // $userLog->save();
    
            // if(env('BYPASS_NOTIF')){
            //     $dataNotif = array(
            //         'to_name' => $req['name'],
            //         'username' => $req['username'],
            //         'password' => $eight_random_str,
            //         'url' => url('verified/'.$token_verified)
            //     );
        
            //     $to_name = $req['name'];
            //     $to_email = $req['email'];
            //     $subjectMail = "Verifikasi Akun Digital Cabinet";
        
            //     Mail::send("mail.mailverifiedaccount", $dataNotif, function($message) use ($to_name, $to_email, $subjectMail) {
            //         $message->to($to_email, $to_name)->subject($subjectMail);
            //         $message->from(config('mail.from.address'), config('mail.from.name'));
            //     });
            // }
    
            return redirect('/account')->with('success', 'Alhamdulillah Akun berhasil dibuat');
        }
    }

    public function editaccount($id) 
    {
        $enc = $id;
        $roleList = DB::table('roles')
            ->whereNotIn('code',['SUP'])
            ->get()->toArray();

        try {
            $id = Crypt::decrypt($id);
        } catch (DecryptException $e) {
            return view('error.404');
        }
        $data = User::leftJoin('user_role','user_role.user_id','=','user.user_id')
            ->where('user.user_id', $id)
            ->select(DB::raw('user.*, role_id'))
            ->first();

        return view('auth.masterdata.account.editaccount', compact('data','roleList','enc'));
    }

    public function updateaccount(Request $request, $id)
    {

        // dd($request);

        date_default_timezone_set('Asia/Jakarta');
        $req = $request->all();
        $id = $req['id'];
        $enc = $id;
        // try {
        //     $id = Crypt::decrypt($id);
        // } catch (DecryptException $e) {
        //     return view('error.404');
        // }

        // $dataImage = null;
        // $extension = '';
        // if($req['profile_avatar_remove'] == '1'){
        //     if (preg_match('#^data:image/\w+;base64,#i', $req['image'])) {
        //         $dataImage = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $req['image']));
        //         $extension = explode('/', mime_content_type($req['image']))[1];
        //     }
        // }else{
        //     if (preg_match('#^data:image/\w+;base64,#i', $req['image'])) {
        //         $dataImage = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $req['image']));
        //         $extension = explode('/', mime_content_type($req['image']))[1];
        //     }
        // }

        $user = User::where('user_id', $id)->first();
        $userRole = UserRole::where('user_id', $id)
            // ->whereNull('delete_at')
            ->first();

        $checkEmail = DB::table('user')
            ->where('email', $req['email'])
            ->where('user_id','<>',$user->user_id)
            ->whereNull('delete_at')
            ->first();

            // dd($checkEmail);

        if($checkEmail != null){
            return back()->with('warning', 'Email tersebut sudah ada');
        }
        // dd($user->user_id);
        $checkUsername = DB::table('user')
            ->Where('username', $req['username'])
            ->where('user_id','<>',$user->user_id)
            ->whereNull('delete_at')
            ->first();

        if($checkUsername){
            return back()->with('warning', 'Username tersebut sudah ada');
        }

        $pp = $req['old_image'];

        if ($request->file('image')) {

            $extension = $request->file('image')->getClientOriginalExtension();  
            $pp = $req['username'].'.'.$extension;
            $dataImage = $request->file('image')->get();
            // $user->profile_picture = $request->file('image')->store(public_path('storage/profile_picture'), $pp);
            File::put(public_path('upload/profile_picture/'.$pp), $dataImage);
        }


        $checkUsername = DB::table('user')
            ->where('username', $req['username'])
            ->where('user_id','<>',$user->user_id)
            ->whereNull('delete_at')
            ->first();

        if($checkEmail != null){
            return back()->with('warning', 'Username tersebut sudah ada');
        }

        $user->username = $req['username'];
        $user->name = $req['name'];
        $user->email = $req['email'];
        $user->profile_picture = $pp;
        $user->phone = str_replace('-', '', $req['phone_number']);
        // $user->updated_by = Session::get('username');
        $user->save();

        // user role
        if($userRole->role_id != $req['role']){
            $userRole->role_id = $req['role'];
            // $userRole->updated_at = Session::get('username');
            $userRole->save();
        }

        //user Log
        // $userLog = new UserLog;
        // $userLog->user_id = Session::get('user_id');
        // $userLog->role_id = Session::get('role_id');
        // $userLog->action = UserLog::AKSI_UPDATE;
        // $userLog->action_date = date('Y-m-d H:i:s');
        // $userLog->description = 'Memperbarui akun atas nama '.$user->name;
        // $userLog->created_at = date('Y-m-d H:i:s');
        // $userLog->created_by = Session::get('username');
        // $userLog->save();

        return redirect('/account')->with('success', 'Alhamdulillah Akun berhasil di edit');
    }

    public function deleteaccount($id)
    {
        date_default_timezone_set('Asia/Jakarta');
        // try {
            $id = Crypt::decrypt($id);

            $user = User::whereNull('delete_at')->where('user_id', $id)->first();
            $user->delete_at = date('Y-m-d H:i:s');
            $user->save();

            $userRole = UserRole::whereNull('delete_at')->where('user_id', $id)->update([
                'delete_at'=>date('Y-m-d H:i:s')
            ]);

            // $userSetting = UserSettings::whereNull('deleted_at')->where('user_id', $id)->first();
            // $userSetting->deleted_at = date('Y-m-d H:i:s');
            // $userSetting->save();

            //user Log
            // $userLog = new UserLog;
            // $userLog->user_id = Session::get('user_id');
            // $userLog->role_id = Session::get('role_id');
            // $userLog->action = UserLog::AKSI_DELETE;
            // $userLog->action_date = date('Y-m-d H:i:s');
            // $userLog->description = 'Menghapus akun atas nama '.$user->name;
            // $userLog->created_at = date('Y-m-d H:i:s');
            // $userLog->created_by = Session::get('username');
            // $userLog->save();

            return back()->with('warning', 'Data telah didelete!');
            // } catch (DecryptException $e) {
            //     return view('error.404');
            // }
        
    }

    public function getPDA(){
        $pda = DB::table('pda')->whereNull('deleted_at')->get()->toArray();
        return response()->json($pda);
    }

    public function getPCA(){
        $dpc = DB::table('dpc')->whereNull('deleted_at')->get()->toArray();
        return response()->json($dpc);
    }
}