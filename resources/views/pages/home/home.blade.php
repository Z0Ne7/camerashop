@extends('layout')
@section('content')

<div class="features_items">
    <h2 class="title" style="color: #e8383f">Sản phẩm mới</h2>
    @php
    $i=0;
    @endphp
    @foreach($lastest_product as $key => $product)
    @php
    $i++;
    @endphp
    <div class="col-sm-3">
        <div class="product-image-wrapper">
            <div class="single-products">
                <div class="productinfo text-center">
                    <form>
                        @csrf
                        <input type="hidden" value="{{$product->product_id}}" class="cart_product_id_{{$product->product_id}}">
                        <input type="hidden" value="{{$product->product_name}}" class="cart_product_name_{{$product->product_id}}">
                        <input type="hidden" value="{{$product->product_image}}" class="cart_product_image_{{$product->product_id}}">
                        <input type="hidden" value="{{$product->product_price - ($product->product_price * $product->product_discount / 100)}}" class="cart_product_price_{{$product->product_id}}">
                        <input type="hidden" value="{{$product->product_stock}}" class="cart_product_stock_{{$product->product_id}}">
                        <input type="hidden" value="1" class="cart_product_qty_{{$product->product_id}}">
                        <a href="{{URL::to('/product-details/'.$product->product_id)}}">
                            <img class="imgproduct" src="{{URL::to('public/uploads/product/'.$product->product_image)}}" alt="" />
                            <p>
                                @if($product->product_stock>0)
                                <i class="pull-right in-stock"><i class="fa fa-check"></i>Còn hàng</i>
                                @else
                                <i class="pull-right out-stock"><i class="fa fa-times"></i>Hết hàng</i>
                                @endif
                            </p>
                            <h2>{{number_format($product->product_price - ($product->product_price * $product->product_discount / 100),'0',',','.').' '.'Đ'}}</h2>
                            <p>{{$product->product_name}}</p>
                        </a>
                        @if($product->product_stock>0)
                        <button type="button" name="add-to-cart" class="btn btn-default add-to-cart" data-id_product="{{$product->product_id}}"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ</button>
                        @else
                        <button type="button" name="out-of-stock" class="btn btn-default out-of-stock"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ</button>
                        @endif
                    </form>
                </div>
                <!-- <div class="product-overlay">
                    <div class="overlay-content">
                        <h2>$56</h2>
                        <p>Easy Polo Black Edition</p>
                        <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
    @php
    if($i==4){
    break;
    }
    @endphp
    @endforeach
</div>
@foreach($category as $all_cate)
<div class="features_items">
    <h2 class="title">{{$all_cate->category_name}}<a href="{{url('categories/'.$all_cate->category_id)}}"><i class="pull-right see-more">Xem thêm</i></a></h2>
    @php
    $i=0;
    @endphp
    @foreach($all_product_joined as $key => $product)
    @if($product->category_id==$all_cate->category_id)
    @php
    $i++;
    @endphp
    <div class="col-sm-3">
        <div class="product-image-wrapper">
            <div class="single-products">
                <div class="productinfo text-center">
                    <form>
                        @csrf
                        <input type="hidden" value="{{$product->product_id}}" class="cart_product_id_{{$product->product_id}}">
                        <input type="hidden" value="{{$product->product_name}}" class="cart_product_name_{{$product->product_id}}">
                        <input type="hidden" value="{{$product->product_image}}" class="cart_product_image_{{$product->product_id}}">
                        <input type="hidden" value="{{$product->product_price - ($product->product_price * $product->product_discount / 100)}}" class="cart_product_price_{{$product->product_id}}">
                        <input type="hidden" value="{{$product->product_stock}}" class="cart_product_stock_{{$product->product_id}}">
                        <input type="hidden" value="1" class="cart_product_qty_{{$product->product_id}}">
                        <a href="{{URL::to('/product-details/'.$product->product_id)}}">
                            <img class="imgproduct" src="{{URL::to('public/uploads/product/'.$product->product_image)}}" alt="" />
                            <p>
                                @if($product->product_stock>0)
                                <i class="pull-right in-stock"><i class="fa fa-check"></i>Còn hàng</i>
                                @else
                                <i class="pull-right out-stock"><i class="fa fa-times"></i>Hết hàng</i>
                                @endif
                            </p>
                            <h2>{{number_format($product->product_price - ($product->product_price * $product->product_discount / 100),'0',',','.').' '.'Đ'}}</h2>
                            <p>{{$product->product_name}}</p>
                        </a>
                        @if($product->product_stock>0)
                        <button type="button" name="add-to-cart" class="btn btn-default add-to-cart" data-id_product="{{$product->product_id}}"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ</button>
                        @else
                        <button type="button" name="out-of-stock" class="btn btn-default out-of-stock"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ</button>
                        @endif
                    </form>
                </div>
                @if($product->product_id==$lastest->product_id)
                <img src="{{asset('public/frontend/images/newproduct.png')}}" class="new" alt="" />
                @endif
            </div>
        </div>
    </div>
    @endif
    @php
    if($i==4){
    break;
    }
    @endphp
    @endforeach
</div>
@endforeach
@foreach($brand as $all_brand)
<div class="features_items">
    <h2 class="title">Thương hiệu {{$all_brand->brand_name}}<a href="{{url('categories/'.$all_brand->brand_id)}}"><i class="pull-right see-more">Xem thêm</i></a></h2>
    @php
    $i=0;
    @endphp
    @foreach($all_product_joined as $key => $product)
    @if($product->brand_id==$all_brand->brand_id)
    @php
    $i++;
    @endphp
    <div class="col-sm-3">
        <div class="product-image-wrapper">
            <div class="single-products">
                <div class="productinfo text-center">
                    <form>
                        @csrf
                        <input type="hidden" value="{{$product->product_id}}" class="cart_product_id_{{$product->product_id}}">
                        <input type="hidden" value="{{$product->product_name}}" class="cart_product_name_{{$product->product_id}}">
                        <input type="hidden" value="{{$product->product_image}}" class="cart_product_image_{{$product->product_id}}">
                        <input type="hidden" value="{{$product->product_price - ($product->product_price * $product->product_discount / 100)}}" class="cart_product_price_{{$product->product_id}}">
                        <input type="hidden" value="{{$product->product_stock}}" class="cart_product_stock_{{$product->product_id}}">
                        <input type="hidden" value="1" class="cart_product_qty_{{$product->product_id}}">
                        <a href="{{URL::to('/product-details/'.$product->product_id)}}">
                            <img class="imgproduct" src="{{URL::to('public/uploads/product/'.$product->product_image)}}" alt="" />
                            <p>
                                @if($product->product_stock>0)
                                <i class="pull-right in-stock"><i class="fa fa-check"></i>Còn hàng</i>
                                @else
                                <i class="pull-right out-stock"><i class="fa fa-times"></i>Hết hàng</i>
                                @endif
                            </p>
                            <h2>{{number_format($product->product_price - ($product->product_price * $product->product_discount / 100),'0',',','.').' '.'Đ'}}</h2>
                            <p>{{$product->product_name}}</p>
                        </a>
                        @if($product->product_stock>0)
                        <button type="button" name="add-to-cart" class="btn btn-default add-to-cart" data-id_product="{{$product->product_id}}"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ</button>
                        @else
                        <button type="button" name="out-of-stock" class="btn btn-default out-of-stock"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ</button>
                        @endif
                    </form>
                </div>
                @if($product->product_id==$lastest->product_id)
                <img src="{{asset('public/frontend/images/newproduct.png')}}" class="new" alt="" />
                @endif
            </div>
        </div>
    </div>
    @endif
    @php
    if($i==4){
    break;
    }
    @endphp
    @endforeach
</div>
@endforeach
@endsection
