<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
class ProfileController extends Controller
{
    // display change password page
    public function changePasswordPage(){
        return view('admin.profile.changePassword');
        //old password = password
        //all must be fill
        //min:6,max:12
        //new password= confirm password
    }

   //edit profile
   public function editProfile(){
    // $data=User::where('id',Auth::user()->id)->first();
        return view('admin.profile.edit');
   }

   //update profile
   public function updateProfile(Request $request){
    $this->checkProfileValidation($request);
    $data = $this->getProfileData($request);

    if($request->hasFile('image')){
        if(Auth::user()->profile != null){
            if(file_exists(public_path().'/profile/'.Auth::user()->profile)){

            unlink(public_path().'/profile/'.Auth::user()->profile);
        }
        }
        $fileName=uniqid().$request->file('image')->getClientOriginalName();
        $request->file('image')->move(public_path().'/profile/',$fileName);
        $data['profile']=$fileName;
        
    }else{
         $data['profile']=Auth::user()->profile;
    }
    User::where('id',Auth::user()->id)->update($data);
     Alert::success( 'Success!', 'Profile Updated Successfully!');
        return back();
    
   }


    //change password
public function changePassword(Request $request)
{
    // Validate all password fields
    $this->checkPasswordValidation($request);

    // Get the logged-in user's hashed password
    $userRegisterPassword = Auth::user()->password;

    // Check the old password
    if (Hash::check($request->oldPassword, $userRegisterPassword)) {

        // Update the new password
        // Auth::user()->update([
        //     'password' => Hash::make($request->newPassword)
        // ]);
        User::where('id', Auth::id())->update([
    'password' => Hash::make($request->newPassword)
]);

        Alert::success( 'Success!', 'Your password has been changed successfully!');
        return back();//to show current page
        // Auth::logout();
        // $request->session()->invalidate();
        // $request->session()->regenerateToken();
        // return redirect('/');
    } else {

        Alert::error(
            'Process Failed!',
            'Your password does not match our records!'
        );

        return back();
    }
}


//get profile data
private function getProfileData($request){
    return[
    'name'=>$request->name,
    'email'=>$request->email,
    'phone'=>$request->phone,
    'address'=>$request->address,
    ];
}
    //check passwordValidation
    private function checkPasswordValidation($request){
        $request->validate([
            'oldPassword' => 'required',
            'newPassword' => 'required|min:6|max:12',
            'confirmPassword' => 'required|min:6|max:12|same:newPassword'
        ]);
    }
     //check profileValidation
    private function checkProfileValidation($request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|min:2|max:30|unique:users,email,'.Auth::user()->id,
            'phone' => 'required|max:12',
            'address' => 'max:200',
            'image' =>'file|mimes:jpg,jpeg,png,gif,webp,svg'
        ]);
    }
}
