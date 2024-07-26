<?php
namespace Modules\Recruit\Http\Controllers;
   
use Yajra\DataTables\Facades\DataTables; 
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Helper\Helper;

class JobOfferQuestionController extends BaseController
{

   public function __construct()
   {
    $this->pageAccess = config('acceskey.onboard_offer');
    $this->pageTitle = 'Onboard Offer Question';

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
            "language" => "1",
            'api_token' => Helper::getCurrentuserToken(),
        );

         $apiurl = config('apipath.onboard-offer-index');
         $responseData = Helper::ApiServiceResponse($apiurl, $parameters);

         if(!empty($responseData))
         $this->content = $responseData->data;
 
        
        return view('Recruit::job-offer-question.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->content = [];
        $parameters =array( 
            'api_token' => Helper::getCurrentuserToken(),
        );

            $apiurl = config('apipath.onboard-offer-create');
            $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
 
        if(!empty($responseData))
        $this->content = $responseData->data;
        $this->Title = 'Onboard Offer Create';

        return view('Recruit::job-offer-question.create', $this->data); 
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
            'question' => $request->question,
            'required' => $request->required,
            'type' => $request->type,
            'api_token' => Helper::getCurrentuserToken(),
        );

        $apiurl = config('apipath.onboard-offer-store');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);

        $message = Helper::translation($responseData->message); 

        return redirect()->route('recruit.job-onboard-questions.index')->with(['success' => $message]);
 
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

         $this->content = [];
            $parameters =array(
                'id' => $id,
                'api_token' => Helper::getCurrentuserToken(),
         );

         $apiurl = config('apipath.onboard-offer-edit');
         $responseData = Helper::ApiServiceResponse($apiurl, $parameters);

         if(!empty($responseData))
         $this->content = $responseData->data;
         $this->Title = 'Onboard Offer Update'; 
         return view('Recruit::job-offer-question.edit', $this->data);

          
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
            'id' => $id,
            'question' => $request->question,
            'required' => $request->required,
            'type' => $request->type,
            'api_token' => Helper::getCurrentuserToken(),
        );

        $apiurl = config('apipath.onboard-offer-update');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);

        $message = Helper::translation($responseData->message);

        return redirect()->route('recruit.job-onboard-questions.index')->with(['success' => $message]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         
        
         $parameters = array(
            "id" => $id,
            'api_token' => Helper::getCurrentuserToken(),

         );

         $apiurl = config('apipath.onboard-offer-destroy');
         $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
          
         $message = Helper::translation($responseData->message);
         return response()->json(['success' => $message]);
    }


    public function data() {


       $parameters = array( 
        'api_token' => Helper::getCurrentuserToken(),

       );

       $apiurl = config('apipath.onboard-offer-data'); 

       $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
 

        return DataTables::of($responseData->data)
            ->addColumn('action', function ($row) {
            $action = '';
            $action.= '<a href="' . route('recruit.job-onboard-questions.edit', [$row->id]) . '"
                class="btn btn-primary btn-circle" data-toggle="tooltip" onclick="this.blur()"
                data-original-title="'.__('app.edit').'"><i class="fa fa-pencil" aria-hidden="true"></i></a>';



            $action.= ' <a href="javascript:;" class="btn btn-danger btn-circle sa-params" data-toggle="tooltip"
            onclick="this.blur()" data-row-id="' . $row->id . '" data-original-title="'.__('app.delete').'"><i
                class="fa fa-times" aria-hidden="true"></i></a>';

           return $action;
           })
           ->editColumn('required', function ($row) {
           return ucfirst($row->required);
           })
           ->editColumn('question', function ($row) {
           return ucfirst($row->question);
           })
           ->rawColumns(['question', 'required', 'action'])
           ->addIndexColumn()
           ->make(true);

        }

}