<?php
namespace Modules\Setting\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Setting\Models\SettingGroup;
use Auth;

class SettingGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        $setting_group_list = SettingGroup::paginate(10);
        //  $setting_group_list = SettingGroup::paginate($request->get('per_page', 10));
        // return view('users', compact('users'));
        return view('Setting::setting-group.index',compact('setting_group_list'));
               
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()

    {   
        // 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sort_order = SettingGroup::max('sort_order');
        $sort_order = $sort_order+1;

        $setting = new SettingGroup();
        $setting->group_name = $request->group_name;
        $setting->access_privilege = $request->access_privilege;
        $setting->sort_order = $sort_order;
        $setting->save();
        return redirect()->route('app-setting-group.index')->with('success','Setting Group Added Successfully!');

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
        $setting = SettingGroup::find($id);
        return response($setting);
             
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        // 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {  

        $setting = SettingGroup::find($id);
        $setting->delete();
        return redirect()->route('app-setting-group.index')->with('success','Setting Group Deleted Successfully');
    }

    public function SettingGroupUpdate(Request $request)
    {

       $setting =  SettingGroup::find($request->group_id);
       $setting->group_name = $request->group_name;
       $setting->access_privilege = $request->access_privilege;
       $setting->update();  
       return response()->json(['status'=>1, 'success'=>'Setting Group Updated Successfully!']);
    }

   public function changeSettineGroupStatus(Request $request)
    {  

        $setting = SettingGroup::find($request->group_id);
        $setting->status = $request->status;
        $setting->update();
        return response()->json(['status'=>1, 'message'=>'setting group status changed Successfully']);
    } 

    public function updatesettinggroupsortorder(Request $request)
    {
        $setting_sort_order =  SettingGroup::find($request->group_id);
        $setting_sort_order->sort_order = $request->sort_order;
        $setting_sort_order->update();
        return json_encode($setting_sort_order);
    }

    public function deleteappseting(Request $request)
    { 
        $setting = SettingGroup::find($request->group_id);
        $setting->delete();
        return response()->json(['status'=>1, 'success'=>'Setting Group deleted Successfully!']);
    }
}
