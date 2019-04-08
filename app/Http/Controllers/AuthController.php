<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserSystem;
use Hash;

class AuthController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
   

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function dashboard(){
        // echo "string";
        return view('dashboard');
    }



public function logout(Request $request){
    // if (!empty($request->logout)) {
        $request->session()->flush();
        return redirect('/login');
    // }
}
   
 public function login(){
    return view('pages/login');
  }
  public function loginPost(Request $request){
       $username = $request->username;
        $password = $request->password;

        $user = UserSystem::where('username',$username);

        // if account exist
        if ($user->count() >0) {
            # code...
            $hashed = $user->first()->password;

            if (Hash::check($password, $hashed)) {
                $status = 1;
                $request->session()->put('adminid', $user->first()->id);
                $request->session()->put('logged', 'true');
                $request->session()->put('levelid', $user->first()->role);
                
                $msg = "Berhasil Login";
            }
            else{
                $status = 0;
                $msg = "Email/Kata Sandi yang anda masukan salah";

            }
        }

        else{
            $status = 0;
            $msg = "Akun Tidak Ditemukan";
        }


        return [

            'status'=>$status,
            'msg'=>$msg
        ];

  }



}


