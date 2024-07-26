<?php

namespace Modules\Marketing\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use Redirect;
use App\Helper\Helper;

class TemplateListController extends BaseController
{
    public function __construct()
    {
        $this->pageTitle = 'Template List';
        $this->pageAccess = config('acceskey.marketing-template-list');
    }

    public function index()
    {    
        $this->content = [];

        if(isset(request()->page))
        $page=request()->page;
        else
        $page=1;

        $start_date='';
        $end_date='';

        if(isset(request()->start_date))
            $start_date=request()->start_date;
        if(isset(request()->end_date))
            $end_date=request()->end_date;
    
        $parameters =array( 
            "page" => $page,
            "perPage" => "10",
            "search" => "",
            "sortBy"=> "",
            "orderBY" => "",
            "language" => "1",
            'api_token' => Helper::getCurrentuserToken(),
            'start_date'=>$start_date,
            'end_date'=>$end_date,
        );
        $apiurl = config('apipath.marketing-template');
        // $apiurl = "https://e-nnovation.net/backend/public/api/marketing-template"; 
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);   
        if (!empty($responseData))
        $this->content = $responseData->data;
  

        return view('Marketing::templatelist.index', collect($this->data)); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {  
        return view('Marketing::templatelist.create');
    }

    public function proEditor()
    {
        return view('Marketing::templatelist.pro_editor');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   

        
        $parameters =array( 
            "subject" => $request->subject,
            'api_token' => Helper::getCurrentuserToken(),
        );

        $apiurl = config('apipath.marketing-template-store');
        // $apiurl = "https://e-nnovation.net/backend/public/api/marketing-template/store"; 
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters); 
        
        if($request->editor=="pro")
        return view('Marketing::templatelist.pro_editor',['data'=>$responseData->data]);
        else
        return view('Marketing::templatelist.text_editor',['data'=>$responseData->data]);
        
        
        // if ($responseData) {
        //     return redirect()->route('template-list.index')->with('success', $responseData->message);
        // } else {
        //     return redirect()->route('template-list.index')->with('error', $responseData->message);
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $parameters =array( 
            "id" => $id,
        );

        $apiurl = config('apipath.marketing-template-edit');

        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);  

        return view('Marketing::templatelist.preview',['data'=>$responseData->data]); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $parameters =array( 
            "id" => $id,
        );
        $apiurl = config('apipath.marketing-template-edit');
        // $apiurl = "https://e-nnovation.net/backend/public/api/marketing-template/edit";
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);  
        
        if($responseData->data->editor_type==1)
        return view('Marketing::templatelist.edit_text_editor',['data'=>$responseData->data]); 
        else
        return view('Marketing::templatelist.edit_pro_editor',['data'=>$responseData->data]); 
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
        $parameters =array( 
            "id" => $id,
            'api_token' => Helper::getCurrentuserToken(),
        );
        $apiurl = config('apipath.marketing-template-update');
        // $apiurl = "https://e-nnovation.net/backend/public/api/marketing-template/update";
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters); 
        $message = Helper::translation($responseData->message);
 
       // dd($message);
        if ($responseData) {
            return redirect()->route('marketing.template-list.index')->with('success', $message);
        } else {
            return redirect()->route('marketing.template-list.index')->with('error', $message);
        }
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

    public function TemplateListDestroy(Request $request)
    {  
        $parameters =array( 
            "id" => $request->id,
            'api_token' => Helper::getCurrentuserToken(),
        );
        $apiurl = config('apipath.marketing-template-destroy');
        // $apiurl = "https://e-nnovation.net/backend/public/api/marketing-template/destroy";
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);   
        $message = Helper::translation($responseData->message);

        if ($responseData) {
            return response()->json(['success' => $message]);
        } else {
            return response()->json(['success' => $message]);
        }
        
    }
    public function TemplateListUpdate(Request $request, $id)
    {  
         
        $parameters =array( 
            "id" => $request->id,
            "subject" => $request->subject,
            "content" => $request->content,
            'api_token' => Helper::getCurrentuserToken(),
        );
        $apiurl = config('apipath.marketing-template-update');
        // $apiurl = "https://e-nnovation.net/backend/public/api/marketing-template/update";
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);    
        $message = Helper::translation($responseData->message);

          

        if (isset($message)) {
            return redirect()->route('marketing.template-list.index')->with('success', $message); 
        } else {
            return redirect()->route('marketing.template-list.index')->with('success', $responseData['message']);
        }
        
    }

    public function ChangeTemplateListStatus(Request $request)
    {
        $parameters =array( 
            "id" => $request->id, 
        ); 
        $apiurl = config('apipath.marketing-template-changeStatus');
        // $apiurl = "https://e-nnovation.net/backend/public/api/marketing-template/changeStatus";
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);    
        $message = Helper::translation($responseData->message);

        if (isset($message)) {
            return response()->json(['success' => $message]);
        } else {
            return response()->json(['success' => $responseData['message']]); 
        } 
    }

    public function templateFilter(Request $request)
    {
        $parameters = array(
            "start_date" => $request->start_date,
            "end_date" => $request->end_date,
            "search" => $request->search,
        );
        $apiurl= config('apipath.marketing-template');

        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        if (!empty($responseData))
        $this->content = $responseData->data;

        $returnHTML = view('Marketing::templatelist.filter_response', collect($this->data))->render();

        return response()->json(['success' => true, 'html'=>$returnHTML]);
    }
  
    
}
