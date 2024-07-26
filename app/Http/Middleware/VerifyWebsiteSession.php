<?php
namespace App\Http\Middleware;
use App\Helper\Helper;
use Session;

use Closure;

class VerifyWebsiteSession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if (Session::has('api_token') || $request->has('token')) :
            Helper::essential_config_regenerate();
            Helper::DBConnect();

        else :
            return redirect('https://app.e-nnovation.net');
        endif;
        
        return $next($request);
    }


}