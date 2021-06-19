<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminUpdatePasswordRequest;
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
                'email' => 'required|email|max:255',
                'password' => 'required|min:6'
            ];
            $customMessage = [
                'email.required' => 'Email Address is required!',
                'email.email' => 'Valid Email is required!',
                'password.required' => 'Password is required!',
                'password.min' => 'Password must be at least 6 character!',
            ];
            $this->validate($request, $rules, $customMessage);
            $cre = $request->only('email', 'password');
            if (Auth::guard('admin')->attempt($cre)) {
                $user = Auth::guard('admin')->user();
                return redirect('admin/dashboard')->with('success', 'Welcome ' . $user->name);
            } else {
                return redirect()->back()->with('error', 'Email or Password Invalid!');
            }
        }
        return view('admin.admin_login');
    }
    ## settings
    public function settings()
    {
        $adminDetail = Admin::where('email', Auth::guard('admin')->user()->email)->first();

        return view('admin.admin_settings')->with(compact('adminDetail'));
    }
    ## check current password
    public function chkCurrentPassword(Request $request)
    {
        $data = $request->all();
        $hash = Auth::guard('admin')->user()->password;
        if (Hash::check($data['current_pwd'], $hash)) {
            return 'true';
        } else {
            return 'false';
        }
    }
    ## update password
    public function updatePassword(AdminUpdatePasswordRequest $request)
    {
        if ($request->isMethod('post')) {

            $data = $request->all();
            $currentAdmin = Auth::guard('admin')->user();
            // check current password
            if (Hash::check($data['current_pwd'], $currentAdmin->password)) {
                // check new password and confrim password matching
                if ($data['new_pwd'] === $data['confirm_pwd']) {
                    Admin::where('id',$currentAdmin->id)->update(['password'=>Hash::make($data['new_pwd'])]);
                    return redirect()->back()->with('success','Password updated success!');
                } else {
                    return redirect()->back()->withErrors(['confirm_pwd' => 'စကား၀ှက်အသစ်များတူညီမှုမရှိမပါ။']);
                }
            } else {
                return redirect()->back()->withErrors(['current_pwd' => 'လက်ရှိစကား၀ှက်မှားနေပါသည်။']);
            }
        }
    }
    ## logout
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('/admin');
    }
}
