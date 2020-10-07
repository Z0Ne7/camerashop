@extends ('admin_layout')
@section ('admin_content')
<script type="text/javascript">
        $(function(){
            $('.status').change(function(){
                $('#formOrderStat').submit();
            })
        });
        $(function(){
            $('.searchorder').change(function(){
                var id = $('.searchorder').val();
                if(id==0){
                  document.getElementById('keyword_submit').type = 'text';
                }else{
                  document.getElementById('keyword_submit').type = 'date';
                }
            })
        });
</script>
<style type="text/css">
  /*.input-sm.form-control{
    width: auto;
  }
  .input-group{
    display: contents !important;
  }*/
  .dateFrom{
    width: 50% !important;
    float: left;
  }
  .dateTo{
    width: 50% !important;
    float: left;
  }
</style>
<section class="wrapper">
  <div class="col-md-12 stats-info stats-last widget-shadow">
    <div class="stats-last-agile">
      <div class="panel-heading1">
        Tất cả đơn hàng
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
        <div class="col-sm-3 m-b-xs">
          <form method="get" id="formOrderStat">
          <select class="input-sm form-control w-sm inline v-middle status" name="status">
            <option {{Request::get('status') == 'all' ? 'selected' : ''}} value="all">Tất cả trạng thái</option>
            <option {{Request::get('status') == 'success' ? 'selected' : ''}} value="success">Đơn hàng đặt thành công</option>
            <option {{Request::get('status') == 'confirmed' ? 'selected' : ''}} value="confirmed">Đơn hàng đã được xác nhận</option>
            <option {{Request::get('status') == 'shipping' ? 'selected' : ''}} value="shipping">Đơn hàng đang được giao</option>
            <option {{Request::get('status') == 'delivered' ? 'selected' : ''}} value="delivered">Đơn hàng đã giao</option>
            <option {{Request::get('status') == 'canceled' ? 'selected' : ''}} value="canceled">Đơn hàng đã bị hủy bởi người dùng</option>
            <option {{Request::get('status') == 'rejected' ? 'selected' : ''}} value="rejected">Đơn hàng đã bị hủy bởi admin</option>
          </select>
          </form>
        </div>
        <div class="col-sm-1"></div>
        <div class="col-sm-3">
          <form action="{{url('/search-order')}}" method="POST" id="formSearchOrder">
            @csrf
            <div class="input-group">
              <input type="text" class="input-sm form-control" name="keyword_submit" id="keyword_submit">
              <span class="input-group-btn">
                <button class="btn btn-sm btn-default" type="submit" ><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form>
        </div>
        <div class="col-sm-1"></div>
        <div class="col-sm-4 pull-right">
          <form action="{{url('/filter-order')}}" method="POST">
            @csrf
              <div class="input-group">
                <input type="date" class="input-sm form-control dateFrom" name="dateFrom">
                <input type="date" class="input-sm form-control dateTo" name="dateTo">
                <span class="input-group-btn">
                  <button class="btn btn-sm btn-default" type="submit" ><i class="fa fa-search"></i></button>
                </span>
              </div>
          </form>
        </div>
    </div>
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
          @foreach($order as $key => $ord)
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
        </tbody>
      </table>
      {{$order->links()}}
    </div>
  </div>
</section>
@endsection