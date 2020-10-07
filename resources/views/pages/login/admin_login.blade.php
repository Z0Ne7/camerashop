<!DOCTYPE html>
<html lang="en">
<head>
	<title>Đăng nhập</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="{{asset('public/backend/images/icons/secrecy-icon.png')}}"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('public/backend/vendor/bootstrap/css/bootstrap.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('public/backend/fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('public/backend/vendor/animate/animate.css')}}">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="{{asset('public/backend/vendor/css-hamburgers/hamburgers.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('public/backend/vendor/select2/select2.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('public/backend/css/util.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('public/backend/css/main.css')}}">
<!--===============================================================================================-->
</head>
<body>
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="{{asset('public/backend/images/img-01.png')}}" alt="IMG">
				</div>

				<form class="login100-form validate-form" action="{{URL::to('/admin-dashboard')}}" method="POST">
					{{csrf_field()}}
					<span class="login100-form-title">
						Đăng nhập
					</span>
					<?php
						$message = Session::get('message');
						if($message){
							echo '<span style="color: red; width: 100%; text-align: center; ">'.$message.'</span>';
							Session::put('message',null);
						}

					?>
					<div class="wrap-input100 validate-input" data-validate = "Sai định dạng email!">
						<input class="input100" type="text" name="admin_email" placeholder="Email">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Chưa nhập mật khẩu!">
						<input class="input100" type="password" name="admin_password" placeholder="Mật khẩu">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					
					<div class="container-login100-form-btn">
						<button class="login100-form-btn" type="submit">
							Đăng nhập
						</button>
					</div>

					<div class="text-center p-t-12">
						{{-- <span class="txt1">
							Quên
						</span>
						<a class="txt2" href="#">
							Tài khoản / Mật khẩu?
						</a> --}}
					</div>

					<div class="text-center p-t-136">
					</div>
				</form>
			</div>
		</div>
	</div>
	
	
	

	
<!--===============================================================================================-->	
	<script src="{{asset('public/backend/vendor/jquery/jquery-3.2.1.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('public/backend/vendor/bootstrap/js/popper.js')}}"></script>
	<script src="{{asset('public/backend/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('public/backend/vendor/select2/select2.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('public/backend/vendor/tilt/tilt.jquery.min.js')}}"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="{{asset('public/backend/js/main.js')}}"></script>

</body>
</html>