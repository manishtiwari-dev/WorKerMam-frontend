<?php
namespace Modules\SEO\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use App\Helper\Helper;
use Redirect;
use App\Services\ApiService;
use App\Http\Controllers\BaseController;

class SeoResultController extends BaseController
{
    public function __construct()
    {
        $this->pageAccess = config('acceskey.monthly_result');
        $this->pageTitle = 'Seo Monthly Result';
 
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->content = []; 
        
        $parameters =array(
            "page" => '1',
            "perPage" => "2",
            "search" => "",
            "sortBy"=> "",
            "orderBY" => "", 
            "language" => "1", 
             'api_token'=>Helper::getCurrentuserToken(),
        );
    
        $apiurl = config('apipath.seo-monthlyResult');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
       
        
        if(!empty($responseData))
        $this->content = $responseData->data;

        

        return view('SEO::seo-monthly-result.index' ,collect($this->data));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $parameters = array(
            "website_id" => $request->website_id,
            "title_id" => $request->title_id,
            "month" => $request->month,
            "year" => $request->year,
            "result_value" => $request->result_value,
        );

        

        $apiurl = config('apipath.seo-monthlyResult-store');
      
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        $message = Helper::translation($responseData->message);

        if ($responseData) {
            return response()->json(['success'=>$message]);
        } else {
            return response()->json(['error'=>$message]);
        }

    }



    public function getMonthlyResult(Request $request)
    {

        $parameters =array(
                
            "page" => '1',
            "perPage" => "2",
            "search" => "",
            "sortBy"=> "",
            "orderBY" => "",
            "language" => "1",
            "website_id" => $request->website_id,
            "month" => $request->month,
            "year" => $request->year,
        );
    
        $apiurl = config('apipath.seo-monthlyResult-show');
                

        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
// dd($responseData);
        return response()->json(collect($responseData->data));
    }


    public function exportMonthlyResult(Request $request){


        // $request->validate([
        //     'website' => 'required',
        //     'start_date' => 'required'
        // ]);

        $parameters =array(
            "website" => $request->website_id,
            "month" => $request->month,
            "year"=>$request->year
        );

       // dd($parameters);


        $apiurl = "https://workerman.com/backend/public/api/seoMonthlyResult/export-monthly-result"; 
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters); 
        $message = Helper::translation($responseData->message);


        if($responseData->status == true){
            return response()->download($responseData->data);
        }else{
           return Redirect::back()->with('error', $message);
        }


         
      
    }

}