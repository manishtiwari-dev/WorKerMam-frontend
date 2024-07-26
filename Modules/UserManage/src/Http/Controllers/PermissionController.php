<?php
namespace Modules\UserManage\Http\Controllers;
use App\Http\Controllers\Controller;
use Modules\Setting\Models\Module;
use Illuminate\Http\Request;
use Modules\UserManage\Models\Permission;



class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $userpermissionlist = Permission::all();
        // return view('UserManage::permission.index' ,compact('userpermissionlist'));
        return view('UserManage::permission.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $module_name = Module::where('status',1)->get();
        return view('UserManage::permission.create',compact('module_name'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*laravel validation */
      

        $sort_order = Permission::orderBy('permissions_id', 'ASC');
        $sort_order = $sort_order+1;

        $permission = new Permission();
        $permission->permissions_name = $request->permissions_name;
        $permission->permissions_slug = $request->permissions_slug;
        $permission->sort_order = $request->sort_order;
        $permission->save();

        return redirect()->route('permission.index')->with('success','Record Inserted successfully');

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
        $permission = Permission::find($id);
        return view('UserManage::permission.edit' , compact('permission'));
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
          /*laravel validation */
        
        /* Update Permission */
        $permission =  Permission::find($id);
        $permission->permissions_name = $request->permissions_name;
        $permission->permissions_slug = $request->permissions_slug;
        $permission->sort_order = $request->sort_order;
        

        $permission->update();

        return redirect()->route('permission.index')->with('success','Record Updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Permission::where('permissions_id', $id)->exists()) {
        $permission = Permission::find($id);
        $permission->delete();
        return redirect()->route('permission.index')->with('success','Record delete successfully');
        }else{
            return response()->json(['error' => 'User already deleted!']);
        }
    }
    public function ChangePermissionStatus(Request $request)
    {
       
        $permission = Permission::find($request->permissions_id);
        $permission->status = $request->status;
        $permission->update();
        return response()->json(['status' => 1, 'message' => 'Permission Status changed Successfully']);
    }

    public function UpdatePermissionSortorder(Request $request)
    {
        $permission =  Permission::find($request->permissions_id);
        $permission->sort_order = $request->sort_order;
        $permission->update();
       return json_encode($permission);
    }
}
