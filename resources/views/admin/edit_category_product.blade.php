@extends('admin_layout')
@section('admin_content')
@include('admin.pages.style_form_adding')
<section class="wrapper">
    <div class="container-contact100">
        <div class="wrap-contact100">
            @foreach($edit_category_product as $key => $edit_value)
            <form class="contact100-form validate-form" action="{{url('/update-category-product/'.$edit_value->category_id)}}" method="POST">
                @csrf
                <span class="contact100-form-title">
                    Sửa thông tin danh mục
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
                    <input class="input100" type="text" name="category_product_name" value="{{$edit_value->category_name}}">
                </div>

                <div class="wrap-input100 input100-select bg1">
                    <span class="label-input100">Trạng thái</span>
                    <div>
                        <select class="js-select2" name="category_product_status">
                            @if($edit_value->category_status==0)
                                <option value="1">Hiển thị</option>
                                <option value="0" selected>Ẩn</option>
                            @else
                                <option value="1" selected>Hiển thị</option>
                                <option value="0">Ẩn</option>
                            @endif
                        </select>
                        <div class="dropDownSelect2"></div>
                    </div>
                </div>
                <div class="wrap-input100 validate-input bg0 rs1-alert-validate" data-validate = "Chưa nhập mô tả">
                    <span class="label-input100">Mô tả ngắn</span>
                    <textarea class="input100 txtarea" name="category_product_desc">{{$edit_value->category_desc}}</textarea>
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
            @endforeach
        </div>
    </div>
</section>
@include('admin.pages.js_form_adding')
@endsection
