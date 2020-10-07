@extends ('admin_layout')
@section ('admin_content')
<section class="wrapper">
  <div class="col-md-12 stats-info stats-last widget-shadow">
    <div class="stats-last-agile">
      <div class="panel-heading1">
        Kết quả tìm kiếm cho từ khóa "{{$keyword}}"
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
          @foreach($search_order as $key => $ord)
            @php
            $i++;
            @endphp
            <tr>
              <td>{{$key+1}}</td>
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
              <td>{{date('d/m/Y', strtotime($ord->created_at))}}</td>
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
          @endforeach
          @foreach($orders as $order)
          @foreach($details_order as $details)
          @if($order->order_code==$details->order_code)
            @php
            $i++;
            @endphp
            <tr>
              <td>{{$i}}</td>
              <td>{{($order->order_code)}}</td>
              <td>
                <a href="{{URL::to('/view-order/'.$order->order_code)}}" style="color: green; font-size: 16px; text-decoration: underline;">Chi tiết</a>
              </td>
              <td>
                @if($order->order_status==1)
                  <span class="label label-warning">Đơn hàng đặt thành công</span>
                @elseif($order->order_status==0)
                  <span class="label label-danger">Đơn hàng đã bị hủy bởi người dùng</span>
                @elseif($order->order_status==2)
                  <span class="label label-info">Đơn hàng đã được xác nhận</span>
                @elseif($order->order_status==3)
                  <span class="label label-primary">Đơn hàng đang được giao</span>
                @elseif($order->order_status==4)
                  <span class="label label-success">Đơn hàng đã giao</span>
                @elseif($order->order_status==5)
                  <span class="label label-danger">Đơn hàng đã bị hủy bởi admin</span>
                @endif
                </td>
              <td>{{date('d/m/Y', strtotime($order->created_at))}}</td>
              <td>
                <a href="{{url('/accept-order/'.$order->order_code)}}">
                  <span class="btn btn-info">Xác nhận</span>
                </a>
                <a href="{{url('/ship-order/'.$order->order_code)}}">
                  <span class="btn btn-primary">Giao hàng</span>
                </a>
                <a href="{{url('/complete-order/'.$order->order_code)}}">
                  <span class="btn btn-success">Hoàn thành</span>
                </a>
                <a onclick="return confirm('Hủy đơn hàng?')" href="{{url('/cancel-order/'.$order->order_code)}}">
                  <span class="btn btn-danger">Hủy đơn</span>
                </a>
              </td>
            </tr>
            @endif
          @endforeach
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</section>
@endsection