@extends('pages/layout/layout_cart')
@section('content')             
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
              <li><a href="{{URL::to('/')}}">Trang chủ</a></li>
              <li class="active">Đơn hàng</li>
            </ol>
        </div>
        <div class="table-responsive cart_info">
            @if(session()->has('message'))
                <a href="javascript:window.location.reload();"><div class="alert alert-success">
                    {{ session()->get('message') }}
                </div></a>
            @elseif(session()->has('errmsg'))
                <a href="javascript:window.location.reload();"><div class="alert alert-danger">
                    {{ session()->get('errmsg') }}
                </div></a>
            @endif
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td>STT</td>
                        <td class="description">Mã đơn hàng</td>
                        <td class="price">Trạng thái</td>
                        <td class="quantity">Thời gian đặt</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    @if($count_order>0)
                    @foreach($order as $key => $orders)
                    <tr>
                        <td class="cart_product">
                            {{$key+1}}
                        </td>
                        <td class="cart_description">
                            <h4><a href="{{url('order-details/'.$orders->order_code)}}">{{$orders->order_code}}</a></h4>
                        </td>
                        <td class="cart_price">
                            <h4>
                                @if($orders->order_status==1)
                                    <span class="label label-warning">Đang chờ xác nhận</span>
                                @elseif($orders->order_status==0)
                                    <span class="label label-danger">Đơn hàng đã bị hủy bởi bạn</span>
                                @elseif($orders->order_status==2)
                                    <span class="label label-info">Đơn hàng đã được xác nhận</span>
                                @elseif($orders->order_status==3)
                                    <span class="label label-primary">Đơn hàng đang được giao</span>
                                @elseif($orders->order_status==4)
                                    <span class="label label-success">Đơn hàng đã giao</span>
                                @elseif($orders->order_status==5)
                                    <span class="label label-danger">Đơn hàng đã bị hủy bởi người bán</span>
                                @endif
                            </h4>
                        </td>
                        <td class="cart_quantity">{{$orders->created_at}}</td>
                        <td>
                            <a href="{{url('order-details/'.$orders->order_code)}}" style="color: green;">Chi tiết</a>
                        </td>
                    </tr>
                    @endforeach
                    @else
                    <tr><td colspan="5">
                        <center><b style="font-size: 16px">
                        @php
                            echo 'Chưa có đơn hàng';
                        @endphp
                        </b>
                        <a class="btn btn-success" href="{{URL::to('/')}}">Mua ngay</a>

                        </center>
                        <div style="margin-bottom: 50px"></div>
                        </td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
   </section> <!--/#cart_items-->
@endsection