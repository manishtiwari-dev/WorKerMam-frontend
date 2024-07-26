<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Modules\UserManage\Models\Role;
use Illuminate\Support\Facades\Hash;
use App\Models\UserHasRoles;
use Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd(Auth::user()->);
        $user_list = User::with('role')->paginate(10);
        $role_list = UserHasRoles::with('roles')->get();
        return view('user.index', compact('user_list', 'role_list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role_list = Role::all();
        return view('user.create', compact('role_list'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'name' => 'required',
        //     'email' => 'required|unique:users|email|email:rfc,dns',
        //     'password' => 'required|min:6',
        //     'role' => 'required',

        // ]);
        /* New Use added */
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->status = '1';
        $user->save();
        $user_id = $user->id;

        UserHasRoles::create([
            'roles_id' => $request->role,
            'users_id' => $user_id,
        ]);

        return redirect()->route('user.index')->with('success', 'User Added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role_list = Role::all();
        $user = User::find($id);
        $role_list1 = UserHasRoles::where('users_id', $user->id)->first();
        return view('user.edit', compact('role_list', 'user', 'role_list1'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $cur_user_id = $id;
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
       // $user->password = Hash::make($request->password);
        $user->status = $request->status;
        $user->update();
      
    
        // update or add user role
        if(isset($request->role)){
            $updateRoleStatus = UserHasRoles::updateOrCreate([
                    'users_id'    => $cur_user_id                
                ],[ 
                    'roles_id'  => (int)$request->role
                ]
            );
            
            if($updateRoleStatus){
                return redirect()->route('user.index')->with('success', 'User details Updated successfully!!');
            }else{
                return redirect()->route('user.edit', $id)->with('error', 'There was issue while role update!');
            }
        }
       
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
       
        if (User::where('id', $request->user_id)->exists()) {

            $user = User::where('id',$request->user_id)->delete();
            UserHasRoles::where('users_id', $request->user_id)->delete();

            return response()->json(['success' => 'User deleted successfully']);
        } else{
            return response()->json(['error' => 'User already deleted!']);
        }
    }

    public function UpdatePassword(Request $request)
    {
       
        $request->validate([
            'new_password' => 'required',
            'password_confirmation' => 'required|same:new_password',

        ]);
        /* Password check and update section start */
        if($request->has('new_password') && !empty($request->new_password) ){
            if($request->new_password == $request->password_confirmation){   // Check new and confirm password is same or not
                User::find($request->user_id)->update(['password' => Hash::make($request->new_password)]);
                return redirect()->back()->with('success', 'Password Updated Successfully.');;
            } else{
                return redirect()->route('user.edit', $id)->with('error', 'New Password and confirm password does not match!');
            }

        }else{
            return redirect()->route('user.edit', $id)->with('error', 'Please Fill the Password!');
        }
        /* Password check and update section end */
    }



    public function ChangeUserStatus(Request $request)
    {
        $user = User::find($request->id);
        $user->status = $request->status;
        $user->update();
        return response()->json(['status' => 1, 'message' => 'User Status changed Successfully']);
    }
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
