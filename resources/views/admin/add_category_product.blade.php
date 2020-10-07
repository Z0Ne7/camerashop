@extends('admin_layout')
@section('admin_content')
@include('admin.pages.style_form_adding')
<section class="wrapper">
    <div class="container-contact100">
        <div class="wrap-contact100">
            <form class="contact100-form validate-form" action="{{url('/save-category-product')}}" method="POST">
                @csrf
                <span class="contact100-form-title">
                    Thêm danh mục
                </span>
                <?php
                    $message = Session::get('message');
                    if($message){
                        echo '<span style="color: red; width: 100%; text-align: center; ">'.$message.'</span>';
                        Session::put('message',null);
                    }
                ?>
                <div class="wrap-input100 validate-input bg1" data-validate="Chưa nhập tên danh mục">
                    <span class="label-input100">Tên danh mục</span>
                    <input class="input100" type="text" name="category_product_name">
                </div>

                <div class="wrap-input100 input100-select bg1">
                    <span class="label-input100">Trạng thái</span>
                    <div>
                        <select class="js-select2" name="category_product_status">
                            <option>Lựa chọn</option>
                            <option value="1">Hiển thị</option>
                            <option value="0">Ẩn</option>
                        </select>
                        <div class="dropDownSelect2"></div>
                    </div>
                </div>
                <div class="wrap-input100 validate-input bg0 rs1-alert-validate" data-validate = "Chưa nhập mô tả">
                    <span class="label-input100">Mô tả ngắn</span>
                    <textarea class="input100 txtarea" name="category_product_desc"></textarea>
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
