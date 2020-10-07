@extends ('admin_layout')
@section ('admin_content')
<style type="text/css">
  .title_product{
    font-size: 15px;
    color: #555555;
  }
</style>
<section class="wrapper">
  <div class="col-md-12 orderview">
              <div class="col-md-6">
                <div class="ship_info">
                  <div class="ship_title">
                    <span>Thông tin khách hàng</span>
                  </div>
                  @foreach($order as $shipping)
                  <div class="ship_add">
                    <span class="ship_name">{{$customer->customer_name}}</span>
                    <span class="ship_phone">Số điện thoại: {{$customer->customer_phone}}</span>
                    <span class="ship_street">Email: {{$customer->customer_email}}</span>
                    <span class="ship_street">&nbsp</span>
                  </div>
                  @endforeach
                </div>
              </div>
              <div class="col-md-6">
                <div class="ship_info">
                        <div class="ship_title">
                          <span>Thông tin giao hàng</span>
                        </div>
                        @foreach($order as $shipping)
                        <div class="ship_add">
                          <span class="ship_name">{{$shipping->order_shipping_name}}</span>
                          <span class="ship_phone">Số điện thoại: {{$shipping->order_shipping_phone}}</span>
                          <span class="ship_street">Địa chỉ: {{$shipping->order_shipping_address}}, {{$ward->nameWard}}, {{$province->nameProvince}}, {{$city->nameCity}}</span>
                          <span class="ship_street">Hình thức thanh toán: 
                            @if($shipping->order_payment==0)
                              Chuyển khoản
                            @else
                              Tiền mặt
                            @endif
                          </span>
                        </div>
                        @endforeach
                      </div>
              </div>
          </div>
  <div class="col-md-12 stats-info stats-last widget-shadow">
            <div class="stats-last-agile">
              <div class="panel-heading1">
                Chi tiết đơn hàng
                <p>
                @foreach($order as $status)
                  @if($status->order_status==1)
                    <span class="label label-warning">Đơn hàng đặt thành công</span>
                  @elseif($status->order_status==0)
                    <span class="label label-danger">Đơn hàng đã bị hủy bởi người dùng</span>
                  @elseif($status->order_status==2)
                    <span class="label label-info">Đơn hàng đã được xác nhận</span>
                  @elseif($status->order_status==3)
                    <span class="label label-primary">Đơn hàng đang được giao</span>
                  @elseif($status->order_status==4)
                    <span class="label label-success">Đơn hàng đã giao</span>
                  @elseif($status->order_status==5)
                    <span class="label label-danger">Đơn hàng đã bị hủy bởi admin</span>
                  @endif
                  @php
                    $get_status = $status->order_status;
                  @endphp
                @endforeach
              </p>
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
              <table class="table stats-table ">
                <thead>
                  <tr>
                    <th>STT</th>
                    <th>Tên sản phẩm</th>
                    <th style="width: 100px">Số lượng</th>
                    <th>Kho hàng</th>
                    <th>Đơn giá</th>
                    <th>Tổng tiền</th>
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
                    <td>{{$key+1}}</td>
                    <td><a class='title_product' href="{{url('edit-product/'.$details->product_id)}}">{{$details->product_name}}</a></td>
                    <td>{{$details->product_sale_quantity}}</td>
                    <td>{{$details->product->product_stock}}</td>
                    <td>{{number_format($details->product_price,'0',',','.').' '.'Đ'}}</td>
                    <td>{{number_format($subtotal,'0',',','.').' '.'Đ'}}</td>
                  </tr>
                  @endforeach
                  <tr>
                    <td colspan="6">
                      <ul class="pull-right price_items">
                        <li class="price_item">
                          <span class="price_text">Tổng tiền hàng:</span>
                          <span class="price_value">{{number_format($total,'0',',','.').' '.'Đ'}}</span>
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
                            <span class="price_text">Mã giảm {{$coupon_number}}%:</span>
                            <span class="price_value">-{{number_format($total_cp,'0',',','.').' '.'Đ'}}</span>
                          </li>
                          @elseif($coupon_type==2)
                            @php
                            $total_cp = $coupon_number;
                            $aftercp = $total - $total_cp;
                            @endphp
                          <li class="price_item">
                            <span class="price_text">Mã giảm:</span>
                            <span class="price_value">{{number_format($coupon_number,'0',',','.').' '.'Đ'}}</span>
                          </li>
                          @else
                            @php
                            $aftercp = $total;
                            @endphp
                            <li class="price_item">
                              <span class="price_text">Mã giảm:</span>
                              <span class="price_value">Không có</span>
                            </li>
                          @endif
                          <li class="price_item">
                            <span class="price_text">Phí vận chuyển:</span>
                            <span class="price_value">{{number_format($feeship,'0',',','.').' '.'Đ'}}</span>
                          </li>
                          <li class="price_item">
                            <span class="price_text_final">Thành tiền:</span>
                            <span class="price_value_final">{{number_format($aftercp+$feeship,'0',',','.').' '.'Đ'}}</span>
                          </li>
                      </ul>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="6">
                      @foreach($order as $code)
                      <center>
                        @if($get_status==1)
                          <a href="{{url('/accept-order/'.$code->order_code)}}">
                            <span class="btn btn-info">Xác nhận</span>
                          </a>
                          <a href="{{url('/ship-order/'.$code->order_code)}}">
                            <span class="btn btn-primary">Giao hàng</span>
                          </a>
                          <a href="{{url('/complete-order/'.$code->order_code)}}">
                            <span class="btn btn-success">Hoàn thành</span>
                          </a>
                          <a onclick="return confirm('Hủy đơn hàng?')" href="{{url('/cancel-order/'.$code->order_code)}}">
                            <span class="btn btn-danger">Hủy đơn</span>
                          </a>
                        @elseif($get_status==2)
                          <a href="{{url('/ship-order/'.$code->order_code)}}">
                            <span class="btn btn-primary">Giao hàng</span>
                          </a>
                          <a href="{{url('/complete-order/'.$code->order_code)}}">
                            <span class="btn btn-success">Hoàn thành</span>
                          </a>
                          <a onclick="return confirm('Hủy đơn hàng?')" href="{{url('/cancel-order/'.$code->order_code)}}">
                            <span class="btn btn-danger">Hủy đơn</span>
                          </a>
                        @elseif($get_status==3)
                          <a href="{{url('/complete-order/'.$code->order_code)}}">
                            <span class="btn btn-success">Hoàn thành</span>
                          </a>
                          <a onclick="return confirm('Hủy đơn hàng?')" href="{{url('/cancel-order/'.$code->order_code)}}">
                            <span class="btn btn-danger">Hủy đơn</span>
                          </a>
                        @endif
                      </center>
                      <center style="margin-top: 10px;"><a class="price_items" target="_blank" href="{{url('/print-receipt/'.$code->order_code)}}"><i class="fa fa-print"></i>In hóa đơn</a></center>
                      @endforeach
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
</section>
@endsection
