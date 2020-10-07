@extends('pages/layout/layout_cart')
@section('content')             
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
              <li><a href="{{URL::to('/')}}">Trang chủ</a></li>
              <li class="active">Giỏ hàng</li>
            </ol>
        </div>
        <div class="table-responsive cart_info">
            @if(session()->has('message'))
                <a href="javascript:window.location.reload();"><div class="alert alert-success">
                    {{ session()->get('message') }}
                </div></a>
            @elseif(session()->has('errmsg'))
                <a href="javascript:window.location.reload();"><div class="alert alert-danger">
                    {{ session()->get('errmsg') }}
                </div></a>
            @endif
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td></td>
                        <td class="description" style="padding-left: 90px">Sản phẩm</td>
                        <td class="price">Đơn giá</td>
                        <td class="quantity">Số lượng</td>
                        <td class="total">Số tiền</td>
                        <td>
                            @if(Session::get('cart'))
                                <a href="{{url('clear-all')}}" style="color: #ffffff" onclick="return confirm('Xóa tất cả sản phẩm trong giỏ hàng?')">Xóa tất cả</a>
                            @endif
                        </td>
                    </tr>
                </thead>
                <tbody>
                    @if(Session::get('cart')==true)
                    @php
                        $total = 0;
                    @endphp
                    @foreach(Session::get('cart') as $key => $cart)
                    @php
                        $subtotal = $cart['product_price']*$cart['product_qty'];
                        $total += $subtotal;
                    @endphp
                    <tr>
                        <td class="cart_product">
                            <img src="{{asset('public/uploads/product/'.$cart['product_image'])}}" width="50">
                        </td>
                        <td class="cart_description">
                            <h4><a href="{{URL::to('/product-details/'.$cart['product_id'])}}">{{$cart['product_name']}}</a></h4>
                        </td>
                        <td class="cart_price">
                            <h4>{{number_format($cart['product_price'],'0',',','.').'đ'}}</h4>
                        </td>
                        <td class="cart_quantity">
                            <div class="cart_quantity_button">
                                <form action="{{URL::to('/update-cart')}}" method="POST" >
                                    @csrf
                                <input type="hidden" name="cart_id[{{$cart['session_id']}}]" value="{{$cart['product_id']}}">
                                <input class="cart_quantity_input" type="number" min="1" name="cart_qty[{{$cart['session_id']}}]" value="{{$cart['product_qty']}}">
                                </form>
                            </div>
                        </td>
                        <td class="cart_total">
                            <h6 class="cart_total_price">
                                {{number_format($subtotal,'0',',','.').'đ'}}
                            </h6>
                        </td>
                        <td class="cart_delete">
                            <a class="cart_quantity_delete" href="{{URL::to('/del-cart-product/'.$cart['session_id'])}}">Xóa</a>
                        </td>
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="4"></td>
                        <td>
                            <form method="POST" action="{{URL::to('/apply-coupon')}}" id="formCoupon">
                                @csrf
                                <input type="text" name="coupon" class="form-control" placeholder="Nhập mã giảm giá" size="12"> 
                            </form>
                        </td>
                        <td><button type="submit" class="btn btn-success check_coupon" name="check_coupon" form="formCoupon" value="CouponCode">Áp dụng</button></td>
                    </tr>
                    <tr>
                        <td colspan="4"></td>
                        <td colspan="2">
                            <ul class="price_items">
                                <li class="price_item">
                                    <span class="price_text">Tổng tiền hàng:</span>
                                    <span class="price_value">{{number_format($total,'0',',','.').'đ'}}</span>
                                </li>
                            @if(Session::get('coupon'))
                                @foreach(Session::get('coupon') as $key => $cp)
                                    @if($cp['coupon_type']==1)
                                        <li class="price_item">
                                            <span class="price_text">Giảm giá {{$cp['coupon_number']}}%: <a href="{{url('ignore-coupon')}}" class="ignore-coupon"><i class="fa fa-times"></i></a></span>
                                            @php
                                                $total_cp =($total*$cp['coupon_number'])/100;
                                                echo '<span class="price_value">'.number_format($total_cp,'0',',','.').' Đ</span>';
                                                $tamtinh = $total - $total_cp;
                                            @endphp
                                        </li>
                                        <li class="price_item">
                                            <span class="price_text_final">Tạm tính:</span>
                                            <span class="price_value_final">{{number_format($tamtinh,'0',',','.').'đ'}}</span>
                                        </li>
                                    
                                    @elseif($cp['coupon_type']==2)
                                        <li class="price_item">
                                        <span class="price_text">Giảm giá: <a href="{{url('ignore-coupon')}}" class="ignore-coupon"><i class="fa fa-times"></i></a></span>
                                        <span class="price_value">{{number_format($cp['coupon_number'],'0',',','.').'đ'}}</span>
                                            @php
                                                $total_cp = $cp['coupon_number'];
                                                $tamtinh = $total - $total_cp;
                                            @endphp
                                        </li>
                                        <li class="price_item">
                                            <span class="price_text_final">Tạm tính:</span>
                                            <span class="price_value_final">{{number_format($tamtinh,'0',',','.').'đ'}}</span>
                                        </li>
                                    @endif
                                @endforeach
                            @else
                                   <li class="price_item">
                                        <span class="price_text_final">Tạm tính:</span>
                                        <span class="price_value_final">{{number_format($total,'0',',','.').'đ'}}</span>
                                    </li>
                            @endif
                        </ul>
                        @if(Session::get('customer_id'))
                        <a class="btn btn-default check_out" href="{{url('shipping')}}">Tiến hành đặt hàng <i class="fa fa-arrow-right"></i></a>
                        @else
                        <a class="btn btn-default check_out" href="{{url('login-checkout')}}">Tiến hành đặt hàng <i class="fa fa-arrow-right"></i></a>
                        @endif
                    </td>
                    </tr>
                    @else
                    <tr><td colspan="5">
                        <center><b style="font-size: 16px">
                        @php
                            Session::forget('coupon');
                            echo 'Chưa có sản phẩm trong giỏ hàng';
                        @endphp
                        </b>
                        <a class="btn btn-success" href="{{URL::to('/')}}">Mua ngay</a>

                        </center>
                        <div style="margin-bottom: 50px"></div>
                        </td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
   </section> <!--/#cart_items-->
@endsection