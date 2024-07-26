<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Session;
use Closure;
use App\Helper\Helper;
use Illuminate\Support\Facades\Cache;
use Illuminate\Routing\Redirector;
use Illuminate\Http\Response;
use Cookie;

class ApiTokenCheck
{


    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */

     public function handle($request, Closure $next)
    {

        if ($request->has('token')) {
            //if (!Cache::has('api_token')) {
                if($request->token != ''){
                    $token_response = Helper::authenticateToken($request->token);
                    
                    if($token_response->status == 'valid'){
                        Helper::languageData('en');


                        Cache::forever('userdata-'.$request->token, $token_response->data);

                        if(request()->hasCookie('api_token')){
                            Cookie::expire('api_token');
                        }
                        
                        Session::put('api_token', $request->token);


                        $response = $next($request);
                        
                        $test = $request->cookie('api_token', 0);
                        $response->cookie('api_token', $request->token, 43200);
                        
                        return $response;

                    } else{
                       // return redirect()->away('https://app.workerman.com');
                    }
                    
                }
           // }            
        } else{

           // if(request()->cookie('api_token') == '')
           // return redirect()->away('https://app.workerman.com');
        }
 
        return $next($request);
    }


}
