<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Url;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Networks;
use Carbon\Carbon;
use Mail;


class UserController extends Controller
{
    public function registerUser(){
        return view('register');
    }

    public function registered(Request $request ){
        /* print_r($request);
        die(); */
        //print_r($_POST);die();
        $request->validate([
            'name'=>'required|string',
            'email'=>'required|string|email|unique:users',
            'password'=>'required|min:6|confirmed',
        ]);

         $reference_code = Str::random(10);
         $token = Str::random(20);
        //die();
       // echo '<pre>'; print_r($request->reference_code);die();
        if(isset($request->reference_code)){
            $userData = User::where('reference_code', $request->reference_code)->get();
            //print_r($userData);die();
            if(count($userData) > 0){
                $userId = User::insertGetId([
                    'name'=> $request->name,      
                    'email'=> $request->email,      
                    'password'=> Hash::make($request->password),   
                    'reference_code'=> $reference_code,
                    'remember_token'=>$token
                ]);

                Networks::insert([
                    'reference_code' =>$request->reference_code,
                    'user_id' =>$userId,
                    'parent_user_id' =>$userData[0]['id'],
                ]);
            }else{
                return back()->with('error', 'Reference code is not valid');
            }

        }else{
            User::insert([
                'name'=> $request->name,      
                'email'=> $request->email,      
                'password'=> Hash::make($request->password),   
                'reference_code'=> $reference_code,
                'remember_token'=>$token
            ]);
        }

        $domain = URL::to('/');
        $url = $domain.'/reference-register?ref='.$reference_code;
        $data['url'] = $url;
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['password'] = $request->password;
        $data['title'] = 'Registered';

        Mail::send('emails.registerMail', ['data' => $data], function($message) use($data){
            $message->to($data['email'])->subject($data['title']);
        });

        //send varication email.

        $url = $domain. '/email-verification/'.$token;
        $data['url'] = $url;
        $data['title'] = 'Email Verification';

        Mail::send('emails.verifyEmail', ['data' => $data], function($message) use($data){
            $message->to($data['email'])->subject($data['title']);
        });


        return back()->with('success', 'User registered successfully. Please verify your email');
    }

    public function referenceRegistered(Request $request){
        if(isset($request->ref)){
             $reference  = $request->ref;
             $userData = User::where('reference_code', $reference)->get();
             if(count($userData) > 0){
                return view('referenceRegistered', compact('reference'));
             }else{
                return view('404');
             }  
        }else{
            return redirect('/');
        }
    }

    public function emailVerification($token){
       $userData =  User::where('remember_token', $token)->get();
       if(count($userData) > 0){
            if($userData[0]['is_verified'] == 1){
                return view('verified',['message'=>'Email is already verified']);
            }

            User::where('id', $userData[0]['id'])->update([
                'is_verified' => 1,
                'email_verified_at'=> date('Y-m-d H:i:s'),
            ]);

            return view('verified',['message'=>'Your Email'.$userData[0]['email']. ' was verified Successfully']);

       }else{
            return view('verified',['message'=>'404. Page not found!!']);
       }

    }

    public function loadLogin(){
        return view('login');
    }

    public function loginUser(Request $request){
        $request->validate([
            'email'=>'required|string|email',
            'password'=>'required'
        ]);

        $userData = User::where('email', $request->email)->first();

        if(!empty($userData)){
            if($userData->is_verified == 0){
                return back()->with('error', 'Please verify your email address');
            }
            $userCred = $request->only('email','password');
            if(Auth::attempt($userCred)){
                if(Auth::user()->role_as == '1'){
                    return redirect('/admin/dashboard');
                }else{
                    return redirect('/dashboard');
                }
                
            }else{
                return back()->with('error','email and Password is invalid');
            }
        }
    }

    public function loadDashboard(){
        $networkCount =  Networks::where('parent_user_id', Auth::user()->id)->orWhere('user_id', Auth::user()->id)->count();
        $networkData =  Networks::with('user')->where('parent_user_id', Auth::user()->id)->get();
        return view('dashboard',compact(['networkCount','networkData']));
    }

    public function logout(Request $request){
        Session::flush();
        Auth::logout();
        return redirect('/'); 
    }
}
