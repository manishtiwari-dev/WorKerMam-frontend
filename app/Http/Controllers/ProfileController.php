<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Modules\UserManage\Models\Role;
use Illuminate\Support\Facades\Hash;
use App\Models\UserHasRoles;
use Auth;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   
     public function profile(){
        
        $user=Auth::guard('web')->user();
        $profiledata = User::find($user->id);
        return view('profile.index', compact('profiledata'));
    }
    public function ProfileUpdate(Request $request)
    {
        $user=Auth::guard('web')->user();
        $user = User::find($user->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->update();

        return redirect()->route('dashboard')->with('success', 'Profile details Updated successfully!!');
    }
    public function ProfileUpdatePassword(Request $request)
    {
        $request->validate([
            'new_password' => 'required',
            'password_confirmation' => 'required|same:new_password',

        ]);
        /* Password check and update section start */
        if($request->has('new_password') && !empty($request->new_password) ){
            if($request->new_password == $request->password_confirmation){   // Check new and confirm password is same or not
                User::find($request->user_id)->update(['password' => Hash::make($request->new_password)]);
                return redirect()->route('dashboard')->with('success', 'Password Updated Successfully.');;
            } else{
                return redirect()->route('my-profile')->with('error', 'New Password and confirm password does not match!');
            }

        }else{
            return redirect()->route('my-profile')->with('error', 'Please Fill the Password!');
        }
        /* Password check and update section end */
    }
}
