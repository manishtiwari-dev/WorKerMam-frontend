<?php

namespace Modules\Setting\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Setting\Models\EmailGroup;
use Modules\Setting\Models\EmailTemplates;


class EmailTemplatesController extends Controller
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
    public function create()
    {
        $email_group = EmailGroup::all();
        return view('Setting::email-template.create',compact('email_group'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

   
    // public function storeId(Request $request)
    // {   

    //     $email_group = EmailGroup::all();
    //     $email_template = EmailTemplates::where('group_id', $request->group_id)->first();
    //     return response()->json(['emailgroupId'=>$email_template, 'email' => $email_group]);
    // }

    public function store(Request $request)
    {
      
        $request->validate([
        'template_subject'=>'required|string|min:3',
        'template_content'=>'required|max:500',
        ]);

        $email_group = new EmailGroup();
        $email_template = new EmailTemplates();
        $email_template ->template_subject = $request->template_subject;
        $email_template ->template_content = $request->template_content;
        $email_template ->group_id = $request->group_id;
        $email_template->save();
        return response()->json(['status'=>200, 'success'=>'Template Add Successfully','emailtemplate' => $email_template, 'emailgroup' => $email_group ]);
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
        $template = EmailTemplates::find($id);
        return response($template);
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
        $email_template = EmailTemplates::where('template_id',$id)->first();
        $email_template->template_subject = $request->template_subject;
        $email_template->template_content = $request->template_content;
        $email_template ->group_id = $request->group_id;
        $email_template->update();
        return redirect()->route('email-template.index')->with('success','Record Updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $email_template = EmailTemplates::find($id);
        $email_template->delete();
        return redirect()->route('email-template.index')->with('success','Record delete successfully');
    }

     public function list($id)
    {
       
        $email_group = EmailGroup::all();
        $template_list = EmailTemplates::where('group_id',$id)->paginate(10);
        return view('Setting::email-template.index', compact('template_list', 'email_group','id'));
       
    }


    public function templateEdit(Request $request)
    {
        
        $template = EmailTemplates::where('template_id', $request->temp_id)->first();
        $email_group = EmailGroup::all();
        return response()->json(['data'=>$template, 'email' => $email_group]);
    }

    public function templateUpdate(Request $request)
    {

        $request->validate(
            [
                'template_subject'=>'required|string|min:3',
                'template_content'=>'required|max:500|min:5',
            ]);
        if(!empty($request)){

            $template = EmailTemplates::find($request->template_id);
            $template->group_id = $request->group_id;
            $template->template_subject = $request->template_subject;
            $template->template_content = $request->template_content;
            $template->save();  
            return response()->json(['data'=>$template, 'success'=>'Template Updated Successfully']);
        }else
        {
            return response()->json(['msg'=>'data not updated']);
        }
    }

    public function templateDelete(Request $request)
    {
        
        $template_list = EmailTemplates::where('template_id' , $request->temp_id)->delete();
        return response()->json(['data' => $template_list, 'statusCode' => 200, 'success' => 'Template Deleted Successfully']);
    }

   public function changeStatus(Request $request)
    {
        $templateStatus = EmailTemplates::find($request->temp_id);
        $templateStatus->status = $request->status;
        $templateStatus->save();

        if($templateStatus){
        return response()->json(['success'=>'Status change successfully.']);
        }
        else{
            return response()->json(['failed'=>'Status change fail.']);
        }
    }
}

 