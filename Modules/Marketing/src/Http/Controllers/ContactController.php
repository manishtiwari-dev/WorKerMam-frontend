<?php

namespace Modules\Marketing\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Marketing\Models\Contact;
use Modules\CRM\Models\MasCountry;
use Modules\Marketing\Models\ContactGroup;
use Modules\Marketing\Models\ContactToGroup;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ContactListImport;
use Session;



class ContactController extends Controller
{
 


    public function index()
    {
        // $contact_list = Contact::paginate(10);
        // $country_name = MasCountry::get();
        // $contact_group = ContactGroup::all();
        // $contact_to_group = ContactToGroup::all();

       
        return view('Marketing::contact_list.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $contact_list = new Contact();
        $contact_list->contact_name = $request->name;
        $contact_list->contact_email = $request->email;
        $contact_list->company = $request->company;
        $contact_list->website = $request->website;
        $contact_list->country_code = $request->country;
        $contact_list->phone = $request->phone;
        $contact_list->address = $request->address;
        $contact_list->blocked = 0;
        $contact_list->updated_at = null;
        $contact_list->save();
        $contact_id = $contact_list->id;
        
        $contact_to_group = ContactToGroup::create([
            'group_id'    => $request->contact_group,
            'contact_id'  => $contact_id,
            'status'      => 1,
        ]); 

        return response()->json(['contact_list'=>$contact_list, 'contact_to_group'=> $contact_to_group,'success'=>'Contact List Added Successfully']);
        
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
        $contactlist = ContactToGroup::find($id);
        $contact_id = $contactlist->contact_id;
        $contact = Contact::where('id',$contact_id)->first();
        $getCountryName = MasCountry::where('countries_iso_code_3',$contact->country_code)->get('countries_name');
        return response()->json(['contact'=>$contact,'getCountryName' => $getCountryName]);
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
        
    }

     public function updateContact(Request $request)
    {
        
        $contact_list =  Contact::where('id', $request->hidden_id)->first();
        $contact_list->contact_name = $request->name;
        $contact_list->contact_email = $request->email;
        $contact_list->company = $request->company;
        $contact_list->website = $request->website;
        $contact_list->country_code = $request->country;
        $contact_list->phone = $request->phone;
        $contact_list->address = $request->address;
        $contact_list->update();
        

        $templategroup = ContactToGroup::where('contact_id',$request->hidden_id)->first();
        $templategroup->group_id = $request->contact_group;
        $templategroup->update();
        return response()->json(['contact_list'=>$contact_list,'templategroup' => $templategroup, 'success'=>'Contact List Updated  Successfully']);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Contact::where('id', $id)->exists()) {
        Contact::where('id' ,$id)->delete();
        ContactToGroup::where('contact_id' ,$id)->delete();
            return response()->json(['success'=>' Contact List Deleted Successfully']);
        }else{
            return response()->json(['error'=>' Contact List dont Deleted']);
        }
    }

     public function deleteContact(Request $request)
    {
        
    }

     public function changeContactListStatus(Request $request)
    {
       
        $contactListStatus = ContactToGroup::where('id' ,$request->id)->first();
        $contactListStatus->status = $request->blocked;
        $contactListStatus->update();
        return response()->json(['success'=>' Contact List Status Changed Successfully']);
    }

    public function checkgroupbox(Request $request)
    {
        

        $insetcontactid = $request->contact_id;
        if($insetcontactid){
            foreach($insetcontactid as $contact_id_list){
                $checkuniqedata = ContactToGroup::where(['contact_id' => $contact_id_list,'group_id'=> $request->group_id])->first();
                if(!($checkuniqedata)){
                $chagestatus = new ContactToGroup();
                $chagestatus->contact_id = $contact_id_list;
                $chagestatus->group_id = $request->group_id;
                $chagestatus->updated_at = null;
                $chagestatus->save();
                }else{
                    return response()->json(['error'=>' Already Insert Add Contact Group']);
                }
                }
            return response()->json(['success'=>' Group Add Contact Successfully']);
        }
    }
    
    public function GetContact(Request $request,$id)
    {
        
       $showGroupName = ContactGroup::where('id',$id)->get('group_name');
        $ShowContact = ContactToGroup::where('group_id',$id)->get();
        return view('Marketing::contact_list.get-contact-list',compact('showGroupName', 'ShowContact'));
    }
    public function ChangeContactToGroupStatus(Request $request)
    {
        $contactStatus = ContactToGroup::find($request->id);
        $contactStatus->status = $request->status;
        $contactStatus->update();
        return response()->json(['status' => 1, 'message' => '  Contact To Group Status Changed Successfully']);
    }
    public function import(){
        // $showGroupName = ContactGroup::all();
        // $country_name = MasCountry::get();

        return view('Marketing::contact_list.bulk-import');
    }
     
    public function uploadContactList(Request $request)
    {       
        $request->validate([
            'file'  => 'required',
        ]);

            Session::put(['contact_group'=> $request->group_id,'country_contact_id' => $request->contact_group]);

           Excel::import(new ContactListImport, $request->file);
      
        //    return redirect()->route('contact-list.index')->with('success', 'Contact Added Successfully');
           return redirect('marketing/contact-list/'.$request->group_id)->with('success', 'Contact Added Successfully');  

    }
    public function donwloadFile(){
       
        $myFile = public_path("/importsimplefile.xls");
     
    	return response()->download($myFile);
    }
    public function GetGroupId(Request $request,$id)
    {
        // $contactData = ContactGroup::find($id);
        // $contact_list = Contact::paginate(10);
        // $country_name = MasCountry::get();
        // $contact_group = ContactGroup::all();
        // $contact_to_group = ContactToGroup::where('group_id',$contactData->id)->paginate(10);
        // return view('Marketing::contact_list.index', compact('contact_list','country_name','contact_group','contactData','contact_to_group'));
        return view('Marketing::contact_list.index');
    }

   
}

 
 