@extends('pages/layout/layout_minimal')
@section('content')
<section id="cart_items" style="margin-bottom: 150px">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="{{URL::to('/')}}">Trang chủ</a></li>
				  <li class="active">Tài khoản</li>
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
							<p class="viewtitle">Thông tin tài khoản</p>
							<div class="form-one">
								<form role="form" action="{{url('/update-info')}}" id="formAccount" method="POST">
                                	@csrf
                                	<label>Họ tên</label>
                                	<input type="text" value="{{$info->customer_name}}" name="hoten">
                                	<label>Email</label>
									<input type="text" value="{{$info->customer_email}}" name="email">
									<label>Số điện thoại</label>
									<input type="text" value="{{$info->customer_phone}}" name="sdt">
									<input type="hidden" name="id" value="{{$info->customer_id}}">		
                            	</form>
                            	<button type="submit" name="cal_shipping_fee" class="btn btn-primary btn-roundcorner btn-blue" form="formAccount">Cập nhật</button>
                            	<a href="{{url('/change-password')}}" class="btn btn-primary btn-roundcorner btn-blue">Đổi mật khẩu</a>
							</div>
						</div>
					</div>				
				</div>
			</div>
		</div>
	</section>
@endsection