<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();
use App\City;
use App\Province;
use App\Ward;
use App\Shippingfee;

use App\Order;
use App\OrderDetails;
use App\Shipping;
class CheckoutController extends Controller
{
    public function login_checkout(){
        if(Session::get('customer_id')){
            return Redirect::to('/');
        }else{
            return view('pages.login.login_checkout');
        }
        
    }
    public function user_login_checkout(Request $request){
        $email = $request->email_account;
        $password = md5($request->password_account);
        $result = DB::table('tbl_customer')->where('customer_email',$email)->where('customer_password',$password)->first();
        if($result){
            Session::put('customer_id',$result->customer_id);
            return Redirect::to('/shipping');
        }else{
            Session::put('message','Sai tài khoản hoặc mật khẩu!');
            return Redirect::to('/login-checkout');
        }
    }
    public function signup_checkout(){
        if(Session::get('customer_id')){
            return Redirect::to('/');
        }else{
            return view('pages.login.signup_checkout');
        }
    }
    public function create_account_checkout(Request $request){
    	$data = array();
    	$data['customer_name'] = $request->customer_name;
    	$data['customer_phone'] = $request->customer_phone;
    	$data['customer_email'] = $request->customer_email;
    	$data['customer_password'] = md5($request->customer_password);

    	$customerId = DB::table('tbl_customer')->insertGetId($data);

    	Session::put('customer_id',$customerId);
    	Session::put('customer_name',$request->customer_name);
    	return Redirect::to('/shipping');

    }
    public function logout_checkout(){
        $tmpName = Session::get('admin_name');
        $tmpId = Session::get('admin_id');
        Session::flush();
        Session::put('admin_name',$tmpName);
        Session::put('admin_id',$tmpId);
        // return redirect()->back();
        return Redirect::to('/');
    }
    
    public function select_location_checkout(Request $request){
        $data = $request->all();
        if($data['action']){
            $output='';
            if($data['action']=='city'){
                $select_province = Province::where('idCity',$data['ma_id'])->orderby('idProvince','asc')->get();
                $output.='<option>Chọn Quận/Huyện</option>';
                foreach($select_province as $key => $province){
                $output.='<option value="'.$province->idProvince.'">'.$province->nameProvince.'</option>';
                }
            }else{
                $select_ward = Ward::where('idProvince',$data['ma_id'])->orderby('idWard','asc')->get();
                $output.='<option>Chọn Phường/Xã</option>';
                foreach($select_ward as $key => $ward){
                $output.='<option value="'.$ward->idWard.'">'.$ward->nameWard.'</option>';
                }
            }
        }
        echo $output;
    }
    public function cal_fee(Request $request){
        $data = $request->all();
        Session::put('data',$data);
        
        if($data['matinh']){
            $feeship = Shippingfee::where('fee_idCity',$data['matinh'])->where('fee_idProvince',$data['mahuyen'])->where('fee_idWard',$data['maxa'])->get();
            if($feeship){
                $count_feeship = $feeship->count();
                if($count_feeship>0){
                    foreach($feeship as $key => $fee){
                    Session::put('fee',$fee->fee_value);
                    Session::save();
                    }
                }else{
                    Session::put('fee',100000);
                    Session::save();
                }
            }
            
        }
    }
    public function confirm_order(Request $request){
        $data = $request->all();
        $checkout_code = substr(md5(microtime()),rand(0,26),8);

        $order = new Order;

        $order->order_payment = $data['shipping_payment'];
        $order->order_shipping_name = $data['shipping_name'];
        $order->order_shipping_phone = $data['shipping_phone'];
        $order->order_shipping_address = $data['shipping_address'];
        $order->order_idCity = $data['ma_tinh'];
        $order->order_idProvince = $data['ma_huyen'];
        $order->order_idWard = $data['ma_xa'];
        $order->order_couponcode = $data['order_coupon'];
        $order->order_shippingfee = $data['order_fee'];
        $order->customer_id = Session::get('customer_id');
        $order->order_status = 1;
        $order->order_code = $checkout_code;
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $order->created_at = now();
        $order->save();

        
        if(Session::get('cart')){
            foreach(Session::get('cart') as $key => $cart){
                $order_details = new OrderDetails;
                $order_details->order_code = $checkout_code;
                $order_details->product_id = $cart['product_id'];
                $order_details->product_name = $cart['product_name'];
                $order_details->product_price = $cart['product_price'];
                $order_details->product_sale_quantity = $cart['product_qty'];
                $order_details->save();
            }
        }
        Session::forget('coupon');
        Session::forget('fee');
        Session::forget('cart');
        Session::forget('data');
    }
    public function shipping(){
        if(Session::get('cart')){
            if(Session::get('customer_id')){
                $customer = Session::get('customer_id');
                $get_shipping = Shipping::where('customer_id',$customer)->get();
                $count = $get_shipping->count();
                if($count>0){
                    $shipping = Shipping::where('customer_id',$customer)->first();
                    $city = City::orderby('idCity','asc')->get();
                    $province = Province::orderby('idProvince','asc')->get();
                    $ward = Ward::orderby('idWard','asc')->get();
                    return view('pages.checkout.select_location')->with(compact('city','province','ward','customer','shipping'));
                }else{
                    return Redirect::to('/address');
                }
            }else{
                return view('pages.login.login_checkout');
            }
        }else{
            return Redirect::to('/');
        }
    }
    public function review_order(){
        if(Session::get('cart')){
            if(Session::get('customer_id')){
                if(Session::get('fee')){
                    $data = Session::get('data');
                    $matinh = $data['matinh'];
                    $mahuyen = $data['mahuyen'];
                    $maxa = $data['maxa'];
                    $city = City::where('idCity',$matinh)->first();
                    $province = Province::where('idProvince',$mahuyen)->first();
                    $ward = Ward::where('idWard',$maxa)->first();
                    return view('pages.checkout.shipping_info')->with(compact('city','province','ward','matinh','mahuyen','maxa','data'));
                }else{
                    return Redirect::to('/');
                }
            }else{
                return view('pages.login.login_checkout');
            }
        }else{
            return Redirect::to('/');
        }
    }
}
