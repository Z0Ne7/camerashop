@extends('admin_layout')
@section('admin_content')
<section class="wrapper">
    <div class="market-updates">
        <div class="container-fluid">
            <style>
                p.title-stats {
                    text-align: center;
                    font-size: 40px;
                    color: #436744;
                }

                #btn-dashboard-filter {
                    margin-top: 5px;
                }

            </style>
            <div class="row">
                <p class="title-stats">Thống kê</p>
                <form autocomplete="off">
                    @csrf
                    <div class="col-md-2">
                        <p>Từ ngày: <input type="text" id="datepicker-from" class="form-control"></p>
                        <input type="button" id="btn-dashboard-filter" class="btn btn-primary btn-sm" value="Lọc">
                    </div>
                    <div class="col-md-2">
                        <p>Đến ngày: <input type="text" id="datepicker-to" class="form-control"></p>
                    </div>
                </form>
                <div class="col-md-12">
                    <div id="chart1" style="height: 300px;"></div>
                </div>
            </div>

        </div>
    </div>
</section>
<!-- <section class="wrapper">
  <div class="market-updates">
      <div class="col-md-4 market-update-gd">
        <div class="market-update-block clr-block-3">
          <div class="col-md-4 market-update-right">
            <i class="fa fa-usd"></i>
          </div>
          <div class="col-md-8 market-update-left">
            <h4>Tổng số tiền thu về</h4>
            <h3>
              {{number_format($total,'0',',','.').'Đ'}}
            </h3>
          </div>
          <div class="clearfix"> </div>
        </div>
      </div>
      <div class="col-md-4 market-update-gd">
        <div class="market-update-block clr-block-4">
          <div class="col-md-4 market-update-right">
            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
          </div>
          <div class="col-md-8 market-update-left">
            <h4>Đơn hàng thành công</h4>
            <h3>{{$count_order}}</h3>
          </div>
          <div class="clearfix"> </div>
        </div>
      </div>
      <div class="col-md-4 market-update-gd">
        <div class="market-update-block clr-block-1">
          <div class="col-md-4 market-update-right">
            <i class="fa fa-users" ></i>
          </div>
          <div class="col-md-8 market-update-left">
          <h4>Người dùng đăng kí</h4>
            <h3>{{$count_user}}</h3>
          </div>
          <div class="clearfix"> </div>
        </div>
      </div>
       <div class="clearfix"> </div>
    </div>
    <div class="col-md-12 stats-info stats-last widget-shadow">
            <div class="stats-last-agile">
              <div class="panel-heading1">
                Đơn hàng mới nhất
                <a href="{{url('manage-order')}}" style="float: right; font-size: 14px; font-style: italic;">Xem tất cả</a>
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
                    <th>Mã đơn hàng</th>
                    <th></th>
                    <th>Trạng thái</th>
                    <th>Thời gian đặt hàng</th>
                    <th>Chức năng</th>
                  </tr>
                </thead>
                <tbody>
                  @php
                    $i=0;
                  @endphp
                  @foreach($order as $key => $ord)
                  @php
                    $i++;
                  @endphp
                    <tr>
                      <td>{{$i}}</td>
                      <td>{{($ord->order_code)}}</td>
                      <td>
                        <a href="{{URL::to('/view-order/'.$ord->order_code)}}" style="color: green; font-size: 16px; text-decoration: underline;">Chi tiết</a>
                      </td>
                      <td>
                        @if($ord->order_status==1)
                          <span class="label label-warning">Đơn hàng đặt thành công</span>
                        @elseif($ord->order_status==0)
                          <span class="label label-danger">Đơn hàng đã bị hủy bởi người dùng</span>
                        @elseif($ord->order_status==2)
                          <span class="label label-info">Đơn hàng đã được xác nhận</span>
                        @elseif($ord->order_status==3)
                          <span class="label label-primary">Đơn hàng đang được giao</span>
                        @elseif($ord->order_status==4)
                          <span class="label label-success">Đơn hàng đã giao</span>
                        @elseif($ord->order_status==5)
                          <span class="label label-danger">Đơn hàng đã bị hủy bởi admin</span>
                        @endif
                        </td>
                      <td>{{($ord->created_at)}}</td>
                      <td>
                        <a href="{{url('/accept-order/'.$ord->order_code)}}">
                          <span class="btn btn-info">Xác nhận</span>
                        </a>
                        <a href="{{url('/ship-order/'.$ord->order_code)}}">
                          <span class="btn btn-primary">Giao hàng</span>
                        </a>
                        <a href="{{url('/complete-order/'.$ord->order_code)}}">
                          <span class="btn btn-success">Hoàn thành</span>
                        </a>
                        <a onclick="return confirm('Hủy đơn hàng?')" href="{{url('/cancel-order/'.$ord->order_code)}}">
                          <span class="btn btn-danger">Hủy đơn</span>
                        </a>
                      </td>
                    </tr>
                    @php
                      if($i==5){
                        break;
                      }
                    @endphp
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
</section> -->
@endsection
