<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;
use App\Customer;
session_start();

class LoginController extends Controller
{
    public function login(){
    	if(Session::get('customer_id')){
    		return Redirect::to('/');
    	}else{
    		return view('pages.login.login');
    	}
        
    }
    public function user_login(Request $request){
        $email = $request->email_account;
        $password = md5($request->password_account);
        $result = DB::table('tbl_customer')->where('customer_email',$email)->where('customer_password',$password)->first();
        if($result){
            Session::put('customer_id',$result->customer_id);
            return Redirect::to('/');
        }else{
            return redirect()->back()->with('errmsg','Sai tài khoản hoặc mật khẩu');
        }
    }

    public function signup(){
    	if(Session::get('customer_id')){
    		return Redirect::to('/');
    	}else{
    		return view('pages.login.signup');
    	}
    }
    public function create_account(Request $request){
        $customer = Customer::get('customer_email');
    	$data = array();
    	$data['customer_name'] = $request->customer_name;
    	$data['customer_phone'] = $request->customer_phone;
    	$data['customer_email'] = $request->customer_email;
    	$data['customer_password'] = md5($request->customer_password);
        $count = $customer->where('customer_email',$data['customer_email'])->count();
        if($count>0){
            return redirect()->back()->with('errmsg','Tài khoản đã tồn tại');
        }else{
        	$customerId = DB::table('tbl_customer')->insertGetId($data);
        	Session::put('customer_id',$customerId);
        	Session::put('customer_name',$request->customer_name);
        	return Redirect::to('/');
        }
    }
}
