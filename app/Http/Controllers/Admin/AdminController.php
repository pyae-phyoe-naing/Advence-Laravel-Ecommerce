<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.admin_dashboard');
    }
    ## login
    public function login(Request $request)
    {
        if ($request->isMethod('post')) {
            $rules = [
              'email'=>'required|email|max:255',
              'password'=>'required|min:6'
            ];
            $customMessage = [
                'email.required'=>'Email Address is required!',
                'email.email'=>'Valid Email is required!',
                'password.required'=>'Password is required!',
                'password.min'=>'Password must be at least 6 character!',
            ];
            $this->validate($request,$rules,$customMessage);
            $cre = $request->only('email', 'password');
            if (Auth::guard('admin')->attempt($cre)) {
                $user = Auth::guard('admin')->user();
                return redirect('admin/dashboard')->with('success','Welcome '.$user->name);
            } else {
                return redirect()->back()->with('error','Email or Password Invalid!');
            }
        }
        return view('admin.admin_login');
    }
    ## settings
    public function settings(){
        $adminDetail = Admin::where('email',Auth::guard('admin')->user()->email)->first();

        return view('admin.admin_settings')->with(compact('adminDetail'));
    }
    ## check current password
    public function chkCurrentPassword(Request $request){
        $data = $request->all();
        $hash = Auth::guard('admin')->user()->password;
        if(Hash::check($data['current_pwd'], $hash)){
            return 'true';
        }else{
            return 'false';
        }
    }
    ## logout
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('/admin');
    }
}
