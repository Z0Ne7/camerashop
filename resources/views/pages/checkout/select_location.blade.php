@extends('pages/layout/layout_minimal')
@section('content')
<section id="cart_items" style="margin-bottom: 150px">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="{{URL::to('/')}}">Trang chủ</a></li>
				  <li ><a href="{{URL::to('/cart')}}">Giỏ hàng</a></li>
				  <li class="active">Giao hàng</li>
				</ol>
			</div>			
			<div class="shopper-informations">
				<div class="row">
					<div class="col-sm-12 clearfix">
						<div class="bill-to">
							<p class="viewtitle">Thông tin giao hàng<a href="{{url('/address')}}" style="margin-left: 150px; color: #427fca">Sửa</a></p>
							<div class="form-one">
								<form role="form" method="POST">
                                	@csrf
                                	<input type="hidden" name="id" value="{{$customer}}">
                                	<label>Họ tên</label>
                                	<input type="text" name="shipping_name" class="shipping_name" value="{{$shipping->shipping_name}}" readonly>
                                	<label>Số điện thoại</label>
									<input type="text" name="shipping_phone" class="shipping_phone" value="{{$shipping->shipping_phone}}" readonly>
									<label>Địa chỉ</label>
									<input type="text" name="shipping_address" class="shipping_address" value="{{$shipping->shipping_address}}" readonly>
									<label>Tỉnh/Thành phố</label>
	                                <div class="form-group">
	                                    <select name="city" id="city" class="form-control input-sm m-bot15 choose city">
			                                @foreach($city as $key => $city1)
				                                @if($city1->idCity==$shipping->idCity)
				                                <option value="{{$city1->idCity}}" selected>{{$city1->nameCity}}</option>
				                                @php
				                                	break;
				                                @endphp
				                                @endif
			                                @endforeach
			                            </select>
	                                </div>
	                                <label>Quận/Huyện</label>
	                                <div class="form-group">
	                                    <select name="province" id="province" class="form-control input-sm m-bot15 choose province">
			                                @foreach($province as $key => $province1)
				                                @if($province1->idProvince==$shipping->idProvince)
				                                <option value="{{$province1->idProvince}}" selected>{{$province1->nameProvince}}</option>
				                                @php
				                                	break;
				                                @endphp
				                                @endif
			                                @endforeach
			                            </select>
	                                </div>
	                                <label>Phường/Xã</label>
	                                <div class="form-group">
	                                    <select name="ward" id="ward" class="form-control input-sm m-bot15 ward">
			                                @foreach($ward as $key => $ward1)
				                                @if($ward1->idWard==$shipping->idWard)
				                                <option value="{{$ward1->idWard}}" selected>{{$ward1->nameWard}}</option>
				                                @php
				                                	break;
				                                @endphp
				                                @endif
			                                @endforeach
			                            </select>
	                                </div>
	                                <input type="button" name="cal_shipping_fee" class="btn btn-primary btn-blue btn-roundcorner cal_shipping_fee" value="Xác nhận">
                            	</form>
							</div>
						</div>
					</div>				
				</div>
			</div>
		</div>
	</section> <!--/#cart_items-->
@endsection