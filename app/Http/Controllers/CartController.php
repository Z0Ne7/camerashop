<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;
use App\Coupon;
use App\Product;
session_start();

class CartController extends Controller
{
    public function cart(Request $request){
        return view('pages.cart.show_cart');
    }
    public function add_cart(Request $request){
        $data = $request->all();
        $session_id = substr(md5(microtime()), rand(0,26),5);
        $cart = Session::get('cart');
        if($data['cart_product_stock']<$data['cart_product_qty'] && $data['cart_product_stock']>0){
            $data['cart_product_qty']=$data['cart_product_stock'];
        }
        if($cart==true){
            $is_available = 0;
            foreach($cart as $key => $val){
                if($val['product_id']==$data['cart_product_id']){
                    $is_available++;
                }
            }
            if($is_available==0){
                $cart[] = array(
                'session_id' => $session_id,
                'product_name' => $data['cart_product_name'],
                'product_id' => $data['cart_product_id'],
                'product_image' => $data['cart_product_image'],
                'product_qty' => $data['cart_product_qty'],
                'product_price' => $data['cart_product_price'],
            );
                Session::put('cart',$cart);
            }
        }else{
            $cart[] = array(
                'session_id' => $session_id,
                'product_name' => $data['cart_product_name'],
                'product_id' => $data['cart_product_id'],
                'product_image' => $data['cart_product_image'],
                'product_qty' => $data['cart_product_qty'],
                'product_price' => $data['cart_product_price'],
            );
                Session::put('cart',$cart);
        }
        Session::save();
    }
    
    public function del_cart_product($session_id){
        $cart = Session::get('cart');
        if($cart==true){
            foreach($cart as $key => $val){
                if($val['session_id']==$session_id){
                    unset($cart[$key]);
                }
            }
            Session::put('cart',$cart);
            return redirect()->back()->with('message','???? x??a s???n ph???m!');
        }
        else{
            return redirect()->back()->with('errmsg','X??a s???n ph???m th???t b???i!');
        }
    }
    public function update_cart(Request $request){
        $data = $request -> all();
        $cart = Session::get('cart');
        $products = Product::where('product_id',$data['cart_id'])->first();
        if($cart==true){
            foreach($data['cart_qty'] as $key => $qty){
                foreach($cart as $session => $val){
                    if($val['session_id']==$key){
                        if($qty>$products->product_stock){
                            return redirect()->back()->with('errmsg','Ch??? c??n '.$products->product_stock.' s???n ph???m trong kho');
                        }else{
                            $cart[$session]['product_qty'] = $qty;
                        }
                    }
                }
            }
            Session::put('cart',$cart);
            return redirect()->back()->with('message','???? c???p nh???t s??? l?????ng!');
        }else{
            return redirect()->back()->with('errmsg','Kh??ng th??? c???p nh???t s??? l?????ng!');
        }
    }
    public function apply_coupon(Request $request){
        $data = $request->all();
        $coupon = Coupon::where('coupon_value',$data['coupon'])->first();
        if($coupon==NULL){
            if($data['coupon']==NULL){
                return redirect()->back()->with('errmsg','Ch??a nh???p m?? gi???m gi??');
            }else{
                return redirect()->back()->with('errmsg','M?? gi???m gi?? "'.$data['coupon'].'" kh??ng t???n t???i');
            }
        }else{
            if($coupon->coupon_time<1){
            return redirect()->back()->with('errmsg','M?? gi???m gi?? ???? h???t l?????t s??? d???ng!');
        }else{
            $count_coupon = $coupon->count();
            if($count_coupon>0){
                $coupon_session = Session::get('coupon');
                if($coupon_session==true){
                    $is_available=0;
                    if($is_available==0){
                        $cp[] = array(
                            'coupon_value' => $coupon->coupon_value,
                            'coupon_type' => $coupon->coupon_type,
                            'coupon_number' => $coupon->coupon_number,
                        );
                        Session::put('coupon',$cp);
                    }
                }else{
                    $cp[] = array(
                            'coupon_value' => $coupon->coupon_value,
                            'coupon_type' => $coupon->coupon_type,
                            'coupon_number' => $coupon->coupon_number,
                        );
                        Session::put('coupon',$cp);
                }
                    Session::save();
                    return redirect()->back()->with('message','???? ??p d???ng m?? gi???m gi??: "'.$coupon->coupon_value.'"');
            }
        
        }
        }
        
    }
    public function clear_all(){
        $cart = Session::get('cart');
        if($cart==true){
            Session::forget('cart');
            return redirect()->back();
        }
    }
}
