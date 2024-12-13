<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Exception;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected $providers = [
        'google','facebook','github','twitter'
    ];
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required', 'email',
            'password' => 'required',
            ]);
            if(auth()->attempt(array('email' =>$request->email, 'password'=>$request->password))){
                if(auth()->user()->is_admin == 1){
                    return redirect()->route('admin.home');
                }else{
                    // return redirect()->route('home');
                    return redirect()->back();
                }
            }else{
                // return redirect()->back()->with('error','invalid email or password');

                $notification = array('message' => 'invalid email or password', 'alert-type' => 'error');
                return redirect()->back()->with($notification);
            }
    }

    //__admin login__//
    public function admin_login()  {
        return view('auth.admin_login');
    }

    //__socialite login__//
    public function redirectToProvider($provider)
    {
        if(!$this->isProviderAllowed($provider)){
            return $this->sendFailedResponse("{$provider} is not allowed");
        }
        try{
            return Socialite::driver($provider)->redirect();
        }catch(Exception $e){
            return $this->sendFailedResponse($e->getMessage());
        }
    }
    public function handleProviderCallback($provider)
    {
        try{
            $user = Socialite::driver($provider)->user();
        }catch(Exception $e){
            return $this->sendFailedResponse($e->getMessage());
        }
        return empty($user->email)
        ? $this->sendFailedResponse("No email id returned from {$provider} provider")
        : $this->loginOrCreateAccount($user, $provider);

    }
    protected function sendSuccessResponse(){
        return redirect()->intended('home');
    }

    protected function sendFailedResponse($msg = null) {
        return redirect()->route('login')->withErrors(['msg' => $msg ?: 'Unable to login, try with another provider to login.']);
    }
    protected function loginOrCreateAccount($provideUser, $provider){
        $user = User::where('email', $provideUser->getEmail())->first();
        if($user){
            $user->update([
                'avatar' => $provideUser->avatar,
                'provider' => $provider,
                'provider_id' => $provideUser->id,
                'access_token' => $provideUser->token,
            ]);
        } else {
            $user = User::create([
                'name' => $provideUser->getName(),
                'email' => $provideUser->getEmail(),
                'avatar' => $provideUser->getAvatar(),
                'provider' => $provider,
                'provider_id' => $provideUser->getId(),
                'access_token' => $provideUser->token,
                'password' => '',
            ]);
        }
        Auth::login($user, true);
        return $this->sendSuccessResponse();
    }

    private function isProviderAllowed($provider){
        return in_array($provider, $this->providers) && config()->has("services.{$provider}");
    }
}
