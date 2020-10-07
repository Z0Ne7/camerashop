@extends('pages/layout/layout_no_pricerange')
@section('content')
<div class="features_items">
        @if(session()->has('message'))
            <a href="javascript:window.location.reload();"><div class="alert alert-success">
                {{ session()->get('message') }}
            </div></a>
        @elseif(session()->has('errmsg'))
            <a href="javascript:window.location.reload();"><div class="alert alert-danger">
                {{ session()->get('errmsg') }}
            </div></a>
        @endif
    <h2 class="title2 text-left">Kết quả tìm kiếm cho từ khóa: "{{$keyword}}"</h2>
        @foreach($search_product as $key => $product)
        <div class="col-sm-3">
            <div class="product-image-wrapper">
                <div class="single-products">
                    <div class="productinfo text-center">
                        <form>
                            @csrf
                            <input type="hidden" value="{{$product->product_id}}" class="cart_product_id_{{$product->product_id}}">
                            <input type="hidden" value="{{$product->product_name}}" class="cart_product_name_{{$product->product_id}}">
                            <input type="hidden" value="{{$product->product_image}}" class="cart_product_image_{{$product->product_id}}">
                            <input type="hidden" value="{{$product->product_price}}" class="cart_product_price_{{$product->product_id}}">
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
                            <h2>{{number_format($product->product_price).' '.'Đ'}}</h2>
                            <p>{{$product->product_name}}</p>
                            </a>
                            @if($product->product_stock>0)
                                <button type="button" name="add-to-cart" class="btn btn-default add-to-cart" data-id_product="{{$product->product_id}}"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ</button>
                            @else
                                <button type="button" name="out-of-stock" class="btn btn-default out-of-stock"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ</button>
                            @endif
                        </form>
                    </div>                                        
                </div>
            </div>
        </div>
        @endforeach
</div>
@endsection                