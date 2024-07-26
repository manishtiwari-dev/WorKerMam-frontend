<?php

namespace Modules\Marketing\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helper\Helper;




class TemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  
        // $parameters =array( 
        //     "page" => '1',
        //     "perPage" => "2",
        //     "search" => "",
        //     "sortBy"=> "",
        //     "orderBY" => "",
        //     "language" => "1",
        // );
    
        // $apiurl = "https://e-nnovation.net/backend/public/api/marketingTemplate";
        // $responseData = Helper::ApiServiceResponse($apiurl, $parameters); 
        // return view('Marketing::template.index', collect($responseData->data)  );
        return view('Marketing::template.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view('Marketing::template.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'group_name' => 'required',

        ]);
        $template_group = new Template();
        $template_group->group_name = $request->group_name;
        $template_group->description = $request->details;
        $template_group-> updated_at = null;
        $template_group->save();
        return redirect()->route('marketing.template-group-list.index')->with('success', 'Group Added successfully');
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

        $template = Template::find($id);
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
        // 
    }

    public function TemplateUpdate(Request $request)
    {
        $request->validate([
            'name' => 'required', 
        ]);
        $template_group =  Template::where('id', $request->id)->update([

            'group_name' => $request->name,
            'description' => $request->description,
        ]);

        return response()->json(['template_group' => $template_group, 'success' => 'Group Update Successfully']);
    }


    public function TemplateDestroy(Request $request)
    {
        if (Template::find($request->id)->exists()) {
        $template = Template::find($request->id)->delete();
        $templategroup = TemplateToGroup::where('group_id',$request->id)->delete();
             return response()->json(['template' => $template,'templategroup' => $templategroup,'success' => 'Group Deleted Successfully']);
        }else{
            return response()->json([ 'error' => "Template can't be Deleted"]);
        }
    }
    public function ChangeTemplateStatus(Request $request)
    {

        $template = Template::find($request->id);
        $template->status = $request->status;
        $template->update();
        return response()->json(['status' => 1, 'success' => '  Group Status Change Successfully']);
    }
}
