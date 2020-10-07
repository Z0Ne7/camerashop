@extends('admin_layout')
@section('admin_content')
@include('admin.pages.style_form_adding')
<section class="wrapper">
    <div class="container-contact100">
        <div class="wrap-contact100">
            @foreach($edit_product as $key =>$pro)
            <form class="contact100-form validate-form" action="{{url('/update-product/'.$pro->product_id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                <span class="contact100-form-title">
                    Sửa thông tin sản phẩm
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
                    <input class="input100" type="text" name="product_name" value="{{$pro->product_name}}">
                </div>
                <div class="wrap-input100 validate-input bg1 rs1-wrap-input100" data-validate="Chưa nhập số lượng">
                    <span class="label-input100">Số lượng</span>
                    <input class="input100" type="number" name="product_stock" value="{{$pro->product_stock}}">
                </div>
                <div class="wrap-input100 bg1 rs1-wrap-input100">
                    <span class="label-input100">Hình ảnh</span>
                    <input type="file" name="product_image" class="input100">
                </div>
                <div class="wrap-input100 bg1 rs1-wrap-input100" style="border: none; background-color: transparent;">
                    <img src="{{url('public/uploads/product/'.$pro->product_image)}}" class="imgpro">
                </div>
                <div class="wrap-input100 validate-input bg1 rs1-wrap-input100" data-validate = "Chưa nhập giá sản phẩm">
                    <span class="label-input100">Giá tiền</span>
                    <input class="input100" type="number" name="product_price" value="{{$pro->product_price}}">
                </div>

                <div class="wrap-input100 input100-select bg1 rs1-wrap-input100">
                    <span class="label-input100">Trạng thái</span>
                    <div>
                        <select class="js-select2" name="product_status">
                            @if($pro->product_status==0)
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

                <div class="wrap-input100 input100-select bg1 rs1-wrap-input100">
                    <span class="label-input100">Danh mục</span>
                    <div>
                        <select class="js-select2" name="product_cate">
                            @foreach($cate_product as $key => $cate)
                                @if($cate->category_id==$pro->category_id)
                                    <option selected value="{{$cate->category_id}}" >{{$cate->category_name}}</option>
                                @else
                                    <option value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                                @endif
                            @endforeach
                        </select>
                        <div class="dropDownSelect2"></div>
                    </div>
                </div>
                <div class="wrap-input100 input100-select bg1 rs1-wrap-input100">
                    <span class="label-input100">Thương hiệu</span>
                    <div>
                        <select class="js-select2" name="product_brand">
                            @foreach($brand_product as $key => $brand)
                            @if($brand->brand_id==$pro->brand_id)
                                    <option selected value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                                @else
                                    <option value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                                @endif
                            @endforeach
                        </select>
                        <div class="dropDownSelect2"></div>
                    </div>
                </div>


                <div class="wrap-input100 validate-input bg0 rs1-alert-validate" data-validate = "Chưa nhập mô tả">
                    <span class="label-input100">Mô tả ngắn</span>
                    <textarea class="input100 txtarea" name="product_desc">{{$pro->product_desc}}</textarea>
                </div>
                <div class="wrap-input100 bg0">
                    <span class="label-input100">Thông tin sản phẩm</span>
                    <textarea class="input100" name="product_content" id="ckeditor">{{$pro->product_content}}</textarea>
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

{{-- @extends ('admin_layout')
@section ('admin_content')
<div class="row">
            <div class="col-lg-8">
                    <section class="panel">
                        <header class="panel-heading">
                            Cập nhật sản phẩm
                        </header>
                        <div class="panel-body">
                            <?php
                                $message = Session::get('message');
                                if($message){
                                    echo '<span style="color: red; width: 100%; text-align: center; ">'.$message.'</span>';
                                    Session::put('message',null);
                                }
                            ?>
                            <div class="position-center">
                            	@foreach($edit_product as $key =>$pro)
                                <form role="form" action="{{URL::to('/update-product/'.$pro->product_id)}}" method="post" enctype="multipart/form-data" >
                                	{{csrf_field()}}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên sản phẩm</label>
                                    <input type="text" name="product_name" class="form-control" id="exampleInputEmail1" value="{{$pro->product_name}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Giá sản phẩm</label>
                                    <input type="text" name="product_price" class="form-control" id="exampleInputEmail1" value="{{$pro->product_price}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Danh mục sản phẩm</label>
                                    <select name="product_cate" class="form-control input-sm m-bot15">
                                        @foreach($cate_product as $key => $cate)
                                        @if($cate->category_id==$pro->category_id)
                                        <option selected value="{{$cate->category_id}}" >{{$cate->category_name}}</option>
                                        @else
                                        <option value="{{$cate->category_id}}" >{{$cate->category_name}}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Thương hiệu</label>
                                    <select name="product_brand" class="form-control input-sm m-bot15">
                                        @foreach($brand_product as $key => $brand)
                                        @if($brand->brand_id==$pro->brand_id)
                                        <option selected value="{{$brand->brand_id}}" >{{$brand->brand_name}}</option>
                                        @else
                                        <option value="{{$brand->brand_id}}" >{{$brand->brand_name}}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Hình ảnh</label>
                                    <input type="file" name="product_image" class="form-control" id="exampleInputEmail1">
                                    <img src="{{URL::to('public/uploads/product/'.$pro->product_image)}}" class="imgpro">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả sản phẩm</label>
                                    <textarea style="resize: none" rows=5 class="form-control" name="product_desc" id="exampleInputPassword1">{{$pro->product_desc}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Thông tin sản phẩm</label>
                                    <textarea style="resize: none" rows=7 class="form-control" name="product_content" id="exampleInputPassword1">{{$pro->product_content}}</textarea>
                                </div>
                                <div class="form-group">
                                	<label for="exampleInputPassword1">Trạng thái</label>
                                    <select name="product_status" class="form-control input-sm m-bot15">
                                        @foreach($edit_product as $key =>$pro)
                                        @if($pro->product_status==0)
		                                <option value="0" selected>Ẩn</option>
                                        <option value="1">Hiển thị</option>
                                        @else
                                        <option value="0">Ẩn</option>
		                                <option value="1" selected>Hiển thị</option>
		                                @endif
                                        @endforeach
		                            </select>
                                </div>
                                
                                <button type="submit" name="add_category_product" class="btn btn-info">Cập nhật sản phẩm</button>
                            </form>
                            @endforeach
                            </div>

                        </div>
                    </section>

            </div>
            
        </div>
@endsection --}}