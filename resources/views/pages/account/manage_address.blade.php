@extends('pages/layout/layout_minimal')
@section('content')
<section id="cart_items" style="margin-bottom: 150px">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="{{URL::to('/')}}">Trang chủ</a></li>
				  <li ><a href="{{URL::to('/account')}}">Tài khoản</a></li>
				  <li class="active">Thêm thông tin giao hàng</li>
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
							<p class="viewtitle">Địa chỉ giao hàng</p>
							<div class="form-one">
								<form role="form" action="{{url('/add-address')}}" method="POST" id="formAddress">
                                	@csrf
                                	<input type="hidden" name="id" value="{{$customer}}">
                                	<input type="text" name="shipping_name" placeholder="Họ tên người nhận hàng">
									<input type="text" name="shipping_phone" placeholder="Số điện thoại">
									<input type="text" name="shipping_address" placeholder="Địa chỉ">
	                                <div class="form-group">
	                                    <select name="city" id="city" class="form-control input-sm m-bot15 choose city">
			                                <option value="">Chọn Thành phố/Tỉnh</option>
			                                @foreach($city as $key => $city1)
			                                <option value="{{$city1->idCity}}">{{$city1->nameCity}}</option>
			                                @endforeach
			                            </select>
	                                </div>
	                                <div class="form-group">
	                                    <select name="province" id="province" class="form-control input-sm m-bot15 choose province">
			                                <option value="">Chọn Quận/Huyện</option>
			                                
			                            </select>
	                                </div>
	                                <div class="form-group">
	                                    <select name="ward" id="ward" class="form-control input-sm m-bot15 ward">
			                                <option value="">Chọn Phường/Xã</option>
			                            </select>
	                                </div>
                            	</form>
                            	<button type="submit" class="btn btn-primary btn-blue btn-roundcorner" form="formAddress">Thêm địa chỉ</button>
							</div>
						</div>
					</div>				
				</div>
			</div>
		</div>
	</section> <!--/#cart_items-->
@endsection