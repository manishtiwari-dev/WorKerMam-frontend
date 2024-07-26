<?php

namespace App\Imports;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Str;
use Modules\Newsletter\Models\Contact;
use Modules\Newsletter\Models\ContactToGroup;
use Illuminate\Support\Facades\Validator;
use Session;

class ContactListImport implements ToModel, WithHeadingRow
{
    /** 
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    

    public function model(array $row)
    {
        
        Validator::make($row, [
             'contact_name'  => 'required',
             'contact_email' => 'required',
             'company'       => 'required',
             'website'       => 'required',
             'phone'         => 'required',
             'address'       => 'required',
         ])->validate();


            $contact_group = Session::get('contact_group');
            $country_id = Session::get('country_contact_id');


            $contact_list = Contact::create([

                'contact_name'  => $row['contact_name'],
                'contact_email' => $row['contact_email'],
                'company'       => $row['company'],
                'website'       => $row['website'],
                'country_code'  => $country_id,
                'phone'         => $row['phone'],
                'address'       => $row['address'],
                'favourites'    => 0,
                'blocked'       => 0,
                'trashed'       => 0,
                'is_subscribed' => 0,
            ]);

            $contact_list_id = $contact_list->id;
            return new ContactToGroup([
                'contact_id' => $contact_list_id,
                'group_id'   => $contact_group,
                'status'     => 1,
            ]);

            // dd($contact_list);
            // return Session::put(['contact_list'=> $contact_list]);
            // return $contact_list;
    }
}
