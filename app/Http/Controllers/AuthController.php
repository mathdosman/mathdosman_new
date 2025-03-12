<?php

namespace App\Http\Controllers;

use App\UserStatus;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use App\Helpers\CMail;

class AuthController extends Controller
{
    public function loginForm(Request $request)
    {
        $data =[
            'pageTitle'=> 'Login'
        ];
        return view('back.pages.auth.login', $data);
    }

    public function forgotForm(Request $request){
        $data=[
            'pageTitle'=>'Forgot Password'
        ];
        return view('back.pages.auth.forgot',$data);
    }

    public function loginHandler(Request $request){

        $fieldType = filter_var($request->login_id, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        if($fieldType == 'email'){
            $request->validate([
                'login_id' => 'required|email|exists:users,email',
                'password' => 'required|min:5'
            ],[
                'login_id.required' => 'Enter your email or username',
                'login_id.email' => 'Invalid email address',
                'login_id.exists' => 'No account found for this email'
            ]);
        }else{
            $request->validate([
                'login_id'=>'required|exists:users,username',
                'password'=>'required|min:5'
            ],[
                'login_id.required'=>'Enter your username or email',
                'login_id.exists' => 'No account found for this username'
            ]);
        }

        $creds = array(
            $fieldType=> $request->login_id,
            'password'=>$request->password
        );

        if(Auth::attempt($creds)){
                //Check inactive account
                if(auth()->user()->status == UserStatus::Inactive){
                    Auth::logout();
                    $request->session()->invalidate();
                    $request->session()->regenerateToken();
                    return redirect()->route('adminlogin')->with('fail','Your account is currently INACTIVE. Please, contact support at (mathdosman@gmail.com) for further assistance');
                }
                if(auth()->user()->status == UserStatus::Pending){
                    Auth::logout();
                    $request->session()->invalidate();
                    $request->session()->regenerateToken();
                    return redirect()->route('adminlogin')->with('fail','Your account is currently PENDING approval. Please, check your email for further instructions or contact support at (mathdosman@gmail.com) assistance');
                }

                return redirect()->route('admindashboard');

        }else{
            return redirect()->route('adminlogin')->withInput()->with('fail','Incorrect password.');
        }
    } //END METHOD

    public function sendPasswordResetLink(Request $request)
    {
        $request->validate([
            'email'=>'required|email|exists:users,email'
        ],[
            'email.required'=>'The :attribute is required',
            'email.email' => 'Invalid email address',
            'email.exists' =>'We can not find a user with this email address'
        ]);

        //Get User Datail
        $user = User::where('email',$request->email)->first();

        //Generate Token
        $token = base64_encode(Str::random(64));

        //Check if there is an existing token
        $oldToken = DB::table('password_reset_tokens')
                    ->where('email',$user->email)
                    ->first();

        if($oldToken){
            DB::table('password_reset_tokens')
            ->where('email',$user->email)
            ->update([
                'token'=>$token,
                'created_at'=>Carbon::now()
            ]);
        }else{
            DB::table('password_reset_tokens')->insert([
                'email'=>$user->email,
                'token'=>$token,
                'created_at'=>Carbon::now()
            ]);
        }
        //CREATE CLICKABLE ACTION
        $actionLink = route('adminreset_password_form',['token'=>$token]);

        $data = array(
            'actionLink'=>$actionLink,
            'user'=>$user
        );

        $mail_body = view('email-templates.forgot-template',$data)->render();

        $mailConfig = array(
            'recipient_address'=>$user->email,
            'recipient_name'=>$user->name,
            'subject'=> 'Reset Password',
            'body'=>$mail_body
        );

        if(CMail::send($mailConfig)){
            return redirect()->route('adminforgot')->with('success','We have e-mailed your password reset link.');
        }else{
            return redirect()->route('adminforgot')->with('fail','Something went wrong. Reseting password link not sent. Try again later.');
        }
    }

    public function resetForm(Request $request, $token)
    {
        //Check if this token is exist
        $isTokenExist = DB::table('password_reset_tokens')
                ->where('token',$token)
                ->first();

        if(!$isTokenExist){
            return redirect()->route('adminforgot')->with('fail','Invalid token. Request another reset password link.');
        }else{
            //Check token
            $diffMins = Carbon::createFromFormat('Y-m-d H:i:s', $isTokenExist->created_at)
            ->diffInMinutes(Carbon::now());
            if($diffMins > 15){
                return redirect()->route('adminforgot')->with('fail','The password reset link you clicked has expired. Please request a new link.');
            }
            $data=[
                'pageTitle'=>'Reset Password',
                'token'=>$token
            ];

            return view('back.pages.auth.reset',$data);
        }
    }

    public function resetPasswordHandler(Request $request)
    {
        $request->validate([
            'new_password'=>'required|min:5|required_with:new_password_confirmation|same:new_password_confirmation',
            'new_password_confirmation'=>'required'
        ]);

        $dbToken = DB::table('password_reset_tokens')
        ->where('token',$request->token)->first();

        $user = User::where('email', $dbToken->email)->first();

        User::where('email',$user->email)->update([
            'password'=>Hash::make($request->new_password)
        ]);

        //Send Email
        $data = array(
            'user'=>$user,
            'new_password'=>$request->new_password
        );

        $mail_body = view('email-templates.password-changes-template',$data)->render();

        $mailConfig = array(
            'recipient_address'=>$user->email,
            'recipient_name'=>$user->name,
            'subject'=>'Password Changed',
            'body'=> $mail_body
        );

        if(CMail::send($mailConfig)){
            DB::table('password_reset_tokens')->where([
                'email'=>$dbToken->email,
                'token'=>$dbToken->token
            ])->delete();
            return redirect()->route('adminlogin')->with('success','Done! Your password has been changed successfully. Use your new password for login into system.');
        }else{
            return redirect()->route('adminreset_password_form',['token'=>$dbToken->token])->with('fail','Something went wrong. Try again later.');
        }
    }
}