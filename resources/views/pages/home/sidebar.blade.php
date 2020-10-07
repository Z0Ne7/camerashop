<div class="col-sm-3">
    <div class="left-sidebar">
        <h2><i class="fa fa-bars"></i> Danh mục</h2>
        <div class="brands-name" style="margin-bottom: 35px">
                <ul class="nav nav-pills nav-stacked">
                    @foreach($category as $key => $cate)
                    <li><a href="{{URL::to('/categories/'.$cate->category_id)}}" style="text-transform: uppercase;">{{$cate->category_name}}</a></li>
                    @endforeach
                </ul>
        </div>

        <div class="brands_products"><!--brands_products-->
            <h2><i class="fa fa-bars"></i> Thương hiệu</h2>
            <div class="brands-name">
                <ul class="nav nav-pills nav-stacked">
                    @foreach($brand as $key => $brand)
                    <li><a href="{{URL::to('/brands/'.$brand->brand_id)}}">{{$brand->brand_name}}</a></li>
                    @endforeach
                </ul>
            </div>
        </div><!--/brands_products-->
        <div class="price-range"><!--price-range-->
            <h2><i class="fa fa-bars"></i> Khoảng giá</h2>
            <div class="brands-name">
                 <ul class="nav nav-pills nav-stacked">
                    <li><a class="{{Request::get('p') == 'duoi-500' ? 'active' : ''}}" href="{{request()->fullUrlWithQuery(['p' => 'duoi-500'])}}">Dưới 500.000đ</a></li>
                    <li><a class="{{Request::get('p') == '500-1trieu' ? 'active' : ''}}" href="{{request()->fullUrlWithQuery(['p' => '500-1trieu'])}}">Từ 500.000đ đến 1.000.000đ</a></li>
                    <li><a class="{{Request::get('p') == '1trieu-2trieu' ? 'active' : ''}}" href="{{request()->fullUrlWithQuery(['p' => '1trieu-2trieu'])}}">Từ 1.000.000đ đến 2.000.000đ</a></li>
                    <li><a class="{{Request::get('p') == '2trieu-5trieu' ? 'active' : ''}}" href="{{request()->fullUrlWithQuery(['p' => '2trieu-5trieu'])}}">Từ 2.000.000đ đến 5.000.000đ</a></li>
                    <li><a class="{{Request::get('p') == 'tren-5trieu' ? 'active' : ''}}" href="{{request()->fullUrlWithQuery(['p' => 'tren-5trieu'])}}">Trên 5.000.000đ</a></li>
                </ul>
            </div>
        </div><!--/price-range-->
    </div>
</div>