<?php

namespace Modules\Marketing\Http\Controllers;

use App\Helper\Helper;
use App\Http\Controllers\BaseController;
use Exception;
use Illuminate\Http\Request;

class ContactGroupController extends BaseController
{
    public function __construct()
    {
        $this->pageTitle = 'Contact';
        $this->pageAccess = config('acceskey.marketing-contact');
    }

    // Contact Group To Contat List

    public function contactGroupView(Request $request, $id)
    {
        $this->content = [];

        if(isset(request()->page))
        $page=request()->page;
        else
        $page=1;

        $parameters = array(
            "group_id" => $id,
            "page" => $page,
            "perPage" => "10",
            "search" => "",
            "sortBy" => "",
            "orderBY" => "",
            "language" => "1",
            'api_token' => Helper::getCurrentuserToken(),
        );

        $apiurl = config('apipath.marketing-contact-group-view');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        
        if (!empty($responseData))
        {
          $this->content = $responseData->data;
          $this->content->group_id = $id;
        }

        if (!empty( $this->data)) {
            return view('Marketing::contact.group_contact_list', collect( $this->data));
        } else {
            return view('Marketing::contact.group_contact_list', collect( $this->data));
        }
    }


    // Show Contact Sources Page

    public function contactSource(){
        
        $sourceArray=["lead","customer","imported"];
        $count=[];
        $content=[];

        foreach($sourceArray as $source_data)
        {   
            // try{
            $parameters = array(
                "source" => $source_data,
                'api_token' => Helper::getCurrentuserToken(),
            );

            $apiurl = config('apipath.marketing-source-contacts');
            $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
          
            if(!empty($responseData->data))
            {
                $count[$source_data]=$responseData->data->total_records;

                if(!empty($responseData->data->campDetails))
                {   
                     $count[$source_data.'_camp_count']=count((array)$responseData->data->campDetails);
               
                     $total_mail=0;
                     foreach($responseData->data->campDetails as $campData)
                     {            
                    
                        $total_mail+=$campData->email_count_count ?? 0; 
                    
                     }

                     $count[$source_data.'_campemail_count']=$total_mail;
                }
            }
            else
            $count[$source_data]=0;
        //   }
        //   catch(Exception $e)
        //   {
        //     dd($e->getMessage());
        //   }
        }
        if(sizeof($count)>0)
        $this->content=$count;
 
        return view('Marketing::contact.contact_source', collect($this->data));
    }


    // Show Marketing Contact  Group

    public function contactGroups()
    {
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

        $parameters = array(
            "page" => $page,
            "perPage" => "10",
            "search" => "",
            "sortBy" => "",
            "orderBY" => "",
            "language" => "1",
            'api_token' => Helper::getCurrentuserToken(),
            'start_date'=>$start_date,
            'end_date'=>$end_date,
        );

        $apiurl = config('apipath.marketing-contact-group');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        if (!empty($responseData))
        $this->content = $responseData->data;

        return view('Marketing::contact.contact_group', collect($this->data));
    }




    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    //  Store Contact Groups

    public function store(Request $request)
    {
        $parameters = array(
            "group_name" => $request->group_name,
            "description" => $request->details,
            'api_token' => Helper::getCurrentuserToken(),
        );
    
        $apiurl = config('apipath.marketing-contact-group-store');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        $message = Helper::translation($responseData->message);
       
        if ($responseData->status) {
            return response()->json(['status'=>'success','message' => $message]);
        } else {
            return response()->json(['status'=>'error','message' => $message]);
        }
    }

   

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //  Edit Conatact Group  

    public function edit(Request $request)
    {
        $parameters = array(
            "group_id" => $request->group_id,
        );
        $apiurl = config('apipath.marketing-contact-group-edit');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        $message = Helper::translation($responseData->message);

        if (isset($message)) {
            return response()->json(['message', $responseData->data]);
        } else {
            return response()->json(['message', $responseData['message']]);
        }
    }

  //  Update Contact Group  

    public function contactGroupUpdate(Request $request)
    {
        $parameters = array(
            "group_id" => $request->group_id,
            "group_name" => $request->group_name,
            "description" => $request->details,
            'api_token' => Helper::getCurrentuserToken(),
        );
        
        $apiurl = config('apipath.marketing-contact-group-update');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        $message = Helper::translation($responseData->message);

        if (isset($message)) {
            return response()->json(['success' => $message]);
        } else {
            return response()->json(['success' => $responseData['message']]);
        }
    }
   
    // Contact Group Status Update 

    public function changeContactGroupStatus(Request $request)
    {
        $parameters = array(
            "status" => $request->status,
            "group_id" => $request->group_id,
        );
        $apiurl = config('apipath.marketing-contact-group-status');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        $message = Helper::translation($responseData->message);

        if ($message) {
            return response()->json(['success' => $message]);
        } else {
            return response()->json(['success' => $responseData['message']]);
        }
    }

    //  Delete Group Delete

    public function  deleteContactGroup($id)
    {
        $parameters = array(
            "group_id" => $id,
        );
        
        $apiurl = config('apipath.marketing-contact-group-delete');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        $message = Helper::translation($responseData->message);

        if ($message) {
            return response()->json(['success' => $message]);
        } else {
            return response()->json(['success' => $responseData['message']]);
        }

    }

    

    //  Store Contact 

    public function storeContact(Request $request)
    {
        $parameters = array(
            "contact_name" => $request->contact_name,
            "contact_email" => $request->contact_email,
            "company" => $request->company,
            "website" => $request->website,
            "countries_id" => $request->country,
            "phone" => $request->phone,
            "address" => $request->address,
            "id" => $request->contact_group,
            'api_token' => Helper::getCurrentuserToken(),
        );
        $apiurl = config('apipath.marketing-contact-store');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        $message = Helper::translation($responseData->message);

        if (!empty($message)) {
            return redirect()->route('marketing.contact-group-view', $responseData->data->contact_group->group_id)->with('message', $message);
        } else {
            return redirect()->route('marketing.contact-group-view', $responseData->data->contact_group->group_id)->with('message', $responseData['message']);
            // return response()->json(['success',$responseData['message']]);
        }
    }

    // Contat list create page

    public function contactCreate(Request $request)
    {  
        $parameters = array();

        $apiurl = config('apipath.marketing-contact-create');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
     

        if (isset($responseData->data)) {
            return view('Marketing::contact.create', collect($responseData->data));
        } else {
            return view('Marketing::contact.contact_lists', $responseData['message']);
        }
    }

    // Contact Import Page 

    public function contactImport(Request $request,$id=null) // Import Exel File
    {
        $apiurl = config('apipath.marketing-contact-import');
        $responseData = Helper::ApiServiceResponse($apiurl, []);
        $responseData->data->group_id=$id;
 
        return view('Marketing::contact.import_exel.import ', collect($responseData->data));
    }

    //  Store Contact Import Exel File

    public function contactImportStore(Request $request)
    {   
        if ($_FILES['import_file']['name']) {

            $files = [];

            $parameters =array(
                "contact_group" => $request->contact_group,
            ); 
            
            if( $request->hasFile('import_file')){
                $import_files = $request->file('import_file');
                $file_ary = [
                'name' => 'import_file',
                'contents' => file_get_contents($import_files),
                'filename' => $import_files->getClientOriginalName()
                ];
                array_push($files, $file_ary);
            }
 

            $apiurl = config('apipath.marketing-contact-list-import-process');
            $responseData = Helper::ApiServiceResponse($apiurl, $parameters, $files);
        
            if(isset($responseData->status) && ( $responseData->status == 'validation')) {
                return redirect()->back()->withErrors($responseData->message)->withInput();
            }

            $message = Helper::translation($responseData->message);
            return redirect()->route('marketing.contact-group', ['id'=>$request->contact_group])->with('success', $message);

        } else {
            return redirect()->route('marketing.contact-import')->with('error',"Please upload a file !");
        }
    }

    // Edit Contacts

    public function groupContactEdit(Request $request, $id)
    {
        $parameters = array( "id" => $request->id);
        $apiurl = config('apipath.marketing-contact-edit');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        if (isset($responseData->data)) {
            return view('Marketing::contact.edit', collect($responseData->data));
        } else {
            return view('Marketing::contact.edit', collect($responseData['message']));
        }
    }

    // Delete Conatact 

    public function groupDeleteContact(Request $request)
    {
        $parameters = array(
            "contact_id" => $request->contact_id,
            'api_token' => Helper::getCurrentuserToken(),
        );

        $apiurl = config('apipath.marketing-contact-delete');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
 
        if (isset($responseData->data)) {
            return response()->json(['success', $responseData->data]);
        } else {
            return response()->json(['success', $responseData['message']]);
        }
    }


    // Show Contacts List According To Source

    public function contacList(Request $request, $source)
    {   
        $sources=['customer','lead','imported'];
        $subSource='';

        if(in_array($source,$sources))
        {   
            if(isset(request()->subsource))
             $subSource=request()->subsource;

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
    
            $parameters = array(
                "source" => $source,
                'subsource'=>$subSource,
                "page" => $page,
                "perPage" => "10",
                "search" => "",
                "sortBy" => "",
                "orderBY" => "",
                "language" => "1",
                'api_token' => Helper::getCurrentuserToken(),
                'start_date'=>$start_date,
                'end_date'=>$end_date,  
            );
    
    
            $apiurl = config('apipath.marketing-source-contacts');
            $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        
            if (!empty($responseData))
            {
              $this->content = $responseData->data;
            }
    
            if (!empty( $this->data)) {
                return view('Marketing::contact.contact_lists', collect( $this->data));
            } else {
                return view('Marketing::contact.contact_lists', collect( $this->data));
            }

        }
        else
        {
            return back();
        }


    }   

    // Update contact

    public function groupContactUpdate(Request $request)
    {
        $parameters = array(
            "contact_name" => $request->contact_name,
            "contact_email" => $request->contact_email,
            "company" => $request->company,
            "website" => $request->website,
            "countries_id" => $request->country,
            "phone" => $request->phone,
            "address" => $request->address,
            "group_id" => $request->contact_group,
            "id" => $request->contact_id,
            'api_token' => Helper::getCurrentuserToken(),
        );
     
        $apiurl = config('apipath.marketing-contact-update');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        $message = Helper::translation($responseData->message);

        if (!empty($responseData->message)) {
            return redirect()->route('marketing.contact.index',['id'=>$request->contact_group])->with('true', $message);
        } else {
            return redirect()->route('marketing.contact.index',['id'=>$request->contact_group])->with('false', $responseData['message']);
        }
    }

    // Contact Group Filter 

   public function contactGroupFilter(Request $request)
   {
        $parameters = array(
            "start_date" => $request->start_date,
            "end_date" => $request->end_date,
            "search" => $request->search,
        );

        $apiurl= config('apipath.marketing-contact-group');

        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);

        if (!empty($responseData)){
            $this->content = $responseData->data;
        }

        $returnHTML = view('Marketing::contact.contact_grp_filter', collect($this->data))->render();

        return response()->json(['success' => true, 'html'=>$returnHTML]);
   }


   // Download Sample XLS File

   public function donwloadFile(){
       
    $myFile = public_path("/import_sample_file.xls");

    return response()->download($myFile);
   }

     // Contact List Filter
  
  public function contactListFilter(Request $request)
  { 
       $parameters = array(
           "perPage" => "10",
           "start_date" => $request->start_date,
           "end_date" => $request->end_date,
           "search" => $request->search,
           'source'=> $request->source,
           'subsource'=> $request->subsource,
           'approvalStatus'=> $request->approvalStatus,
           'subsStatus'=> $request->subsStatus,
           'emailStatus'=> $request->emailStatus,
       );

       $apiurl= config('apipath.marketing-source-contacts');

       $responseData = Helper::ApiServiceResponse($apiurl, $parameters);

       if (!empty($responseData)){
        $this->content = $responseData->data;
        $this->content->group_id = $request->source;
       }
       
       $returnHTML = view('Marketing::contact.filter_response', collect($this->data))->render();
       return response()->json(['success' => true, 'html'=>$returnHTML]);
  }

}
