<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.admin_dashboard');
    }
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
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('/admin');
    }
}
