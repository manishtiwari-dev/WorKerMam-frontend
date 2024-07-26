<?php

namespace Modules\Setting\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Setting\Models\EmailGroup;



class EmailGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $email_group = EmailGroup::orderBy('created_at', 'DESC')->paginate(10);
        return view('Setting::email-group.index' ,compact('email_group'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('Setting::email-group.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $email_group = new EmailGroup();
        $email_group->group_name = $request->group_name;
        $email_group->group_key = $request->group_key;
        $email_group->save();
        return response()->json(['status'=>200, 'success'=>'Group Add Successfully']);
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
        $email_group = EmailGroup::find($id);
        return response($email_group);
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
        $email_group = EmailGroup::find($id);
        $email_group->group_name = $request->group_name;
        $email_group->group_key = $request->group_key;
        $email_group->update();
        return response($email_group);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $email_group = EmailGroup::find($id);
        $email_group->delete();
        return response()->json(['success'=>'Group Deleted Successfully']);
    }

    public function templateUpdate(Request $request){

        $email_group = EmailGroup::find($request->group_id);
        $email_group->group_name = $request->group_name;
        $email_group->group_key = $request->group_key;
        $email_group->update();
        return response()->json(['success'=>'Group Updated Successfully']);
    }

     public function groupDestroy(Request $request)
    {
        $email_group = EmailGroup::find($request->group_id)->delete();
        return response()->json(['data'=>$email_group, 'success'=>'Group Deleted Successfully']);
    }
}

 
 