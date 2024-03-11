<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\{SiteSetting,UserDetail};
use Auth;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
   // protected $redirectTo = '/user/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            // 'user_name' => ['required', 'string', 'min:8', 'max:10', 'unique:users'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'regex:/^([0-9\s\-\+\(\)]*)$/', 'min:10', 'max:13'],
            'state' => ['required', 'string'],
            'country' => ['required', 'string'],
            'city' => ['required', 'string'],
            'zip' => ['required', 'string','min:5'],
            'address' => ['required', 'string'],
            // 'alt_address' => ['string'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $unique_id = random_int(100000, 999999);
        $parts = explode('@', $data['email']);

        if (count($parts) == 2) {
            $textBeforeAt = $parts[0];
        }
if(isset($data['user_name'])){
    $textBeforeAt =  html_entity_decode($data['user_name']);

}
        $user = User::create([
            'unique_id' => $unique_id,
            'user_name' =>$textBeforeAt,
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'state' => $data['state'],
            'country' => $data['country'],
            'city' => $data['city'],
            'zip' => $data['zip'],
            'role' => $data['role'],
            'address' => $data['address'],
            'alt_address' => $data['alt_address'],
            'is_consultant' =>  $data['role'] ==3 ?1:0,
            'password' => Hash::make($data['password']),
        ]);

        $accnt_num = random_int(100, 999).$user->id;

        User::where('id' , $user->id)->update([
        'accnt_num' => $accnt_num ?? null
        ]);

        $setting=SiteSetting::find(1);
        $detail=new UserDetail;
        $detail->user_id=$user->id;
        $detail->commission=$setting->overall_comission;
        $detail->save();

        return $user;
    }
    protected $redirectTo;
    public function redirectTo()
    {

        // Your custom logic to determine the redirection URL
        if (Auth::user()->role!=0) {
            return route('kits');
        } else {
            return route('home');
        }
        // switch(Auth::user()->role){
        //     case 1:
        //         $this->redirectTo = '/admin/dashboard';
        //         return $this->redirectTo;
        //         break;
        //     case 2:
        //         $this->redirectTo = '/user/dashboard';
        //         return $this->redirectTo;
        //         break;
        //     default:
        //         $this->redirectTo = '/login';
        //         return $this->redirectTo;
        // }

        // return $next($request);
    }
}
