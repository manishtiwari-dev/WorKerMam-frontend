<?php
namespace App\Http\Controllers\Auth;

use App\Helper\Helper;
use App\Http\Controllers\Controller;
use App\Models\Subscription;
use App\Models\User;
use App\Models\UserBusiness;
use App\Providers\RouteServiceProvider;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Session;
use App\Events\GlobalEventBetweenSuperAdminAndAdmin;

class LoginController extends Controller
{

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {

        $input = $request->all();

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',

        ]);

        if ($request->has('email') && $request->has('password')) {

            Helper::essential_config_regenerate('');
            GlobalEventBetweenSuperAdminAndAdmin::dispatch('working');

            $userBus = UserBusiness::where('users_email', $request->email)->first();

            session()->put('utype', '2'); //"subscriber";

            if ($userBus == null) {
                return redirect()->route('login')
                    ->with('error', 'Email-Address And Password Are Wrong.');
            } else {
                $db_id = $userBus->subscription->db_suffix;
                session()->put('db_id', $db_id);
                Helper::essential_config_regenerate();
                Helper::DBConnect();
                $request->session()->save();
            }

            $res = User::where('email', $request->email)->first();

            /* passowrd match */
            if (Hash::check($request->password, $res->password)) {

                $subscription_id = $userBus->subscription->subscription_id;
                session()->put('subs_id', $subscription_id);
                $request->session()->save();

                // $ind=Helper::get_industry_id($subscription_id);
             

                $subs = Subscription::where('subscription_id', $userBus->subscription_id)->first();

                if (!empty($subs)) {
                    if ($subs->account_type == 2 && $subs->status != 1) {
                        if ($subs->status == 0) {

                            return redirect()->route('login')
                                ->with('error', 'Subscription Status Inactive.');

                        } else if ($subs->status == 2) {
                            $today_date = date_create(date("Y-m-d"));

                            // $today_date = Carbon::now();

                            //  $expiry_date = $subs->expired_at;

                            $expiry_date = date_create("2022-09-30");
                            $day_diff = date_diff($today_date, $expiry_date);
                            if ($day_diff->format("%a") > 3) {

                                return redirect()->route('login')
                                    ->with('error', 'Subscription Status Expired.');

                            }

                        }
                        $account_status = 0;
                    }

                    $industry_id = $subs->industry_id;
                } else {
                    $industry_id = 0;
                }

                if (auth()->attempt(array('email' => $request->email, 'password' => $request->password))) {
                    if (auth()->user()) {

                        return redirect()->route('dashboard');
                    }
                } else {
                    return redirect()->route('login')
                        ->with('error', 'Email-Address And Password Are Wrong.');
                }

            }

        }

    }

    public function superlanding()
    {
        return view('auth.superlogin');
    }

    public function superlogin(Request $request)
    {

        $input = $request->all();

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',

        ]);

        $db_id = 0;
        session()->put('utype', '1'); //administrator
        session()->put('db_id', $db_id);
        Helper::essential_config_regenerate();

        if ($request->has('email') && $request->has('password')) {

            $res = User::where('email', $request->email)->first();

            if ($res != null) {

                // /* check account active or not */
                if ($res->status == 0) {
                    return redirect()->route('superlogin')->with('error', 'Inactive user');
                }

                /* passowrd match */
                if (Hash::check($request->password, $res->password)) {

                    if (auth()->attempt(array('email' => $request->email, 'password' => $request->password))) {
                        if (auth()->user()) {
                            return redirect()->route('dashboard');
                        }
                    } else {
                        return redirect()->route('login')
                            ->with('error', 'Email-Address And Password Are Wrong.');
                    }

                } else {
                    return redirect()->route('superlogin')->with('error', 'Email-Address And Password Are Wrong.');
                }

            }
        }

    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/login');
    }
}
