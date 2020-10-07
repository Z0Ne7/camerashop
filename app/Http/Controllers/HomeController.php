<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;
use App\Order;
use App\OrderDetails;
use App\Coupon;
use App\Customer;
use App\City;
use App\Province;
use App\Ward;
use App\Shipping;
session_start();

class HomeController extends Controller
{
    public function index(){
    	$cate_product = DB::table('tbl_category')->where('category_status','1')->orderby('category_id','asc')->get();
    	$brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','asc')->get();

    	$all_product_joined = DB::table('tbl_product')
    	->join('tbl_category','tbl_category.category_id','=','tbl_product.category_id')
    	->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')->where('product_status','1')->orderby('tbl_product.product_id','desc')->get();

        $lastest_product = DB::table('tbl_product')->where('product_status','1')->orderby('product_id','desc')->get();
    	$lastest = DB::table('tbl_product')->where('product_status','1')->orderby('product_id','desc')->first();
    	return view('pages.home.home')->with('category',$cate_product)->with('brand',$brand_product)
        ->with(compact('all_product_joined','lastest_product','lastest'));
        
    }
    public function search(Request $request){
        $cate_product = DB::table('tbl_category')->where('category_status','1')->orderby('category_id','asc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','asc')->get();
        $keyword = $request->keyword;
        if($keyword==NULL){
            return redirect()->back()->with('errmsg','Chưa nhập từ khóa');
        }else{
        $search_product = DB::table('tbl_product')->where('product_name','like','%'.$keyword.'%')->orWhere('product_price',$keyword)->orWhere('product_content','like','%'.$keyword.'%')->orWhere('product_desc','like','%'.$keyword.'%')->get();
        return view('pages.search.searchresult')
        ->with('category',$cate_product)->with('brand',$brand_product)->with(compact('keyword','search_product'));

    }}
    public function orders(){
        if(Session::get('customer_id')){
            $user_id = Session::get('customer_id');
            $order = Order::where('customer_id',$user_id)->orderby('order_id','desc')->get();
            $count_order = $order->count();
        }else{
            return Redirect::to('/');
        }
        
        return view('pages.orders.all_orders')->with(compact('order','count_order'));
    }
    public function order_details($order_id){
        if(Session::get('customer_id')){
            $order = Order::where('order_code',$order_id)->orderby('order_id','desc')->get();
            foreach($order as $ord){
                $status = $ord->order_status;
                $order_coupon = $ord->order_couponcode;
                $feeship = $ord->order_shippingfee;
                $matinh = $ord->order_idCity;
                $mahuyen = $ord->order_idProvince;
                $maxa = $ord->order_idWard;
                $city = City::where('idCity',$matinh)->first();
                $province = Province::where('idProvince',$mahuyen)->first();
                $ward = Ward::where('idWard',$maxa)->first();
            }
            if($order_coupon!='NULL'){
                $coupon = Coupon::where('coupon_value',$order_coupon)->first();
                $coupon_type = $coupon->coupon_type;
                $coupon_number = $coupon->coupon_number;
                $coupon_value = $coupon->coupon_value;
            }else{
                $coupon_type = 0;
                $coupon_number = 0;
                $coupon_value = 'Không có';
            }
            $order_details = OrderDetails::where('order_code',$order_id)->get();
        }else{
            return Redirect::to('/');
        }
        return view('pages.orders.details_order')->with(compact('order_details','coupon_type','coupon_number','status','coupon_value','order_id','feeship','order','city','province','ward'));
    }
    public function account(){
        if(Session::get('customer_id')){
            $customer = Session::get('customer_id');
            $info = Customer::where('customer_id',$customer)->first();
            return view('pages.account.account_info')->with(compact('info'));
        }else{
            return Redirect::to('/');
        }
    }
    public function update_info(Request $request){
        if(Session::get('customer_id')){
            $data = $request->all();
            $id = $data['id'];
            $name = $data['hoten'];
            $mail = $data['email'];
            $phone = $data['sdt'];
            $customer = Customer::where('customer_id',$id)->first();
            $customer->update(['customer_name'=>$name,'customer_email'=>$mail,'customer_phone'=>$phone]);
            return redirect()->back()->with('message','Đã cập nhật thông tin!');

        }else{
            return Redirect::to('/');
        }
        
    }
    public function change_password(){
        if(Session::get('customer_id')){
            $customer = Session::get('customer_id');
            return view('pages.account.change_password')->with(compact('customer'));
        }else{
            return Redirect::to('/');
        }
        
    }
    public function update_password(Request $request){
        if(Session::get('customer_id')){
            $data = $request->all();
            $id = $data['id'];
            $old_pw = md5($data['old_pw']);
            $new_pw = md5($data['new_pw']);
            $confirm_pw = md5($data['confirm_pw']);
            $customer = Customer::where('customer_id',$id)->first();
            if($old_pw==md5(null) || $new_pw==md5(null) || $confirm_pw==md5(null)){
                return redirect()->back()->with('errmsg','Chưa nhập mật khẩu!');
            }elseif($old_pw!=$customer->customer_password){
                return redirect()->back()->with('errmsg','Sai mật khẩu, mời nhập lại!');
            }elseif($confirm_pw!=$new_pw){
                return redirect()->back()->with('errmsg','Mật khẩu mới không trùng khớp');
            }else{
                $customer->update(['customer_password'=>$confirm_pw]);
            }

            return redirect()->back()->with('message','Đổi mật khẩu thành công!');

        }else{
            return Redirect::to('/');
        }
        
    }
    public function address(){
        if(Session::get('customer_id')){
            $customer = Session::get('customer_id');
            $city = City::orderby('idCity','asc')->get();
            $province = Province::orderby('idProvince','asc')->get();
            $ward = Ward::orderby('idWard','asc')->get();
            $get_shipping = Shipping::where('customer_id',$customer)->get();
            $count = $get_shipping->count();
            if($count>0){
                $shipping = Shipping::where('customer_id',$customer)->first();
                return view('pages.account.update_address')->with(compact('city','province','ward','customer','shipping'));
            }else{
                return view('pages.account.manage_address')->with(compact('city','customer'));
            }
        }else{
            return Redirect::to('/');
        }
        
    }
    public function add_address(Request $request){
        if(Session::get('customer_id')){
            $data = $request->all();
            $id = $data['id'];
            $name = $data['shipping_name'];
            $phone = $data['shipping_phone'];
            $address = $data['shipping_address'];
            $city = $data['city'];
            $province = $data['province'];
            $ward = $data['ward'];
            if($name==NULL || $phone==NULL || $address==NULL || $city==NULL || $province==NULL || $ward==NULL){
                return redirect()->back()->with('errmsg','Chưa nhập đủ thông tin!');
            }else{
                $shipping = new Shipping();
                $shipping->customer_id = $id;
                $shipping->idCity = $city;
                $shipping->idProvince = $province;
                $shipping->idWard = $ward;
                $shipping->shipping_name = $name;
                $shipping->shipping_address = $address;
                $shipping->shipping_phone = $phone;
                $shipping->save();
                return redirect()->back()->with('message','Thêm địa chỉ thành công!');
            }
        }else{
            return Redirect::to('/');
        }
        
    }
    public function update_address(Request $request){
        if(Session::get('customer_id')){
            $data = $request->all();
            $id = $data['id'];
            $name = $data['shipping_name'];
            $phone = $data['shipping_phone'];
            $address = $data['shipping_address'];
            $city = $data['city'];
            $province = $data['province'];
            $ward = $data['ward'];
            if($name==NULL || $phone==NULL || $address==NULL || $city==NULL || $province==NULL || $ward==NULL){
                return redirect()->back()->with('errmsg','Chưa nhập đủ thông tin!');
            }else{
                $shipping = Shipping::where('customer_id',$id)->first();
                $shipping->update(['idCity' => $city, 'idProvince' => $province, 'idWard' => $ward, 'shipping_name' => $name, 'shipping_phone' => $phone, 'shipping_address' => $address]);
                return redirect()->back()->with('message','Cập nhật thông tin thành công!');
            }
        }else{
            return Redirect::to('/');
        }
        
    }
}
