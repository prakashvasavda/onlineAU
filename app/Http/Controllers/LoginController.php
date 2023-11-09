<?php

namespace App\Http\Controllers;

use App\FrontUser;
use App\Mail\CustomForgotPasswordMail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Controllers\User\SubscriptionController;
use Session;
use Mail;

class LoginController extends Controller
{

    public function index()
    {
        if (session()->has('frontUser')) {
            return redirect()->route('home');
        }
        return view('user.login');
    }

    public function check_login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = FrontUser::where('email', $request->email)->first();
        if ($user && Hash::check($request->password, $user->password)) {
 
            /*check user subscription status*/
            $subscription                       = new SubscriptionController();
            $subscription_status                = $user->role == "family" ? $subscription->check_subscription_status($user->id) : null;
            $user['user_subscription_status']   = $subscription_status;

            Session::put('frontUser', $user);
            return redirect()->route('home');
        } else {
            return back()->withErrors(['email' => 'Invalid credentials']);
        }
    }

    public function forgot_password()
    {
        return view('user.forgot');
    }

    public function check_user(Request $request)
    {
        $valid = FrontUser::where('email',$request->email)->first();
        if(isset($valid) && !empty($valid)) {
            $emailTo = $request->email;
            $name = $valid['name'];

            config(['mail.mailers.smtp.host' => 'smtp.gmail.com']);
            config(['mail.mailers.smtp.port' => '587']);
            config(['mail.mailers.smtp.username' => 'prakash.v.php@gmail.com']);
            config(['mail.mailers.smtp.password' => 'rqjmelerlcsuycnp']);
            config(['mail.mailers.smtp.encryption' => 'tls']);
            $url = url('reset-password/'.base64_encode($emailTo));
            $message = '<p>Hello '.$valid["name"].',</p>
            <p>You are receiving this email because we received a password reset request for your account.</p>
            <p>Click the following link to reset your password:</p>
            <a href="'.$url.'">Reset Password</a>
            <p>If you did not request a password reset, no further action is required.</p>';
            Mail::send([], [], function ($mail) use ($message, $emailTo, $name) {
                $mail->to($emailTo, $name)->subject('Password Reset Request')->setBody($message, 'text/html');
                $mail->from('info@onlineaupair.Co.Za', 'Onlineaupair');
            });
            return redirect()->back()->with('success', 'Forgot password mail send successfully.');
        } else {
            return back()->withErrors(['email' => 'Email not match.']);
        }
    }

    public function reset_password($email)
    {
        $userEmail = base64_decode($email);
        return view('user.reset_password',compact('userEmail'));
    }

    public function create_new_password(Request $request)
    {
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
