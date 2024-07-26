<?php
namespace Modules\Setting\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Setting\Models\SettingGroup;
use Modules\Setting\Models\SettingGroupKey;
use Auth;

class SettingGroupKeyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {              
        // 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listing($id)
    {
      
        $setting_key_list = SettingGroupKey::where('group_id',$id)->paginate(10);
        $setting_group_list = SettingGroup::all();
        return view('Setting::setting-group-key.index',compact('setting_key_list','setting_group_list','id'));
          
    }
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

        $sort_order = SettingGroupKey::max('sort_order');
        $sort_order = $sort_order+1;

        $setting = new SettingGroupKey();
        $setting->group_id = $request->group_id;
        $setting->setting_key = $request->setting_key;
        $setting->setting_name = $request->setting_name;
        $setting->setting_options = $request->setting_option;
        $setting->option_type = $request->option_type;
        $setting->setting_hint = $request->setting_hint;
        $setting->sort_order = $sort_order;
        $setting->save();
        return redirect()->route('-setting-group-key.index')->with('success','Setting Group key Added Successfully!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function storekeydata(Request $request)
    {

        $sort_order = SettingGroupKey::max('sort_order');
        $sort_order = $sort_order+1;

        $setting = new SettingGroupKey();
        $setting->group_id = $request->group_id;
        $setting->setting_key = $request->setting_key;
        $setting->setting_name = $request->setting_name;
        $setting->setting_options = $request->setting_options;
        $setting->option_type = $request->option_type;
        $setting->setting_hint = $request->setting_hint;
        $setting->sort_order = $sort_order;
        $setting->save();
        return response()->json(['status'=>1, 'message'=>'setting group key deleted Successfully']);

    }

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
       
        $email_group = EmailGroup::find($id);
        $setting =  SettingGroupKey::find($id);
        return response()->json($setting);
           
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
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

          $setting = SettingGroupKey::find($id);
          $setting->delete();
          return response()->json(['status'=>1, 'message'=>'setting group key deleted Successfully']);
        
    }

    public function updateappsettingkey(Request $request)
    {

        $setting =  SettingGroupKey::find($request->setting_id);
        $setting->group_id = $request->group_id;
        $setting->setting_key = $request->setting_key;
        $setting->setting_name = $request->setting_name;
        $setting->setting_options = $request->setting_option;
        $setting->option_type = $request->option_type;
        $setting->setting_hint = $request->setting_hint;
        $setting->update();
        return response()->json(['status'=>1, 'success'=>'Setting Group Key Updated Successfully!']);
    }

   public function changeSettineGroupKeyStatus(Request $request)
    {  

        $setting =  SettingGroupKey::find($request->setting_id);
        $setting->status = $request->status;
        $setting->update();
        return response()->json(['status'=>1, 'message'=>'setting group status changed Successfully']);
    } 

    public function updatesettinggroupkeysortorder(Request $request)
    {
        $setting_sort_order =  SettingGroupKey::find($request->setting_id);
        $setting_sort_order->sort_order = $request->sort_order;
        $setting_sort_order->update();
        return json_encode($setting_sort_order);
    }

    public function deleteappsetingkey(Request $request)
    { 

        $setting = SettingGroupKey::find($request->setting_id);
        $setting->delete();
        return response()->json(['status'=>1, 'message'=>'setting group key deleted Successfully']);
    }

    
    public function editGroupKey(Request $request)
    {

        $setting_key = SettingGroupKey::where('setting_id', $request->setting_id)->first();
        $setting = SettingGroup::all();
        return response()->json(['setting_key'=>$setting_key, 'setting' => $setting]);
    }

}
