@extends('pages/layout/layout_minimal')
@section('content')
<section id="cart_items" style="margin-bottom: 50px">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="{{URL::to('/')}}">Trang chủ</a></li>
				  <li><a href="{{URL::to('/cart')}}">Giỏ hàng</a></li>
				  <li class="active">Xác nhận</li>
				</ol>
			</div>			
			<div class="shopper-informations">
				<p class="reviewtitle">Xác nhận đặt hàng</p>
				<div class="row">
					<div class="col-sm-4 clearfix">
						<div class="form-three">
							<div class="ship_info">
								<div class="ship_title">
									<span>Thông tin giao hàng</span>
									<a href="{{url('/address')}}">Sửa</a>
								</div>
								<div class="ship_add">
									<span class="ship_name">{{$data['shipping_name']}}</span>
									<span class="ship_phone">Số điện thoại: {{$data['shipping_phone']}}</span>
									<span class="ship_street">Địa chỉ: {{$data['shipping_address']}}, {{$ward->nameWard}}, {{$province->nameProvince}}, {{$city->nameCity}}</span>
								</div>
							</div>
							<form method="POST">
                            	@csrf
                            	@if(Session::get('fee'))
									<input type="hidden" name="order_fee" class="order_fee" value="{{Session::get('fee')}}">
								@endif
								@if(Session::get('coupon'))
									@foreach(Session::get('coupon') as $key => $cou)
									<input type="hidden" name="order_coupon" class="order_coupon" value="{{$cou['coupon_value']}}">
									@endforeach
								@else
									<input type="hidden" name="order_coupon" class="order_coupon" value="NULL">
								@endif
								<input type="hidden" name="shipping_name" class="shipping_name" value="{{$data['shipping_name']}}">
								<input type="hidden" name="shipping_address" class="shipping_address" value="{{$data['shipping_address']}}">
								<input type="hidden" name="shipping_phone" class="shipping_phone" value="{{$data['shipping_phone']}}">
								<input type="hidden" name="ma_tinh" class="ma_tinh" value="{{$matinh}}">
								<input type="hidden" name="ma_huyen" class="ma_huyen" value="{{$mahuyen}}">
								<input type="hidden" name="ma_xa" class="ma_xa" value="{{$maxa}}">
								<div class="form-group">
	                            	<label for="exampleInputPassword1">Hình thức thanh toán</label>
	                                <select name="payment_select" class="form-control input-sm m-bot15 payment_select">
		                                <option value="0">Chuyển khoản</option>
		                                <option value="1" selected>Tiền mặt</option>
	                        		</select>
	                    		</div>
							</form>
						</div>
					</div>
					<div class="col-sm-8">
						<div class="table-responsive cart_info">
			            	<table class="table table-condensed">
			                <thead>
			                    <tr class="cart_menu">
			                    	<td></td>
			                        <td class="description">Sản phẩm</td>
			                        <td class="total">Số tiền</td>
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
			                    	<td><b style="font-size: 20px; color: red">{{$cart['product_qty']}}X</b></td>
			                        <td class="cart_description">
			                            <h5><a href="{{URL::to('/product-details/'.$cart['product_id'])}}">{{$cart['product_name']}}</a></h5>
			                        </td>
			                        
			                        <td class="cart_total">
			                            <h6 style="font-size: 16px">
			                                {{number_format($subtotal,'0',',','.').'đ'}}
			                            </h6>
			                        </td>
			                    </tr>
			                    @endforeach
			                    <tr>
			                        <td colspan="3">
			                        	<ul class="pull-right price_items">
			                        		<li class="price_item">
			                        			<span class="price_text">Tổng tiền hàng:</span>
			                        			<span class="price_value">{{number_format($total,'0',',','.').'đ'}}</span>
			                        		</li>
			                            @if(Session::get('coupon'))
			                            <li class="price_item">
			                                @foreach(Session::get('coupon') as $key => $cp)
			                                    @if($cp['coupon_type']==1)
			                                        <span class="price_text">Giảm giá {{$cp['coupon_number']}}%</span>
			                                            @php
			                                                $total_cp =($total*$cp['coupon_number'])/100;
			                                                echo '<span class="price_value">-'.number_format($total_cp,'0',',','.').'đ</span>';
			                                                $tamtinh = $total - $total_cp;
			                                            @endphp
			                                    @elseif($cp['coupon_type']==2)
			                                        <span class="price_text">Giảm giá:</span>
			                                        <span class="price_value">-{{number_format($cp['coupon_number'],'0',',','.').'đ'}}</span>
			                                            @php
			                                                $total_cp = $cp['coupon_number'];
			                                                $tamtinh = $total - $total_cp;
			                                            @endphp
			                                    @endif
			                                @endforeach
			                            </li>
			                            @else
			                            @endif
			                            @if(Session::get('fee'))
			                            <li class="price_item">
			                            	<span class="price_text">Phí vận chuyển:</span>
			                            	<span class="price_value">{{number_format(Session::get('fee'),'0',',','.').'đ'}}</span>
			                            </li>
			                            @endif
			                            @if(Session::get('fee'))
			                            	@php
			                            	$fee = Session::get('fee');
			                            		if(Session::get('coupon')){
			                            			$total_after_fee = $tamtinh + $fee;
			                            			echo '<li class="price_item"><span class="price_text_final">Thành tiền:</span> <span class="price_value_final">'.number_format($total_after_fee,'0',',','.').'đ'.'</span></li>';
			                            		}else{
			                            			$total_after_fee = $total + $fee;
			                            			echo '<li class="price_item"><span class="price_text_final">Thành tiền:</span> <span class="price_value_final">'.number_format($total_after_fee,'0',',','.').'đ'.'</span></li>';
			                            		}
			                            	@endphp
			                            @endif
			                        </ul>
			                    </td>
			                    </tr>
			                    <tr>
			                    	<td colspan="2"></td>
			                    	<td>
			                    	<button type="button" name="confirm_order" class="btn btn-primary btn-confirm-order confirm_order">Đặt hàng</button>
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
			                        </td>
			                    </tr>
			                    @endif
			                </tbody>
			            </table>
        			</div>
					</div>
								
				</div>
			</div>
		</div>
	</section> <!--/#cart_items-->
@endsection