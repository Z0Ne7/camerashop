<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Coupon;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class CouponController extends Controller
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
    public function add_coupon(){
        $this ->AuthLogin();
    	return view('admin.coupon.add_coupon');
    }
    public function add_coupon_code(Request $request){
    	$data = $request->all();
    	$coupon = new Coupon;

    	$coupon->coupon_name= $data['coupon_name'];
    	$coupon->coupon_number= $data['coupon_number'];
    	$coupon->coupon_value= $data['coupon_value'];
    	$coupon->coupon_time= $data['coupon_time'];
    	$coupon->coupon_type= $data['coupon_type'];
    	$coupon->save();

    	Session::put('message','Đã thêm mã giảm giá!');
    	return Redirect::to('add-coupon');
    }
    public function list_coupon(){
        $this ->AuthLogin();
    	$coupon = Coupon::orderby('coupon_id','desc')->get();
    	return view('admin.coupon.list_coupon')->with(compact('coupon'));
    }
    public function edit_coupon($coupon_id){
        $this->AuthLogin();
        $coupon = Coupon::where('coupon_id',$coupon_id)->first();
        return view ('admin.coupon.edit_coupon')->with(compact('coupon'));
    }
    public function update_coupon(Request $request, $coupon_id){
        $data = $request->all();
        $coupon = Coupon::where('coupon_id',$coupon_id)->first();
        $coupon->update(['coupon_name' => $data['coupon_name'], 'coupon_number'=> $data['coupon_number'], 'coupon_time' => $data['coupon_time'], 'coupon_type'=> $data['coupon_type']]);
        return redirect()->back()->with('message','Đã cập nhật thông tin mã giảm giá');
    }
    public function delete_coupon($coupon_id){
    	$coupon = Coupon::find($coupon_id);
    	$coupon -> delete();
    	Session::put('message','Đã xóa mã giảm giá!');
    	return Redirect::to('list-coupon');
    }
    public function ignore_coupon(){
    	$coupon = Session::get('coupon');
    	if($coupon==true){
    		Session::forget('coupon');
    		return redirect()->back()->with('message','Đã xóa mã giảm giá!');
    	}
    }
}
