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
                    </div>
                </div>