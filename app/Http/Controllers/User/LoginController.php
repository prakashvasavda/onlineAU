<?php

namespace App\Http\Controllers\User;


use App\Http\Controllers\Controller;
use App\Models\FrontUser;
use App\Mail\CustomForgotPasswordMail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Controllers\User\SubscriptionController;
use Illuminate\Support\Facades\Session;
use Mail;
use App\Mail\ResetPassword;



class LoginController extends Controller{
    
    public function index(){
        if (session()->has('frontUser')) {
            return redirect()->route('home');
        }
        return view('user.login');
    }

    public function check_login(Request $request){
        $request->validate([
            'email'     => 'required|email',
            'password'  => 'required',
        ]);

        $user = FrontUser::where('email', $request->email)->first();

        /* check if the user it authnticated */
        if(!$user || !Hash::check($request->password, $user->password)){
            return back()->withErrors(['email' => 'Invalid credentials']);
        }
        
        /* check if user account is inactive */
        if($user->status != 1){
            return back()->withErrors(['email' => 'your account is inactive']);
        }
            
        /*check for the expired user subscriptions*/
        $subscription                       = new SubscriptionController();
        $update_status                      = $user->role == "family" || $user->role == "family-petsitting" ? $subscription->update_subscription_status($user->id) : null;

        /* get current user subscription status */
        $subscription_status                = $user->role == "family" || $user->role == "family-petsitting" ? $subscription->check_subscription_status($user->id) : null;
        $user['user_subscription_status']   = $subscription_status;

        /*get family paid candidates*/
        if(($user->role == "family" || $user->role == "family-petsitting") && $subscription_status == "active"){
            $purchased_candidates = $this->get_purchased_candidates($user->id);
            $user['purchased_candidates'] = $purchased_candidates;
        }

        /*set user session*/
        Session::put('frontUser', $user);

        return $user->role == "family" || $user->role == "family-petsitting" ? redirect()->route('view-candidates') : redirect()->route('view-families');
    }

    public function forgot_password(){
        return view('user.forgot');
    }

    public function check_user(Request $request){
        $request->validate([            
            'email' => 'required|email',
        ]);

        $valid = FrontUser::where('email',$request->email)->first();
        
        if(!isset($valid) || empty($valid)){
            return back()->withErrors(['email' => 'Email not match.']);
        }

        $data = [
            'url'   => url('reset-password/'.base64_encode($request->email)),
            'name'  => $valid['name'],
        ];

        Mail::to($request->email)->send(new ResetPassword($data));
        return redirect()->back()->with('success', 'Forgot password mail send successfully.');
    }

    public function reset_password($email){
        $userEmail = base64_decode($email);
        return view('user.reset_password',compact('userEmail'));
    }

    public function create_new_password(Request $request){
        $request->validate([            
            'password' => 'required|confirmed|min:8',
        ]);
        if ($request->password != '') {
            FrontUser::where('email',$request->email)->update([
                'password' => Hash::make($request->password),
            ]);
            return back()->with('success', 'Password change Successfully');
        } else {
            return back()->with('errorM', 'Something Wrong');
        }
    }
}
