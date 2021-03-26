@extends('admin_layout')
@section('admin_content')
    <section class="wrapper">
        <!-- //market-->
        <div class="market-updates">
            <input type="hidden" value="{{ csrf_token() }}" name="_token">
            <div class="col-md-3 market-update-gd">
                <div class="market-update-block clr-block-2">
                    <div class="col-md-4 market-update-right">
                        <i class="fa fa-usd"> </i>
                    </div>
                    <div class="col-md-8 market-update-left">
                        <h4>Tổng số tiền thu về</h4>
                        <h3>{{number_format($total,'0',',','.').'Đ'}}</h3>
                    </div>
                    <div class="clearfix"> </div>
                </div>
            </div>
            <div class="col-md-3 market-update-gd">
                <div class="market-update-block clr-block-1">
                    <div class="col-md-4 market-update-right">
                        <i class="fa fa-shopping-cart"></i>
                    </div>
                    <div class="col-md-8 market-update-left">
                        <h4>Đơn hàng</h4>
                        <h3>{{$count_order}}</h3>
                    </div>
                    <div class="clearfix"> </div>
                </div>
            </div>
            <div class="col-md-3 market-update-gd">
                <div class="market-update-block clr-block-3">
                    <div class="col-md-4 market-update-right">
                        <i class="fa fa-users"></i>
                    </div>
                    <div class="col-md-8 market-update-left">
                        <h4>Người dùng đăng kí</h4>
                        <h3>{{$count_user}}</h3>
                    </div>
                    <div class="clearfix"> </div>
                </div>
            </div>
            <div class="col-md-3 market-update-gd">
                <div class="market-update-block clr-block-4">
                    <div class="col-md-4 market-update-right">
                        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                    </div>
                    <div class="col-md-8 market-update-left">
                        <h4>Đã bán</h4>
                        <h3>{{$sold_product}}</h3>
                    </div>
                    <div class="clearfix"> </div>
                </div>
            </div>
            <div class="clearfix"> </div>
        </div>
        <!-- //market-->
        <div class="row">
            <div class="panel-body">
            <form autocomplete="off">
                    @csrf
                    <div class="col-md-2">
                        <p>Từ ngày: <input type="text" id="datepicker-from" class="form-control"></p>
                        <button type="button" id="btn-dashboard-filter" class="btn btn-primary btn-sm">Lọc</button>
                    </div>
                    <div class="col-md-2">
                        <p>Đến ngày: <input type="text" id="datepicker-to" class="form-control"></p>
                    </div>
                    <div class="col-md-6"></div>
                    <div class="col-md-2 float-right">
                        <p>Thời gian:
                            <select class="dashboard-filter form-control">
                                <option value="lastWeek">Tuần qua</option>
                                <option value="lastMonth">Tháng trước</option>
                                <option value="thisMonth">Tháng này</option>
                                <option value="lastYear">Năm qua</option>
                            </select>
                        </p>
                    </div>
                </form>
                <div class="col-md-12 w3ls-graph">
                    <!--agileinfo-grap-->
                    <div class="agileinfo-grap">
                        <div class="agileits-box">
                            <header class="agileits-box-header clearfix">
                                <h3>Thống kê</h3>
                                <div class="toolbar">
                                </div>
                            </header>
                            <div class="agileits-box-body clearfix">
                                <div id="chart1"></div>
                            </div>
                        </div>
                    </div>
                    <!--//agileinfo-grap-->

                </div>
            </div>
        </div>

        <!-- tasks -->
        <div class="agile-last-grids">
            <div class="col-md-4 agile-last-left">
                <div class="agile-last-grid">
                    <div class="area-grids-heading">
                        <h3>Monthly</h3>
                    </div>
                    <div id="graph7"></div>
                    <script>
                        // This crosses a DST boundary in the UK.
                        Morris.Area({
                            element: 'graph7',
                            data: [{
                                    x: '2013-03-30 22:00:00',
                                    y: 3,
                                    z: 3
                                },
                                {
                                    x: '2013-03-31 00:00:00',
                                    y: 2,
                                    z: 0
                                },
                                {
                                    x: '2013-03-31 02:00:00',
                                    y: 0,
                                    z: 2
                                },
                                {
                                    x: '2013-03-31 04:00:00',
                                    y: 4,
                                    z: 4
                                }
                            ],
                            xkey: 'x',
                            ykeys: ['y', 'z'],
                            labels: ['Y', 'Z']
                        });
                    </script>

                </div>
            </div>
            <div class="col-md-4 agile-last-left agile-last-middle">
                <div class="agile-last-grid">
                    <div class="area-grids-heading">
                        <h3>Daily</h3>
                    </div>
                    <div id="graph8"></div>
                    <script>
                        /* data stolen from http://howmanyleft.co.uk/vehicle/jaguar_'e'_type */
                        var day_data = [{
                                "period": "2016-10-01",
                                "licensed": 3407,
                                "sorned": 660
                            },
                            {
                                "period": "2016-09-30",
                                "licensed": 3351,
                                "sorned": 629
                            },
                            {
                                "period": "2016-09-29",
                                "licensed": 3269,
                                "sorned": 618
                            },
                            {
                                "period": "2016-09-20",
                                "licensed": 3246,
                                "sorned": 661
                            },
                            {
                                "period": "2016-09-19",
                                "licensed": 3257,
                                "sorned": 667
                            },
                            {
                                "period": "2016-09-18",
                                "licensed": 3248,
                                "sorned": 627
                            },
                            {
                                "period": "2016-09-17",
                                "licensed": 3171,
                                "sorned": 660
                            },
                            {
                                "period": "2016-09-16",
                                "licensed": 3171,
                                "sorned": 676
                            },
                            {
                                "period": "2016-09-15",
                                "licensed": 3201,
                                "sorned": 656
                            },
                            {
                                "period": "2016-09-10",
                                "licensed": 3215,
                                "sorned": 622
                            }
                        ];
                        Morris.Bar({
                            element: 'graph8',
                            data: day_data,
                            xkey: 'period',
                            ykeys: ['licensed', 'sorned'],
                            labels: ['Licensed', 'SORN'],
                            xLabelAngle: 60
                        });
                    </script>
                </div>
            </div>
            <div class="col-md-4 agile-last-left agile-last-right">
                <div class="agile-last-grid">
                    <div class="area-grids-heading">
                        <h3>Yearly</h3>
                    </div>
                    <div id="graph9"></div>
                    <script>
                        var day_data = [{
                                "elapsed": "I",
                                "value": 34
                            },
                            {
                                "elapsed": "II",
                                "value": 24
                            },
                            {
                                "elapsed": "III",
                                "value": 3
                            },
                            {
                                "elapsed": "IV",
                                "value": 12
                            },
                            {
                                "elapsed": "V",
                                "value": 13
                            },
                            {
                                "elapsed": "VI",
                                "value": 22
                            },
                            {
                                "elapsed": "VII",
                                "value": 5
                            },
                            {
                                "elapsed": "VIII",
                                "value": 26
                            },
                            {
                                "elapsed": "IX",
                                "value": 12
                            },
                            {
                                "elapsed": "X",
                                "value": 19
                            }
                        ];
                        Morris.Line({
                            element: 'graph9',
                            data: day_data,
                            xkey: 'elapsed',
                            ykeys: ['value'],
                            labels: ['value'],
                            parseTime: false
                        });
                    </script>

                </div>
            </div>
            <div class="clearfix"> </div>
        </div>
        <!-- //tasks -->
        <div class="agileits-w3layouts-stats">
            <div class="col-md-4 stats-info widget">
                <div class="stats-info-agileits">
                    <div class="stats-title">
                        <h4 class="title">Browser Stats</h4>
                    </div>
                    <div class="stats-body">
                        <ul class="list-unstyled">
                            <li>GoogleChrome <span class="pull-right">85%</span>
                                <div class="progress progress-striped active progress-right">
                                    <div class="bar green" style="width:85%;"></div>
                                </div>
                            </li>
                            <li>Firefox <span class="pull-right">35%</span>
                                <div class="progress progress-striped active progress-right">
                                    <div class="bar yellow" style="width:35%;"></div>
                                </div>
                            </li>
                            <li>Internet Explorer <span class="pull-right">78%</span>
                                <div class="progress progress-striped active progress-right">
                                    <div class="bar red" style="width:78%;"></div>
                                </div>
                            </li>
                            <li>Safari <span class="pull-right">50%</span>
                                <div class="progress progress-striped active progress-right">
                                    <div class="bar blue" style="width:50%;"></div>
                                </div>
                            </li>
                            <li>Opera <span class="pull-right">80%</span>
                                <div class="progress progress-striped active progress-right">
                                    <div class="bar light-blue" style="width:80%;"></div>
                                </div>
                            </li>
                            <li class="last">Others <span class="pull-right">60%</span>
                                <div class="progress progress-striped active progress-right">
                                    <div class="bar orange" style="width:60%;"></div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-8 stats-info stats-last widget-shadow">
                <div class="stats-last-agile">
                    <table class="table stats-table ">
                        <thead>
                            <tr>
                                <th>S.NO</th>
                                <th>PRODUCT</th>
                                <th>STATUS</th>
                                <th>PROGRESS</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Lorem ipsum</td>
                                <td><span class="label label-success">In progress</span></td>
                                <td>
                                    <h5>85% <i class="fa fa-level-up"></i></h5>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>Aliquam</td>
                                <td><span class="label label-warning">New</span></td>
                                <td>
                                    <h5>35% <i class="fa fa-level-up"></i></h5>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td>Lorem ipsum</td>
                                <td><span class="label label-danger">Overdue</span></td>
                                <td>
                                    <h5 class="down">40% <i class="fa fa-level-down"></i></h5>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">4</th>
                                <td>Aliquam</td>
                                <td><span class="label label-info">Out of stock</span></td>
                                <td>
                                    <h5>100% <i class="fa fa-level-up"></i></h5>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">5</th>
                                <td>Lorem ipsum</td>
                                <td><span class="label label-success">In progress</span></td>
                                <td>
                                    <h5 class="down">10% <i class="fa fa-level-down"></i></h5>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">6</th>
                                <td>Aliquam</td>
                                <td><span class="label label-warning">New</span></td>
                                <td>
                                    <h5>38% <i class="fa fa-level-up"></i></h5>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="clearfix"> </div>
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
            <h4>Đơn hàng</h4>
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
                        <button type="button" id="btn-dashboard-filter" class="btn btn-primary btn-sm">Lọc</button>
                    </div>
                    <div class="col-md-2">
                        <p>Đến ngày: <input type="text" id="datepicker-to" class="form-control"></p>
                    </div>
                    <div class="col-md-6"></div>
                    <div class="col-md-2 float-right">
                        <p>Thời gian:
                            <select class="dashboard-filter form-control">
                                <option value="lastWeek">Tuần qua</option>
                                <option value="lastMonth">Tháng trước</option>
                                <option value="thisMonth">Tháng này</option>
                                <option value="lastYear">Năm qua</option>
                                <option value="all">Toàn bộ</option>
                            </select>
                        </p>
                    </div>
                </form>
                <div class="col-md-12">
                    <div id="chart1" style="height: 300px;"></div>
                </div>
            </div>

        </div>
    </div>
</section> -->
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
