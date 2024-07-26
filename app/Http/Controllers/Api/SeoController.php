<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Http;
use App\Services\ApiService;

class SeoController extends Controller
{
    public function index(Request $request)
    {   

        
        $api_token = session('api_token');

        if($api_token){

            $parameter =array(
                "api_token" => $api_token,
                "page" => '1',
                "perPage" => "2",
                "search" => "",
                "sortBy"=> "",
                "orderBY" => "",
                "language" => "1",
            );
    
            $apiurl = "https://e-nnovation.net/backend/public/api/categories";
    
    
            $response = ApiService::post($apiurl, $parameter);

            dd($response);

        } else{
            echo "Unauthorized Access!!";
        }

        
    


    }

}