<?php

namespace Modules\Pcapi\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;
use Auth;
use Illuminate\Support\Str;
use App\Services\ApiService;
use App\Helper\Helper;



class Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public static function index(Request $request)
    {
        // 
    }
}