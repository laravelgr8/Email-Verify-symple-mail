<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use \Mail;
use \Session;
class UserController extends Controller
{
    function index()
    {
        
        return view('login');
    }

    function signup(Request $request)
    {
        $validate=$request->validate([
            "name"=>"required",
            "email"=>"required",
            "password"=>"required",
            "mobile"=>"required",
            "gender"=>"required",
            "qualification"=>"required"
        ]);
        if($request->hasfile('pic'))
        {
            $file=$request->file('pic');
            $extension=$file->getClientOriginalExtension();
            $filename=time().'.'.$extension;
            $file->move('img/',$filename);
            $pic=$filename;
        }
        $token=Hash::make($request->email);
        $data=DB::table('login')->insert([
            "name"=>$request->name,
            "email"=>$request->email,
            "password"=>$request->password,
            "mobile"=>$request->mobile,
            "gender"=>$request->gender,
            "qualification"=>implode(",",$request->qualification),
            "pic"=>$pic,
            "token"=>$token
        ]);
        $url=url('/emailVerify/?code='.$token);
        $dat=["name"=>$request->name,"url"=>$url];
        $user['to']='suman.krgr8@gmail.com';
        Mail::send('mail',$dat,function($msg) use ($user){
            $msg->to($user['to']);
            $msg->subject('For Verification');
        });

        return redirect()->route('user.index')->with('regMsg','User Create Success');

    }


    function emailVerify()
    {
        $token=$_REQUEST["code"];
        $data=DB::table('login')->where('token',$token)->update([
            "emailverify"=>1
        ]);
        return redirect()->route('user.index')->with('regMsg','Please Login');
    }

    function login(Request $request)
    {
        $email=$request->email;
        $password=$request->password;
        $data=DB::table('login')->where(["email"=>$email,"password"=>$password])->select('emailverify','email','password')->first();
        if(@$data->emailverify==1)
        {
            $request->session()->put('email',$email);
            return redirect()->route('user.profile');
        }
        else
        {   
            if(@$data->email!=$email && @$data->password!=$password) //if not correct email and password
            {
                return redirect()->route('user.index')->with('loginMsg','Please Create ID');
            }
            else
            {
                //if emailverify is 0;
                return redirect()->route('user.index')->with('loginMsg','Please First Email Confirm');
            }              
        }
    }


    function profile()
    {
        return view('profile');
    }

    function logout()
    {
        Session::forget('email');
        return redirect()->route('user.index');
    }

    function about()
    {
        return url('/home');
    }
}
