@extends('pages/layout/layout_no_pricerange')
@section('content')
@foreach($product_details as $key => $value)
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v7.0" nonce="DhaCLkBc"></script>
	<div class="product-details"><!--product-details-->
		<div class="col-sm-5">
			<div class="view-product">
				<img src="{{URL::to('public/uploads/product/'.$value->product_image)}}" alt="" />
			</div>
			<div id="similar-product" class="carousel slide" data-ride="carousel">
				  <!-- Wrapper for slides -->
				    <div class="carousel-inner">
						<div class="item active">
						  <a href=""><img class="imggallery" src="{{URL::to('public/uploads/product/'.$value->product_image)}}" alt=""></a>
						  <a href=""><img class="imggallery" src="{{URL::to('public/uploads/product/'.$value->product_image)}}" alt=""></a>
						  <a href=""><img class="imggallery" src="{{URL::to('public/uploads/product/'.$value->product_image)}}" alt=""></a>
						</div>										
					</div>

				  <!-- Controls -->
				  <a class="left item-control" href="#similar-product" data-slide="prev">
					<i class="fa fa-angle-left"></i>
				  </a>
				  <a class="right item-control" href="#similar-product" data-slide="next">
					<i class="fa fa-angle-right"></i>
				  </a>
			</div>

		</div>
		<div class="col-sm-7">
			<div class="product-information"><!--/product-information-->
				@if($value->product_id==$lastest->product_id)
				<img src="{{asset('public/frontend/images/new.png')}}" class="newarrival" alt="" />
				@endif
				<h2>{{$value->product_name}}</h2>
				<p>Mã sản phẩm: SP{{$value->product_id}}</p>
				<img src="{{asset('public/frontend/images/rating.png')}}" alt="" />
				<form action="#" id="formProduct" >
					@csrf
					<input type="hidden" value="{{$value->product_id}}" class="cart_product_id_{{$value->product_id}}">
                    <input type="hidden" value="{{$value->product_name}}" class="cart_product_name_{{$value->product_id}}">
                    <input type="hidden" value="{{$value->product_image}}" class="cart_product_image_{{$value->product_id}}">
                    <input type="hidden" value="{{$value->product_price}}" class="cart_product_price_{{$value->product_id}}">
                    <input type="hidden" value="{{$value->product_stock}}" class="cart_product_stock_{{$value->product_id}}">
				<span>
					<span>{{number_format($value->product_price,'0',',','.').' '.'Đ'}}</span>
					<br>
					<label>Số lượng:</label>
					<input name="qty" type="number" min="1" value="1" class="cart_product_qty_{{$value->product_id}}">								
					
				</span>
				</form>
				<p><b>Tình trạng: </b>
					@if($value->product_stock==0)
					<i class="out-stock">Hết hàng</i>
					@else
					<i class="in-stock">Còn hàng</i>
					@endif
				</p>
				<p><b>Thương hiệu: </b>{{$value->brand_name}}</p>
				<p><b>Kho hàng: </b>{{$value->product_stock}} sản phẩm</p>
				@if($value->product_stock>0)
					<button type="button" name="add-to-cart" class="btn btn-default add-to-cart add-to-cart-details" data-id_product="{{$value->product_id}}"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ</button>
				@endif
			</div><!--/product-information-->
		</div>
	</div><!--/product-details-->
	<div class="category-tab shop-details-tab"><!--category-tab-->
		<div class="col-sm-12">
			<ul class="nav nav-tabs">
				<li class="active"><a href="#details" data-toggle="tab">Mô tả</a></li>
				<li><a href="#companyprofile" data-toggle="tab">Chi tiết sản phẩm</a></li>
			</ul>
		</div>
		<div class="tab-content">
			<div class="tab-pane fade active in" id="details">
				<p>{!!$value->product_desc!!}</p>				
			</div>							
			<div class="tab-pane fade" id="companyprofile">
				<p>{!!$value->product_content!!}</p>
			</div>																					
		</div>
	</div><!--/category-tab-->
	<div class="category-tab shop-details-tab">
		<div class="fb-comments" data-href="http://localhost/camerashop/product-details/.{{$value->product_id}}" data-numposts="10" data-width=""></div>
	</div>
@endforeach
	@if($count_relate>0)		
		<div class="recommended_items">
			<h2 class="title text-center">Sản phẩm liên quan</h2>
				@php
		            $i=0;
		        @endphp
		    @foreach($relate as $key => $relateproduct)
		        @php
		            $i++;
		        @endphp
		        <div class="item">
				<div class="col-sm-3">
					<div class="product-image-wrapper">
						<div class="single-products">
                            <div class="productinfo text-center">
                            	<a href="{{URL::to('/product-details/'.$relateproduct->product_id)}}">
                                <img class="imgproduct" src="{{URL::to('public/uploads/product/'.$relateproduct->product_image)}}" alt="" />
                                <h2>{{number_format($relateproduct->product_price).' '.'Đ'}}</h2>
                                <p>{{$relateproduct->product_name}}</p>
                            	</a>
                            </div>                                       
            			</div>
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
	@endif
@endsection