@extends('pages/layout/layout_cart')
@section('content')             
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
              <li><a href="{{URL::to('/')}}">Trang chủ</a></li>
              <li><a href="{{URL::to('/orders')}}">Đơn hàng</a></li>
              <li class="active">Chi tiết đơn hàng</li>
            </ol>
        </div>
            @if(session()->has('message'))
                <a href="javascript:window.location.reload();"><div class="alert alert-success">
                    {{ session()->get('message') }}
                </div></a>
            @elseif(session()->has('errmsg'))
                <a href="javascript:window.location.reload();"><div class="alert alert-danger">
                    {{ session()->get('errmsg') }}
                </div></a>
            @endif
        <div class="row">
            <div class="col-sm-4">
                @foreach($order as $data)
                    <div class="ship_info">
                    <div class="ship_title">
                        <span>Thông tin giao hàng</span>
                    </div>
                    <div class="ship_add">
                        <span class="ship_name">{{$data->order_shipping_name}}</span>
                        <span class="ship_phone">Số điện thoại: {{$data->order_shipping_phone}}</span>
                        <span class="ship_street">Địa chỉ: {{$data->order_shipping_address}}, {{$ward->nameWard}}, {{$province->nameProvince}}, {{$city->nameCity}}</span>
                    </div>
                    </div>
                @endforeach
            </div>
            <div class="col-sm-8">
                <div class="table-responsive cart_info">
                    <table class="table table-condensed">
                        <thead>
                            <tr class="cart_menu">
                                <td></td>
                                <td class="description" style="padding-left: 90px">Sản phẩm</td>
                                <td class="price">Đơn giá</td>
                                <td class="quantity">Số lượng</td>
                                <td class="total">Số tiền</td>
                            </tr>
                        </thead>
                        <tbody>
                                @php
                                    $total=0;
                                @endphp
                            @foreach($order_details as $key => $details)
                                @php
                                    $subtotal = $details->product_price*$details->product_sale_quantity;
                                    $total+=$subtotal;
                                @endphp
                            
                            <tr>
                                <td class="cart_product">
                                    {{-- <img src="{{asset('public/uploads/product/'.$details->product_image)}}" width="50"> --}}
                                </td>
                                <td class="cart_description">
                                    <h4><a href="{{url('/product-details/'.$details->product_id)}}">{{$details->product_name}}</a></h4>
                                </td>
                                <td class="cart_price">
                                    <h4>{{number_format($details->product_price,'0',',','.').'đ'}}</h4>
                                </td>
                                <td class="cart_quantity text-center" style="font-size: 16px;">{{$details->product_sale_quantity}}</td>
                                <td class="cart_total">
                                    <h6 class="cart_total_price">
                                        {{number_format($subtotal,'0',',','.').'đ'}}
                                    </h6>
                                </td>
                            </tr>
                            @endforeach
                            <tr>
                                <td colspan="5">
                                    <ul class="pull-right price_items">
                                        <li class="price_item">
                                          <span class="price_text">Tổng tiền hàng:</span>
                                          <span class="price_value">{{number_format($total,'0',',','.').'đ'}}</span>
                                        </li>
                                          @php
                                            $total_cp = 0;
                                          @endphp
                                          @if($coupon_type==1)
                                            @php
                                            $total_cp = ($total*$coupon_number)/100;
                                            $aftercp = $total - $total_cp;
                                            @endphp
                                          <li class="price_item">
                                            <span class="price_text">Mã giảm {{$coupon_number}}%: ({{$coupon_value}})</span>
                                            <span class="price_value">-{{number_format($total_cp,'0',',','.').'đ'}}</span>
                                          </li>
                                          @elseif($coupon_type==2)
                                            @php
                                            $total_cp = $coupon_number;
                                            $aftercp = $total - $total_cp;
                                            @endphp
                                          <li class="price_item">
                                            <span class="price_text">Mã giảm: ({{$coupon_value}})</span>
                                            <span class="price_value">{{number_format($coupon_number,'0',',','.').'đ'}}</span>
                                          </li>
                                          @else
                                            @php
                                            $aftercp = $total;
                                            @endphp
                                            <li class="price_item">
                                              <span class="price_text">Mã giảm:</span>
                                              <span class="price_value">{{$coupon_value}}</span>
                                            </li>
                                          @endif
                                          <li class="price_item">
                                            <span class="price_text">Phí vận chuyển:</span>
                                            <span class="price_value">{{number_format($feeship,'0',',','.').'đ'}}</span>
                                          </li>
                                          <li class="price_item">
                                            <span class="price_text_final">Thành tiền:</span>
                                            <span class="price_value_final">{{number_format($aftercp+$feeship,'0',',','.').'đ'}}</span>
                                          </li>
                                            @if($status==1 || $status==2 || $status==3)
                                                <a class="btn btn-default cancel_order" href="{{url('cancel-ord/'.$order_id)}}">Hủy đơn hàng</a>
                                            @endif
                                      </ul>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section> <!--/#cart_items-->
@endsection