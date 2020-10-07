@extends('admin_layout')
@section('admin_content')
@include('admin.pages.style_form_adding')
<section class="wrapper">
    <div class="container-contact100">
        <div class="wrap-contact100">
            <form class="contact100-form validate-form" method="POST">
                @csrf
                <span class="contact100-form-title">
                    Thêm phí vận chuyển
                </span>
                <?php
                    $message = Session::get('message');
                    if($message){
                        echo '<span style="color: red; width: 100%; text-align: center; ">'.$message.'</span>';
                        Session::put('message',null);
                    }
                ?>
                <div class="wrap-input100 input100-select bg1 rs1-wrap-input100">
                    <span class="label-input100">Thành phố/Tỉnh</span>
                    <div>
                        <select name="city" id="city" class="js-select2 choose city">
                            <option>Lựa chọn</option>
                            @foreach($city as $key => $city1)
                            <option value="{{$city1->idCity}}">{{$city1->nameCity}}</option>
                            @endforeach
                        </select>
                        <div class="dropDownSelect2"></div>
                    </div>
                </div>
                <div class="wrap-input100 input100-select bg1 rs1-wrap-input100">
                    <span class="label-input100">Quận/Huyện</span>
                    <div>
                        <select name="province" id="province" class="js-select2 choose province">
                            <option>Lựa chọn</option>
                        </select>
                        <div class="dropDownSelect2"></div>
                    </div>
                </div>
                <div class="wrap-input100 input100-select bg1 rs1-wrap-input100">
                    <span class="label-input100">Phường/Xã</span>
                    <div>
                        <select name="ward" id="ward" class="js-select2 ward">
                            <option>Lựa chọn</option>
                        </select>
                        <div class="dropDownSelect2"></div>
                    </div>
                </div>
                <div class="wrap-input100 validate-input bg1 rs1-wrap-input100" data-validate="Chưa nhập số tiền">
                    <span class="label-input100">Số tiền</span>
                    <input class="input100 shippingfee" type="number" name="shippingfee">
                </div>
                <div class="container-contact100-form-btn">
                    <button type="button" name="add_shippingfee" class="contact100-form-btn add_shippingfee">
                        <span>
                            Thêm
                            <i class="fa fa-long-arrow-right m-l-7" aria-hidden="true"></i>
                        </span>
                    </button>
                </div>
            </form>
            <div style="margin-bottom: 20px"></div>
            <div id="load_delivery">
            </div>
        </div>
    </div>
</section>
@include('admin.pages.js_form_adding')
@endsection
