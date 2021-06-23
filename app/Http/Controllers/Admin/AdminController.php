<?php

namespace App\Http\Controllers\Admin;

use Image;
use App\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\AdminUpdatePasswordRequest;

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
    ## update admin details
    public function updateAdminDetails(Request $request){
        if($request->isMethod('post')){

            $request->validate([
                'admin_name' => 'required|regex:/^[\pL\s\-]+$/u',
                'admin_mobile' => 'required|numeric',
                'admin_image' => 'image',
            ],[
                'admin_name.required' => 'Name is required',
                'admin_mobile.required' => 'Phone is required',
                'admin_mobile.numeric' => 'Valid phone number',
                'admin_image.image' => 'Image is required',
            ]);
            //  return $request->all();
            $currentAdmin = Auth::guard('admin')->user();
            // Upload Image
            if($request->hasFile('admin_image')){
                if($currentAdmin->image !== ''){
                    File::delete('images/admin_images/admin_photos/'.$currentAdmin->image);
                }
                $file = $request->file('admin_image');
                if($file->isValid()){
                    ## get image extension
                    $extension = $file->getClientOriginalExtension();
                    ## generate new image name
                    $imgName = time().uniqid().'.'.$extension;
                    $imgPath = 'images/admin_images/admin_photos/'.$imgName;
                    Image::make($file)->save($imgPath);
                }
            }else if(!empty($data['current_admin_image'])){
                $imgName = $data['current_admin_image'];
            }else{
                $imgName = '';
            }
            $data = $request->all();
            $currentAdmin = Auth::guard('admin')->user();
            Admin::where('email',$currentAdmin->email)->update([
              'name'=>$data['admin_name'],
              'mobile'=>$data['admin_mobile'],
              'image'=>$imgName
            ]);
            return redirect()->back()->with('success','Details updated success!');
        }
        return view('admin.update_admin_details');
    }
    ## logout
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('/admin');
    }
}
