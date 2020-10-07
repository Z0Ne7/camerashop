@extends('pages/layout/layout_minimal')
@section('content')
<section id="cart_items" style="margin-bottom: 150px">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="{{URL::to('/')}}">Trang chủ</a></li>
				  <li><a href="{{URL::to('/account')}}">Tài khoản</a></li>
				  <li class="active">Đổi mật khẩu</li>
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
							<p class="viewtitle">Thay đổi mật khẩu</p>
							<div class="form-one">
								<form role="form" action="{{url('/update-password')}}" id="formAccount" method="POST">
                                	@csrf
                                	<label>Mật khẩu cũ</label>
                                	<input type="password" name="old_pw" placeholder="Nhập mật khẩu cũ">
                                	<label>Mật khẩu mới</label>
									<input type="password" name="new_pw" placeholder="Nhập mật khẩu mới">
									<label>Xác nhận mật khẩu mới</label>
									<input type="password" name="confirm_pw" placeholder="Nhập lại mật khẩu mới">
									<input type="hidden" name="id" value="{{$customer}}">		
                            	</form>
                            	<button type="submit" name="cal_shipping_fee" class="btn btn-primary btn-roundcorner btn-blue" form="formAccount">Đổi mật khẩu</button>
							</div>
						</div>
					</div>				
				</div>
			</div>
		</div>
	</section>
@endsection