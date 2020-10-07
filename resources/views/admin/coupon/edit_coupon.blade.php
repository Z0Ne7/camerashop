@extends('admin_layout')
@section('admin_content')
@include('admin.pages.style_form_adding')
    <section class="wrapper">
    <div class="container-contact100">
        <div class="wrap-contact100">
            <form class="contact100-form validate-form" action="{{url('/update-coupon/'.$coupon->coupon_id)}}" method="POST">
                @csrf
                <span class="contact100-form-title">
                    Cập nhật mã giảm giá
                </span>
                <?php
                    $message = Session::get('message');
                    if($message){
                        echo '<span style="color: red; width: 100%; text-align: center; ">'.$message.'</span>';
                        Session::put('message',null);
                    }
                ?>
                <div class="wrap-input100 validate-input bg1" data-validate="Chưa nhập mã">
                    <span class="label-input100">Mã giảm giá</span>
                    <input class="input100" type="text" name="coupon_value" value="{{$coupon->coupon_value}}" readonly>
                </div>
                <div class="wrap-input100 validate-input bg1" data-validate="Chưa thông tin">
                    <span class="label-input100">Thông tin mã</span>
                    <input class="input100" type="text" name="coupon_name" value="{{$coupon->coupon_name}}">
                </div>
                <div class="wrap-input100 validate-input bg1" data-validate="Chưa số lượng sử dụng">
                    <span class="label-input100">Số lần sử dụng</span>
                    <input class="input100" type="number" name="coupon_time" value="{{$coupon->coupon_time}}">
                </div>
                <div class="wrap-input100 input100-select bg1">
                    <span class="label-input100">Loại mã giảm giá</span>
                    <div>
                        <select class="js-select2" name="coupon_type">
                        	@if($coupon->coupon_type==1)
                                <option value="1" selected>Giảm phần trăm</option>
                            	<option value="2">Giảm giá trị</option>
                            @else
                                <option value="1">Giảm phần trăm</option>
                            	<option value="2" selected>Giảm giá trị</option>
                            @endif
                        </select>
                        <div class="dropDownSelect2"></div>
                    </div>
                </div>

                <div class="w-full dis-none js-show-service">
                    <div class="wrap-input100 validate-input bg1" data-validate="Chưa nhập số giảm">
                    <span class="label-input100">Mời nhập</span>
                    <input class="input100" type="number" name="coupon_number" value="{{$coupon->coupon_number}}">
                </div>
                </div>
                <div class="container-contact100-form-btn">
                    <button type="submit" name="add_product" class="contact100-form-btn">
                        <span>
                            Cập nhật
                            <i class="fa fa-long-arrow-right m-l-7" aria-hidden="true"></i>
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
    </section>
@include('admin.pages.js_form_adding')
@endsection
