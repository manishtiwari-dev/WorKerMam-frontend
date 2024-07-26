<?php

namespace App\Helper;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\Models\Industry;
use App\Models\UserBusiness;
use App\Models\Subscription;
use Modules\AddOnManager\Models\AddOn;
use App\Services\ApiService;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Auth;
use NumberFormatter;
use Session;

class Helper
{
    public static function role_slug()
    {

        $role_slug =  !empty(Auth()->user()->role->roles) ? Auth()->user()->role->roles->roles_key : '';
        return $role_slug;
    }

    public static function essential_config_regenerate($db_id = '')
    {

        $sub_prefix = env('DB_SUBSCRIBER_PREFIX', 'wm_subs_');
        $dbsuperadmin = env('DB_SUPERADMIN', 'wm_superadmin');
        $db_id = Session::get('db_id');

        if (isset($db_id) && $db_id > 0) {

            //SUBSCRIBER DATABASE
            $db_name = $sub_prefix . $db_id;
        } else if ($db_id == 0) {
            $db_name = $dbsuperadmin;
        }

        //USER RELATED TABLE
        $users_table = $db_name . '.usr_users';
        $roles_table = $db_name . '.usr_roles';
        //$permissions_table = $db_name . '.usr_permissions';
        //$permissions_table = $db_name . '.app_permissions';

        $user_has_roles_table = $db_name . '.usr_user_has_roles';
        $role_has_permissions_table = $db_name . '.usr_role_has_permissions';
        $user_logins_table = $db_name . '.usr_user_logins';


        config(['dbtable.common_users' => $users_table]);
        config(['dbtable.common_roles' => $roles_table]);
        config(['dbtable.common_user_has_roles' => $user_has_roles_table]);
        config(['dbtable.common_role_has_permissions' => $role_has_permissions_table]);
        config(['dbtable.common_user_logins' => $user_logins_table]);


        $sub_subscription_to_user_table = $dbsuperadmin . '.sub_subscription_to_user';

        config(['dbtable.common_sub_subscription_to_user_table' => $sub_subscription_to_user_table]);
    }




    public static function DBConnect()
    {
        $database_suffix =  session()->get('db_id');

        //dd( $database_suffix );

        if ($database_suffix && $database_suffix > 0) {
            $sub_prefix = env('DB_SUBSCRIBER_PREFIX', 'wm_subs_');
            $currentDatabase = $sub_prefix . $database_suffix;

            $tenantPath = storage_path('framework/cache/data/' . $database_suffix);
            // Erase the tenant connection, thus making Laravel get the default values all over again.
            DB::purge('mysql');
            // Make sure to use the database name we want to establish a connection.

            Config::set('cache.prefix', $database_suffix);
            Config::set('database.connections.mysql.database', $currentDatabase);
            config(['cache.stores.file.path' => $tenantPath]);
            Cache::forgetDriver();

            // Rearrange the connection data
            DB::reconnect('mysql');
            // Ping the database. This will throw an exception in case the database does not exists.
            Schema::connection('mysql')->getConnection()->reconnect();
        }

        //update_mail_config();
        $utype = session()->get('utype');
        if ($utype == 2) {
            $current_indutry_id = self::get_industry_id();
            $enable_module = '';
            if ($current_indutry_id == 1) {
                $enable_module = array('CRM', 'Setting', 'Newsletter', 'Usermanage', 'AddOnManager', 'Pcapi');
            } else if ($current_indutry_id == 2) {
                $enable_module = array('CRM', 'Setting', 'Newsletter', 'Usermanage');
            } else if ($current_indutry_id == 3) {
                $enable_module = array('SEO', 'AddOnManager', 'Newsletter', 'Usermanage');
            }
        } else if ($utype == 1) {
            $enable_module = array('SEO', 'Usermanage');
        } else {
            $enable_module = '';
        }

        Config::set('module.enable', $enable_module);
    }



    public static function get_industry_id($subscription_id = '')
    {
        $subscription_id =  session()->get('subs_id');

        // $userEmail = $request->email;
        $business = UserBusiness::where('subscription_id', $subscription_id)->first();
        if ($business !== null) {
            return !empty($business->subscription) ? $business->subscription->industry_id : 0;
        } else {
            return 0;
        }
    }

    // add on activation check

    public static function addon_is_activated($identifier, $default = null)
    {
        // $addons = Cache::remember('addons', 86400, function () {
        //     return Addon::all();
        // });

        $activation = Addon::where('unique_identifier', $identifier)->where('activated', 1)->first();
        return $activation == null ? false : true;
    }

    public static function authenticateToken($token)
    {

        $returnAry = new \stdClass();

        $parsed = parse_url(url()->previous());
        if ($parsed['host'] == config('app.app-host')) {
            $apiurl = config('apipath.authenticateToken');
            $parameters = [
                'api_token' => $token,
            ];

            $response = ApiService::postWithJson($apiurl, $parameters);

            //$return_data =  self::array_to_object($response);

            $returnAry->status = 'valid';
            $returnAry->data = $response->data;

            return $returnAry;
        } else {
            $returnAry->status = 'invalid';
            return $returnAry;
        }
    }

    public static function languageData($language)
    {

        $parameters = array(
            "lang_key" => 'backend',
            "language" => 'en'
        );

        $apiurl = config('apipath.globalsetting');
        $response = ApiService::postWithJson($apiurl, $parameters);
        //$return_data =  self::array_to_object($response);

        $lang_array = (array) json_decode($response->data->language_data->lang_value);

        Cache::put('languageKey', $lang_array, 10000);
    }


    // translation using translation name function
    public static function translation($param)
    {
        if (!Cache::has('languageKey')) {
            self::languageData('en');
        }
    
        $langKey = Cache::get('languageKey');
    
        // Check if $langKey is an array before using array_key_exists
        if (is_array($langKey)) {
            return array_key_exists($param, $langKey) ? $langKey[$param] : $param;
        } else {
            // Handle the case where $langKey is not an array, e.g., log an error or return a default value.
            // You can also consider re-populating the cache in this case.
            return $param;
        }
    }
    

    public static function getCurrentuserToken()
    {
        if (session()->has('api_token')) {
            $api_token = Session::get('api_token');
        } else {
            $api_token = request()->cookie('api_token');
        }

        return $api_token;
    }


    public static function ApiServiceResponse($apiurl, $parameters, $files=[])
    {

        $api_token = self::getCurrentuserToken();

        if ($api_token) {
            if (!array_key_exists("api_token", $parameters)) {
                $parameters =  Arr::add($parameters, 'api_token', $api_token);
            } else {
                $parameters['api_token'] = $api_token;
            }

            if ($apiurl != '') {


                if(!empty($files)){
                    $response = ApiService::postWithFile($apiurl, $parameters, $files);
                } else {
                    $response = ApiService::postWithJson($apiurl, $parameters);
                }

                if (!empty($response)) {

                    if ($response->status == 200 && $response->status == true) {
                        return $response;
                    } else {

                        return $response;
                    }
                } else {
                    $return_data = ["message" => "Issue while fetch data"];
                }
            }
        } else {
            return redirect('404');
            $return_data = ["message" => "Unauthorized Access"];
        }
    }

    

    public static function   ProductApiServiceResponse($apiurl, $parameters, $fileField = "", $filePath = "")
    {

        $api_token = "34234";

        if ($api_token) {
            if (!array_key_exists("api_token", $parameters)) {
                $parameters =  Arr::add($parameters, 'api_token', $api_token);
            } else {
                $parameters['api_token'] = $api_token;
            }

            if ($apiurl != '') {

                if ($fileField != '' && $filePath != '') {
                    $response = ApiService::postWithFile($apiurl, $parameters, $fileField, $filePath);
                } else {
                    $response = ApiService::postWithJson($apiurl, $parameters);
                }

                if (!empty($response)) {

                    if ($response->status == 200 && $response->status == true) {
                        return $response;
                    } else {

                        return $response;
                    }
                } else {
                    $return_data = ["message" => "Issue while fetch data"];
                }
            }
        } else {
            return redirect('404');
            $return_data = ["message" => "Unauthorized Access"];
        }
    }


    public static function array_to_object(array $array)
    {
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $array[$key] = self::array_to_object($value);
            }
        }
        return (object)$array;
    }


    // Pagination Maker

    public static function make_pagination($total_records, $per_page, $current_page, $total_page, $route,$param=[])
    {   
        // dd($param);
        // public function routeBuilder($page_array) {
            
        //     // global $param,$route;
        //     $route='';
        //     $paramArray=array_merge($param,$page_array);
        //     $route=route($route,$paramArray);
            
        //     return $route;
        // }

        $html = '';


        if (ceil($total_records / $per_page) > 1) {

            $html .= '<ul class="pagination justify-content-center mt-4">';

            if ($current_page > 1) {

                // $row =0;
                // $row= (($current_page-1)*$per_page);
                // $row++;
                // $route1=route($route, array_merge($param, ['page'=>$row]));

             $route1=route($route, array_merge($param, ['page'=>($current_page - 1)*$per_page]));
                
                $html .= '<li class="prev page-item"><a class="page-link"
                        href="'.$route1.'">Prev</a></li>';
            }

            if ($current_page > 3) {

                $route2=route($route, array_merge($param, ['page'=>1]) );
             
                $html .= '<li class="start page-item"><a class="page-link" href="' . $route2 . '">1</a></li>
                <li class="dots page-link">........</li>';
            }

            if ($current_page - 2 > 0) {

                $route3= route($route, array_merge($param, ['page'=>($current_page - 2)]));
               
                $html .= '<li class="page page-item"><a class="page-link"
                        href="' . $route3 .'">' . ($current_page - 2) . '</a></li>';
            }
            if ($current_page - 1 > 0) {

                $route4= route($route, array_merge($param, ['page'=>($current_page - 1)]));
              
                $html.= '<li class="page"><a class="page-link"
                        href="' . $route4 .'">' . ($current_page - 1) . '</a></li>';
            }

            $route5=  route($route, array_merge($param, ['page'=>($current_page)]));

            $html .= '<li class="active page-item"><a class="page-link"
                    href="' . $route5 . '">' . $current_page . '</a></li>';

            if ($current_page + 1 < ceil($total_records / $per_page) + 1) {
            
                $route6=route($route, array_merge($param, ['page'=>($current_page+1)]));

                $html .= '<li class="page page-item"><a class="page-link"
                        href="' . $route6 .'">' . ($current_page + 1) . '</a></li>';
            }
            if ($current_page + 2 < ceil($total_records / $per_page) + 1) {

                $route7=route($route, array_merge($param, ['page'=>($current_page+2)]));

                $html .= '<li class="page page-item"><a class="page-link"
                        href="' . $route7 . '">' . ($current_page + 2) . '</a></li>';
            }

            if ($current_page < ceil($total_records / $per_page) - 2) {

                $route8=route($route, array_merge($param, ['page'=>ceil($total_records / $per_page)]));

                $html .= '<li class="dots">........</li>
                <li class="end page-item"><a class="page-link"
                        href="' . $route8 .'">' . (ceil($total_records / $per_page)) . '</a>
                </li>';
            }

            if ($current_page < ceil($total_records / $per_page)) {

                $route9=route($route, array_merge($param, ['page'=>($current_page + 1)]));
                
                $html .= '<li class="next page-item"><a class="page-link"
                        href="' . $route9 .'">Next</a></li>';
            }
            $html .= '</ul>';
        }
        return $html;
    }

    public static function CheckPermission($PageAccess, $PageAction)
    {
        $api_token = self::getCurrentuserToken();

        $userdata = Cache::get('userdata-' . $api_token);

        if (!empty($userdata->permission)) {
            $permissionList = (array)$userdata->permission;
          //  dd($permissionList);
        }
        if (!empty($userdata->ModuleSectionList)) {
            $ModuleSectionList = (array)$userdata->ModuleSectionList;
            //  dd($ModuleSectionList);
        }

        if ($userdata->role == "super_admin") return 'true';

        if ($PageAccess == '') return 'false';

        // get section_id using section_name( user, ) static
        $pageId = $element = "";

        foreach ($ModuleSectionList as $key => $data) {

            $element = $ModuleSectionList[$key];
            if ($element == $PageAccess) $pageId = $key;
        }

        // get permission_id using permission_namev static
        $permissionArr = [
            "print",
            "add",
            "view",
            "update",
            "remove",
            "export",
           
        ];

        //  dd( $permissionArr);
        $actionId = "";
        foreach ($permissionArr as $key =>  $data) {
            $element  = $permissionArr[$key];
            if ($element == $PageAction) $actionId = $key;
        }

       
        if (!isset($permissionList[$pageId])){
            return 'false'; //check if section_id exist in permission array
        }else if (!isset($permissionList[$pageId]->$actionId) ){
            return 'false'; //check if section_id and permission_id exist in permission array
        }

        //dd($actionId);
        // dd($permissionList[$pageId]->$actionId);
        if ($permissionList[$pageId]->$actionId != "none") {
            return 'true';
        }
          return '';
      
        

    }



    public static function CheckMenushow($sectionId)
    {
        $api_token = self::getCurrentuserToken();
        $userdata =  Cache::get('userdata-' . $api_token);
        if (!empty($userdata->permission)) {
            $permissionList = (array)$userdata->permission;
          //  dd($permissionList);
        }

        if ($userdata->role == "super_admin") {
            return 'true';
        } else if (!isset($permissionList[$sectionId])){
            return 'false'; //check if section_id exist in permission array
        } else{
            return 'true';
        }

        return 'false';

    }


    public static function numberToWords($number) {
        $words = ["", "One", "Two", "Three", "Four", "Five", "Six", "Seven", "Eight", "Nine"];
        $teens = ["", "Eleven", "Twelve", "Thirteen", "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eighteen", "Nineteen"];
        $tens = ["", "Ten", "Twenty", "Thirty", "Forty", "Fifty", "Sixty", "Seventy", "Eighty", "Ninety"];
        $thousands = ["", "Thousand", "Million", "Billion"];
    
        $wordsArray = [];
        $num = round($number);
    
        if ($num == 0) {
            return "Zero";
        }
    
        $i = 0;
    
        while ($num > 0) {
            $chunk = $num % 1000;
            if ($chunk != 0) {
                $chunkWords = [];
    
                if ($chunk >= 100) {
                    $chunkWords[] = $words[(int)($chunk / 100)] . " Hundred";
                    $chunk %= 100;
                }
    
                if ($chunk >= 11 && $chunk <= 19) {
                    $chunkWords[] = $teens[$chunk - 10];
                } else {
                    if ($chunk >= 20) {
                        $chunkWords[] = $tens[(int)($chunk / 10)];
                        $chunk %= 10;
                    }
    
                    if ($chunk > 0) {
                        $chunkWords[] = $words[$chunk];
                    }
                }
    
                $chunkWords = implode(" ", $chunkWords);
                $wordsArray[] = $chunkWords . " " . $thousands[$i];
            }
    
            $i++;
            $num = (int)($num / 1000);
        }
    
        $wordsArray = array_reverse($wordsArray);
        return implode(" ", $wordsArray);
    }

    // public static function amountToWords($amount) {
    //     $fmt = new NumberFormatter('en_US', NumberFormatter::SPELLOUT);
    //     $formattedAmount = $fmt->format($amount);
    
    //     return ucfirst($formattedAmount);
    // }



}