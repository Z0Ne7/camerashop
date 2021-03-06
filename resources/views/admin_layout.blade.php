<!DOCTYPE html>

<head>
    <title>Quản trị viên</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template,
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
    <script type="application/x-javascript">
        addEventListener("load", function() {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
    <!-- bootstrap-css -->
    <link rel="stylesheet" href="{{asset('public/backend/css/bootstrap.min.css')}}">
    <!-- //bootstrap-css -->
    <!-- Custom CSS -->
    <link href="{{asset('public/backend/css/style.css')}}" rel='stylesheet' type='text/css' />
    <link href="{{asset('public/backend/css/style-responsive.css')}}" rel="stylesheet" />
    <!-- font CSS -->
    <link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
    <!-- font-awesome icons -->
    <link rel="stylesheet" href="{{asset('public/backend/css/font.css')}}" type="text/css" />
    <link href="{{asset('public/backend/css/font-awesome.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('public/backend/css/morris.css')}}" type="text/css" />
    <!-- calendar -->
    <link rel="stylesheet" href="{{asset('public/backend/css/monthly.css')}}">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <!-- //calendar -->
    <!-- //font-awesome icons -->
    <script src="{{asset('public/backend/js/jquery2.0.3.min.js')}}"></script>
    <script src="{{asset('public/backend/js/raphael-min.js')}}"></script>
    <script src="{{asset('public/backend/js/morris.js')}}"></script>
</head>

<body>
    <section id="container">
        <!--header start-->
        <header class="header fixed-top clearfix">
            <!--logo start-->
            <div class="brand">
                <a href="{{URL::to('/dashboard')}}" class="logo">
                    Quản lý website
                </a>
                <div class="sidebar-toggle-box">
                    <div class="fa fa-bars"></div>
                </div>
            </div>
            <!--logo end-->

            <div class="top-nav clearfix">
                <!--search & user info start-->
                <ul class="nav pull-right top-menu">
                    {{-- <li>
            <input type="text" class="form-control search" placeholder="Nhập nội dung cần tìm">
        </li> --}}
                    <!-- user login dropdown start-->
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <img alt="" src="{{asset('public/backend/images/2.png')}}">
                            <span class="username">
                                <?php
                                $name = Session::get('admin_name');
                                if ($name) {
                                    echo $name;
                                }

                                ?>
                            </span>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu extended logout">
                            <li><a href="#"><i class="fa fa-file"></i>Hồ sơ</a></li>
                            <li><a href="{{URL::to('/logout')}}"><i class="fa fa-sign-out"></i>Đăng xuất</a></li>
                        </ul>
                    </li>
                    <!-- user login dropdown end -->

                </ul>
                <!--search & user info end-->
            </div>
        </header>
        <!--header end-->
        <!--sidebar start-->
        <aside>
            <div id="sidebar" class="nav-collapse">
                <!-- sidebar menu start-->
                <div class="leftside-navigation">
                    <ul class="sidebar-menu" id="nav-accordion">
                        <li>
                            <a class="active" href="{{URL::to('/dashboard')}}">
                                <i class="fa fa-dashboard"></i>
                                <span>Tổng quan</span>
                            </a>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-shopping-cart"></i>
                                <span>Đơn hàng</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{URl::to('/manage-order')}}">Quản lí đơn hàng</a></li>
                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-product-hunt"></i>
                                <span>Sản phẩm</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{URl::to('/add-product')}}">Thêm sản phẩm</a></li>
                                <li><a href="{{URl::to('/all-product')}}">Liệt kê sản phẩm</a></li>
                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-list"></i>
                                <span>Danh mục sản phẩm</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{URl::to('/add-category-product')}}">Thêm danh mục</a></li>
                                <li><a href="{{URl::to('/all-category-product')}}">Liệt kê danh mục</a></li>
                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-registered"></i>
                                <span>Thương hiệu</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{URl::to('/add-brand-product')}}">Thêm thương hiệu</a></li>
                                <li><a href="{{URl::to('/all-brand-product')}}">Liệt kê thương hiệu</a></li>
                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-gift"></i>
                                <span>Mã giảm giá</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{URl::to('/add-coupon')}}">Thêm mã</a></li>
                                <li><a href="{{URl::to('/list-coupon')}}">Liệt kê mã</a></li>
                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-truck"></i>
                                <span>Vận chuyển</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{URl::to('/shipping-fee')}}">Quản lí phí vận chuyển</a></li>
                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-user"></i>
                                <span>Quản lí người dùng</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{URl::to('/all-user')}}">Liệt kê tài khoản</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <!-- sidebar menu end-->
            </div>
        </aside>
        <!--sidebar end-->
        <!--main content start-->
        <section id="main-content">
            {{-- <section class="wrapper"> --}}
            @yield('admin_content')
            {{-- </section> --}}

        </section>
        <!--main content end-->
    </section>
    <script src="{{asset('public/backend/js/bootstrap.js')}}"></script>
    <script src="{{asset('public/backend/js/jquery.dcjqaccordion.2.7.js')}}"></script>
    <script src="{{asset('public/backend/js/scripts.js')}}"></script>
    <script src="{{asset('public/backend/js/jquery.slimscroll.js')}}"></script>
    <script src="{{asset('public/backend/js/jquery.nicescroll.js')}}"></script>
    <script src="{{asset('public/backend/ckeditor/ckeditor.js')}}"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            fetch_delivery();

            function fetch_delivery() {
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: '{{url(' / list - shipping - fee ')}}',
                    method: 'POST',
                    data: {
                        _token: _token
                    },
                    success: function(data) {
                        $('#load_delivery').html(data);
                    }
                });
            }
            $(document).on('blur', '.feeship_edit', function() {
                var id_feeship = $(this).data('feeship_id');
                var value_feeship = $(this).text();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: '{{url(' / update - shipping - fee ')}}',
                    method: 'POST',
                    data: {
                        id_feeship: id_feeship,
                        value_feeship: value_feeship,
                        _token: _token
                    },
                    success: function(data) {
                        fetch_delivery();
                    }
                });
            });
            $('.add_shippingfee').click(function() {
                var city = $('.city').val();
                var province = $('.province').val();
                var ward = $('.ward').val();
                var shippingfee = $('.shippingfee').val();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: '{{url(' / add - shipping - fee ')}}',
                    method: 'POST',
                    data: {
                        city: city,
                        province: province,
                        ward: ward,
                        shippingfee: shippingfee,
                        _token: _token
                    },
                    success: function(data) {
                        fetch_delivery();
                    }
                });
            });
            $('.choose').on('change', function() {
                var action = $(this).attr('id');
                var ma_id = $(this).val();
                var _token = $('input[name="_token"]').val();
                var result = '';
                if (action == 'city') {
                    result = 'province'
                } else {
                    result = 'ward';
                }
                $.ajax({
                    url: '{{url(' / select - location ')}}',
                    method: 'POST',
                    data: {
                        action: action,
                        ma_id: ma_id,
                        _token: _token
                    },
                    success: function(data) {
                        $('#' + result).html(data);
                    }
                });
            });
        })
    </script>
    <script>
        CKEDITOR.replace('ckeditor');
    </script>
    <!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
    <script src="{{asset('public/backend/js/jquery.scrollTo.js')}}"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <!-- morris JavaScript -->
    <script type="text/javascript">
        $(function() {
            $("#datepicker-from").datepicker({
                dateFormat: "yy-mm-dd"
            })
            $("#datepicker-to").datepicker({
                dateFormat: "yy-mm-dd"
            })
        })
    </script>
    <script>
        $(document).ready(function() {
            getStatsOnLoad();
            getBestSoldProductOnLoad();
            //BOX BUTTON SHOW AND CLOSE
            jQuery('.small-graph-box').hover(function() {
                jQuery(this).find('.box-button').fadeIn('fast');
            }, function() {
                jQuery(this).find('.box-button').fadeOut('fast');
            });
            jQuery('.small-graph-box .box-close').click(function() {
                jQuery(this).closest('.small-graph-box').fadeOut(200);
                return false;
            });

            //CHARTS
            function gd(year, day, month) {
                return new Date(year, month - 1, day).getTime();
            }

            graphArea2 = Morris.Area({
                element: 'hero-area',
                padding: 10,
                behaveLikeLine: true,
                gridEnabled: false,
                gridLineColor: '#dddddd',
                axes: true,
                resize: true,
                smooth: true,
                pointSize: 0,
                lineWidth: 0,
                fillOpacity: 0.85,
                data: [{
                        period: '2015 Q1',
                        iphone: 2668,
                        ipad: null,
                        itouch: 2649
                    },
                    {
                        period: '2015 Q2',
                        iphone: 15780,
                        ipad: 13799,
                        itouch: 12051
                    },
                    {
                        period: '2015 Q3',
                        iphone: 12920,
                        ipad: 10975,
                        itouch: 9910
                    },
                    {
                        period: '2015 Q4',
                        iphone: 8770,
                        ipad: 6600,
                        itouch: 6695
                    },
                    {
                        period: '2016 Q1',
                        iphone: 10820,
                        ipad: 10924,
                        itouch: 12300
                    },
                    {
                        period: '2016 Q2',
                        iphone: 9680,
                        ipad: 9010,
                        itouch: 7891
                    },
                    {
                        period: '2016 Q3',
                        iphone: 4830,
                        ipad: 3805,
                        itouch: 1598
                    },
                    {
                        period: '2016 Q4',
                        iphone: 15083,
                        ipad: 8977,
                        itouch: 5185
                    },
                    {
                        period: '2017 Q1',
                        iphone: 10697,
                        ipad: 4470,
                        itouch: 2038
                    },

                ],
                lineColors: ['#eb6f6f', '#926383', '#eb6f6f'],
                xkey: 'period',
                redraw: true,
                ykeys: ['iphone', 'ipad', 'itouch'],
                labels: ['All Visitors', 'Returning Visitors', 'Unique Visitors'],
                pointSize: 2,
                hideHover: 'auto',
                resize: true
            });


        });

        function getStatsOnLoad() {
            var _token = $("input[name='_token']").val();
            $.ajax({
                url: "{{url('/get-stats-on-load')}}",
                method: "POST",
                dataType: "JSON",
                data: {
                    _token: _token,
                },
                success: function(data) {
                    chart.setData(data);
                    chart2.setData(data);
                }
            })
        }
        function getBestSoldProductOnLoad() {
            var _token = $("input[name='_token']").val();
            $.ajax({
                url: "{{url('/get-best-product-on-load')}}",
                method: "POST",
                dataType: "JSON",
                data: {
                    _token: _token,
                },
                success: function(data) {
                    chart3.setData(data);
                }
            })
        }
        $(".dashboard-filter").change(function() {
            var dashboardValue = $(this).val();
            var _token = $("input[name='_token']").val();
            $.ajax({
                url: "{{url('/dashboard-filter')}}",
                method: "POST",
                dataType: "JSON",
                data: {
                    dashboardValue: dashboardValue,
                    _token: _token
                },
                success: function(data) {
                    chart.setData(data);
                    chart2.setData(data);
                }
            })
        })
        $("#btn-dashboard-filter").click(function() {
            var _token = $("input[name='_token']").val();
            var dateFrom = $("#datepicker-from").val();
            var dateTo = $("#datepicker-to ").val();
            $.ajax({
                url: "{{url('/filter-by-date')}}",
                method: "POST",
                dataType: "JSON",
                data: {
                    dateFrom: dateFrom,
                    dateTo: dateTo,
                    _token: _token
                },
                success: function(data) {
                    chart.setData(data);
                    chart2.setData(data);
                }
            })
        });
        var chart = Morris.Area({
            element: 'chart1',
            barColors: ['#00acee', '#ff8040', '#eeae02', '#c8e9b8'],
            lineColors: ['#00acee', '#ff8040', '#eeae02', '#c8e9b8'],
            parseTime: false,
            hideHover: 'auto',
            data: [],
            xkey: 'period',
            ykeys: ['order', 'sales', 'quantity'],
            labels: ['Đơn hàng', 'Doanh số', 'Số lượng']
        });
        var chart2 = Morris.Area({
            lineColors: ['#00acee', '#ff8040', '#eeae02', '#c8e9b8'],
            element: 'chart2',
            parseTime: false,
            data: [],
            xkey: 'period',
            ykeys: ['order'],
            labels: ['Đơn hàng']
        });
        // var day_data = [{
        //         "period": "2016-10-01",
        //         "licensed": 3407,
        //         "sorned": 660
        //     },
        //     {
        //         "period": "2016-09-30",
        //         "licensed": 3351,
        //         "sorned": 629
        //     },
        //     {
        //         "period": "2016-09-29",
        //         "licensed": 3269,
        //         "sorned": 618
        //     },
        //     {
        //         "period": "2016-09-20",
        //         "licensed": 3246,
        //         "sorned": 661
        //     },
        //     {
        //         "period": "2016-09-19",
        //         "licensed": 3257,
        //         "sorned": 667
        //     },
        //     {
        //         "period": "2016-09-18",
        //         "licensed": 3248,
        //         "sorned": 627
        //     },
        //     {
        //         "period": "2016-09-17",
        //         "licensed": 3171,
        //         "sorned": 660
        //     },
        //     {
        //         "period": "2016-09-16",
        //         "licensed": 3171,
        //         "sorned": 676
        //     },
        //     {
        //         "period": "2016-09-15",
        //         "licensed": 3201,
        //         "sorned": 656
        //     },
        //     {
        //         "period": "2016-09-10",
        //         "licensed": 3215,
        //         "sorned": 622
        //     }
        // ];
        var chart3 = Morris.Bar({
            element: 'chart3',
            data: [],
            xkey: 'period',
            ykeys: ['quantity'],
            labels: ['Sản phẩm đã bán'],
            xLabelAngle: 60
        });
    </script>
    <!-- calendar -->
    <script type="text/javascript" src="{{asset('public/backend/js/monthly.js')}}"></script>
    <script type="text/javascript">
        $(window).load(function() {

            $('#mycalendar').monthly({
                mode: 'event',

            });

            $('#mycalendar2').monthly({
                mode: 'picker',
                target: '#mytarget',
                setWidth: '250px',
                startHidden: true,
                showTrigger: '#mytarget',
                stylePast: true,
                disablePast: true
            });

            switch (window.location.protocol) {
                case 'http:':
                case 'https:':
                    // running on a server, should be good.
                    break;
                case 'file:':
                    alert('Just a heads-up, events will not work when run locally.');
            }

        });
    </script>
    <!-- //calendar -->
</body>

</html>
