@extends('pages/layout/layout_minimal')
@section('content')
<section id="cart_items" style="margin-bottom: 150px">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="{{URL::to('/')}}">Trang chủ</a></li>
				  <li ><a href="{{URL::to('/account')}}">Tài khoản</a></li>
				  <li class="active">Thông tin giao hàng</li>
				</ol>
			</div>
			@if(session()->has('message'))
                <a href="javascript:window.location.reload();"><div class="alert alert-success">
                    {{ session()->get('message') }}
                </div></a>
            @elseif(session()->has('errmsg'))
                <a href="javascript:window.location.reload();"><div class="alert alert-danger">
                    {{ session()->get('errmsg') }}
                </div></a>
            @endif		
			<div class="shopper-informations">
				<div class="row">
					<div class="col-sm-12 clearfix">
						<div class="bill-to">
							<p class="viewtitle">Thông tin giao hàng</p>
							<div class="form-one">
								<form role="form" action="{{url('/update-address')}}" method="POST" id="formAddress">
                                	@csrf
                                	<input type="hidden" name="id" value="{{$customer}}">
                                	<label>Họ tên</label>
                                	<input type="text" name="shipping_name" value="{{$shipping->shipping_name}}">
                                	<label>Số điện thoại</label>
									<input type="text" name="shipping_phone" value="{{$shipping->shipping_phone}}">
									<label>Địa chỉ</label>
									<input type="text" name="shipping_address" value="{{$shipping->shipping_address}}">
									<label>Tỉnh/Thành phố</label>
	                                <div class="form-group">
	                                    <select name="city" id="city" class="form-control input-sm m-bot15 choose city">
			                                @foreach($city as $key => $city1)
				                                @if($city1->idCity==$shipping->idCity)
				                                <option value="{{$city1->idCity}}" selected>{{$city1->nameCity}}</option>
				                                @else
				                                <option value="{{$city1->idCity}}">{{$city1->nameCity}}</option>
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
                            	</form>
                            	<button type="submit" class="btn btn-primary btn-blue btn-roundcorner" form="formAddress">Cập nhật</button>
							</div>
						</div>
					</div>				
				</div>
			</div>
		</div>
	</section> <!--/#cart_items-->
@endsection