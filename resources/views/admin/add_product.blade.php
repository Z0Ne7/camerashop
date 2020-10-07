@extends('admin_layout')
@section('admin_content')
@include('admin.pages.style_form_adding')
<section class="wrapper">
    <div class="container-contact100">
        <div class="wrap-contact100">
            <form class="contact100-form validate-form" action="{{url('/save-product')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <span class="contact100-form-title">
                    Thêm sản phẩm
                </span>
                <?php
                    $message = Session::get('message');
                    if($message){
                        echo '<span style="color: red; width: 100%; text-align: center; ">'.$message.'</span>';
                        Session::put('message',null);
                    }
                ?>
                <div class="wrap-input100 validate-input bg1 rs1-wrap-input100" data-validate="Chưa nhập tên sản phẩm">
                    <span class="label-input100">Tên sản phẩm</span>
                    <input class="input100" type="text" name="product_name">
                </div>
                <div class="wrap-input100 validate-input bg1 rs1-wrap-input100" data-validate="Chưa nhập số lượng">
                    <span class="label-input100">Số lượng</span>
                    <input class="input100" type="number" name="product_stock">
                </div>
                <div class="wrap-input100 bg1">
                    <span class="label-input100">Hình ảnh</span>
                    <input type="file" name="product_image" class="input100">
                </div>
                <div class="wrap-input100 validate-input bg1 rs1-wrap-input100" data-validate = "Chưa nhập giá sản phẩm">
                    <span class="label-input100">Giá tiền</span>
                    <input class="input100" type="number" name="product_price">
                </div>

                <div class="wrap-input100 input100-select bg1 rs1-wrap-input100">
                    <span class="label-input100">Trạng thái</span>
                    <div>
                        <select class="js-select2" name="product_status">
                            <option>Lựa chọn</option>
                            <option value="1">Hiển thị</option>
                            <option value="0">Ẩn</option>
                        </select>
                        <div class="dropDownSelect2"></div>
                    </div>
                </div>

                <div class="wrap-input100 input100-select bg1 rs1-wrap-input100">
                    <span class="label-input100">Danh mục</span>
                    <div>
                        <select class="js-select2" name="product_cate">
                            <option>Chọn danh mục</option>
                            @foreach($cate_product as $key => $cate)
                            <option value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                            @endforeach
                        </select>
                        <div class="dropDownSelect2"></div>
                    </div>
                </div>
                <div class="wrap-input100 input100-select bg1 rs1-wrap-input100">
                    <span class="label-input100">Thương hiệu</span>
                    <div>
                        <select class="js-select2" name="product_brand">
                            <option>Chọn thương hiệu</option>
                            @foreach($brand_product as $key => $brand)
                            <option value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                            @endforeach
                        </select>
                        <div class="dropDownSelect2"></div>
                    </div>
                </div>


                <div class="wrap-input100 validate-input bg0 rs1-alert-validate" data-validate = "Chưa nhập mô tả">
                    <span class="label-input100">Mô tả ngắn</span>
                    <textarea class="input100 txtarea" name="product_desc"></textarea>
                </div>
                <div class="wrap-input100 bg0">
                    <span class="label-input100">Thông tin sản phẩm</span>
                    <textarea class="input100" name="product_content" id="ckeditor"></textarea>
                </div>
                <div class="container-contact100-form-btn">
                    <button type="submit" name="add_product" class="contact100-form-btn">
                        <span>
                            Thêm
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