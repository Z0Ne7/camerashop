<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();
use App\Customer;
use App\Order;
use App\OrderDetails;
use App\City;
use App\Province;
use App\Ward;
use App\Shipping;

class AdminController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }
        else{
            return Redirect::to('admin')->send();
        }

    }
    public function index(){
        if(Session::get('admin_id')){
            return Redirect::to('dashboard');
        }else{
            return view('pages.login.admin_login');
        }
    }
    public function show_dashboard(){
        $this ->AuthLogin();
        $user = Customer::orderby('customer_id','desc')->get();
        $order = Order::orderby('created_at','desc')->get();
        $success_order = Order::where('order_status',4)->get();
        $count_user = $user->count();
        $count_order = $success_order->count();
        $order_details = OrderDetails::orderby('order_details_id','desc')->get();
        $total=0;
        foreach($success_order as $success){
            foreach($order_details as $details){
                if($details->order_code==$success->order_code){
                    $subtotal = $details->product_price * $details->product_sale_quantity;
                    $total +=$subtotal;
                }
            }
        }
    	return view('admin.dashboard')->with(compact('count_user','count_order','order_details','total','order'));
    }
    public function dashboard(Request $request){
    	$admin_email = $request -> admin_email;
    	$admin_password = md5($request -> admin_password);

    	$result = DB::table('tbl_admin')->where('admin_email',$admin_email)->where('admin_password',$admin_password)->first();
    	if($result){
    		Session::put('admin_name',$result->admin_name);
    		Session::put('admin_id',$result->admin_id);
    		return Redirect::to('/dashboard');

    	}else{
    		Session::put('message','Sai tài khoản hoặc mật khẩu!');
    		return Redirect::to('/admin');
    	}
    	
    }
    public function all_user(){
        $this ->AuthLogin();
        $customer = Customer::orderby('customer_id','asc')->get();
        $address = Shipping::all();
        $city = City::all();
        $province = Province::all();
        $ward = Ward::all();
        return view('admin.user.manage_user')->with(compact('customer','address','city','province','ward'));
    }
    public function logout(){
        $this ->AuthLogin();
    	Session::put('admin_name',null);
    	Session::put('admin_id',null);
    	return Redirect::to('/admin');
    }
}
