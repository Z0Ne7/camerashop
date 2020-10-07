@extends ('admin_layout')
@section ('admin_content')
<section class="wrapper2">
<div class="table-agile-info-vieworder">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê mã giảm giá
    </div>
    <div class="table-responsive">
			<?php
                $message = Session::get('message');
                if($message){
                    echo '<span style="color: red; width: 100%; text-align: center; ">'.$message.'</span>';
                    Session::put('message',null);
                }
            ?>
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th>STT</th>
            <th>Mã giảm giá</th>
            <th>Thông tin chi tiết</th>
            <th>Số lần sử dụng</th>
            {{-- <th>Loại mã</th> --}}
            <th>Loại mã</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
                @php
                    $i=0;
                @endphp
            @foreach($coupon as $key => $coupon1)
                @php
                    $i++;
                @endphp
        	
          <tr>
            <td>{{$i}}</td>
            <td>{{($coupon1->coupon_value)}}</td>
            <td>{{($coupon1->coupon_name)}}</td>
            <td>{{($coupon1->coupon_time)}}</td>
            <td><span class="text-ellipsis">
            	<?php
            	if($coupon1->coupon_type==1){
            	?>
            		Giảm {{$coupon1->coupon_number}} %
            	<?php
            	}else{
            	?>
            		Giảm {{number_format($coupon1->coupon_number,'0',',','.').' '.'Đ'}}
            	<?php
            	}
            	?>
            </span></td>
            <td>
                <a href="{{url('/edit-coupon/'.$coupon1->coupon_id)}}">
                    <span class="btn btn-success">Sửa</span>
                </a>
                <a onclick="return confirm('Xóa mã giảm giá?')" href="{{URL::to('/delete-coupon/'.$coupon1->coupon_id)}}" class="active styling-edit" ui-toggle-class="">
                    <span class="btn btn-danger">Xóa</span>
                </a>
            </td>
          </tr>
          	@endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
</section>
@endsection