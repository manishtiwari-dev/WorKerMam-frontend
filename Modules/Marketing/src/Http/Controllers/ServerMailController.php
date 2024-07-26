<?php

namespace Modules\Marketing\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Marketing\Models\ServerMail;
// use Modules\UserManage\Models\Role;
use Illuminate\Support\Facades\Hash;
use Auth;

class ServerMailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $server_list = ServerMail::paginate(10);
        // return view('Marketing::settings.index',compact('server_list'));
        
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
       
        $request->validate([
            'name'       => 'required',
            // 'provider'   => 'required',
            'driver'     => 'required',
            // 'host'       => 'required',
            // 'port'       => 'required',
            // 'username'   => 'required',
            // 'encryption' => 'required',
            // 'sendmail'   => 'required',
            // 'password'   => 'required',
            // 'from_name'  => 'required',
            // 'from_email' => 'required',
            // 'pretend'    => 'required',
            // 'status' => 'required',
        ]);
        /* New Use added */


        $ServerMail = new ServerMail();
        $ServerMail->name = $request->name;
        $ServerMail->provider_name = $request->provider ?? null;
        $ServerMail->driver = $request->driver;
        $ServerMail->host = $request->host;
        $ServerMail->port = $request->port;
        $ServerMail->username = $request->username;
        $ServerMail->encryption = $request->encryption;
        $ServerMail->sendmail = $request->sendmail;
        $ServerMail->from_name = $request->from_name ?? null;
        $ServerMail->from_email = $request->from_email ?? null;
        $ServerMail->pretend = $request->pretend;
        $ServerMail->password = $request->password;
        $ServerMail->updated_at = null;
        $ServerMail->save();
        return response()->json([ 'success'=>'Server Mail added successfully']);
        
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
        $edit_server = ServerMail::find($id);
        return response()->json(['edit_server'=>$edit_server]);
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
    public function ServerUpdate(Request $request)
    {
      
        $request->validate([
            'name'       => 'required',
            // 'provider'   => 'required',
            'driver'     => 'required',
            // 'host'       => 'required',
            // 'port'       => 'required',
            // 'username'   => 'required',
            // 'encryption' => 'required',
            // 'sendmail'   => 'required',
            // 'password'   => 'required',
            // 'from_name'  => 'required',
            // 'from_email' => 'required',
            // 'pretend'    => 'required',
            // 'status' => 'required',
        ]);
        if($request->driver == "send_mail"){
            $update_sender =  ServerMail::where('id', $request->server_hidden_id)->update([
                'name'=>$request->name,
                'provider_name'=>$request->provider,
                'driver'=>$request->driver,
                'host'=>null,
                'port'=>null,
                'username'=>null,
                'encryption'=>null,
                'sendmail'=>null,
                'password'=>null,
                'from_name'=>$request->from_name,
                'from_email'=>$request->from_email,
                'pretend'=>$request->pretend,
        ]);
        }else{
            $update_sender =  ServerMail::where('id', $request->server_hidden_id)->update([
                'name'=>$request->name,
                'provider_name'=>$request->provider,
                'driver'=>$request->driver,
                'host'=>$request->host,
                'port'=>$request->port,
                'username'=>$request->username,
                'encryption'=>$request->encryption,
                'sendmail'=>$request->sendmail,
                'password'=>$request->password,
                'from_name'=>$request->from_name,
                'from_email'=>$request->from_email,
                'pretend'=>$request->pretend,
        ]);
        }

       
       return response()->json(['success'=>' Updated Successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       
        if (ServerMail::where('id', $id)->exists()) {
            ServerMail::where('id',$id)->delete();
            return response()->json(['success' => 'Server Mail deleted successfully']);
        } else{
            return response()->json(['error' => 'Sender Mail already deleted!']);
        }
        
    }
    public function ChangeServerStatus(Request $request)
    {
        
        $server_status =  ServerMail::where('id' ,$request->server_id)->first();
        $server_status->active = $request->server_status;
        $server_status->update();
        return response()->json(['success' => 'Server Mail Status Changed']);
    }
}
