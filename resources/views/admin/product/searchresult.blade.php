@extends ('admin_layout')
@section ('admin_content')
<section class="wrapper">
<div class="table-agile-info-vieworder">
  <div class="panel panel-default">
    <div class="panel-heading">
      Kết quả tìm kiếm cho từ khóa: "{{$keyword}}"
    </div>
    <div class="row w3-res-tb">
      <form action="{{url('/search-product')}}" method="POST">
        @csrf
      <div class="col-sm-3 pull-right">
        <div class="input-group">
          <input type="text" class="input-sm form-control" name="keyword_submit">
          <span class="input-group-btn">
            <button class="btn btn-sm btn-default" type="submit" ><i class="fa fa-search"></i></button>
          </span>
        </div>
      </div>
      </form>
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
            <th>Hình ảnh</th>
            <th>Tên sản phẩm</th>
            <th>Giá</th>
            <th>Kho hàng</th>
            <th>Đã bán</th>
            <th>Danh mục</th>
            <th>Thương hiệu</th>
            <th>Trạng thái</th>
            <th>Chức năng</th>
          </tr>
        </thead>
        <tbody>
          @foreach($search_product as $key => $pro)
          <tr>
            <td>{{$key+1}}</td>
            <td><img src="public/uploads/product/{{($pro->product_image)}}" class="imgpro"></td>
            <td>{{($pro->product_name)}}</td>
            <td>{{number_format($pro->product_price,'0',',','.').' '.'Đ'}}</td>
            <td>
              @if($pro->product_stock==0)
              Hết hàng
              @else
              {{($pro->product_stock)}}
              @endif
            </td>
            <td>
              @if($pro->product_sold==0)
              0
              @else
              {{($pro->product_sold)}}
              @endif
            </td>
            <td>{{($pro->category_name)}}</td>
            <td>{{($pro->brand_name)}}</td>

            <td><span class="text-ellipsis">
              <?php
              if($pro->product_status==0){
              ?>
                <a href="{{URL::to('/active-product/'.$pro->product_id)}}"><span class="btn btn-danger" style="width: 55px">Ẩn</span></a>
              <?php
              }else{
              ?>
                <a href="{{URL::to('/inactive-product/'.$pro->product_id)}}"><span class="btn btn-primary" style="width: 55px">Hiện</span></a>
              <?php
              }
              ?>
            </span></td>
            <td>
              <a href="{{URL::to('/edit-product/'.$pro->product_id)}}" class="active styling-edit" ui-toggle-class="">
                <span class="btn btn-success">Sửa</span></a>
              <a onclick="return confirm('Bạn có chắc muốn xóa sản phẩm?')" href="{{URL::to('/delete-product/'.$pro->product_id)}}" class="active styling-edit" ui-toggle-class="">
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
