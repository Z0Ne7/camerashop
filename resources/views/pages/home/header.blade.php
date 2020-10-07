<header id="header"><!--header--> 
        <div class="header-middle"><!--header-middle-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="logo pull-left">
                            <a href="{{URL::to('/')}}"><img style="width: 220px" src="{{asset('public/frontend/images/logo.png')}}" alt="" /></a>
                        </div>                  
                    </div>
                    <div class="col-sm-8">
                        <div class="shop-menu pull-right">
                            <ul class="nav navbar-nav collapse navbar-collapse">
                                <li><a href="{{URL::to('/')}}"><i class="fa fa-home"></i>Trang chủ</a></li>
                                <li><a href="{{URL::to('/cart')}}"><i class="fa fa-shopping-cart"></i>Giỏ hàng</a></li>
                                <?php
                                    $customer_id = Session::get('customer_id');
                                    if($customer_id!=NULL){
                                ?>
                                    <li class="dropdown"><a href="{{url('/account')}}"><i class="fa fa-user"></i>Tài khoản</a>
                                        <ul role="menu" class="sub-menu-top">
                                            <li><a href="{{url('/account')}}">Thông tin</a></li>
                                            <li><a href="{{url('/orders')}}">Đơn hàng</a></li>
                                            <li><a href="{{url('/address')}}">Địa chỉ</a></li>
                                        </ul>
                                    </li> 
                                    <li><a href="{{URL::to('/logout-checkout')}}"><i class="fa fa-sign-out"></i>Đăng xuất</a></li>
                                <?php
                                    }
                                    else{
                                ?>
                                            <li><a href="{{URL::to('/login')}}"><i class="fa fa-sign-in"></i>Đăng nhập</a></li>
                                            <li><a href="{{URL::to('/signup')}}"><i class="fa fa-key"></i>Đăng kí</a></li>
                                <?php
                                        }
                                ?>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div><!--/header-middle-->
    
        <div class="header-bottom"><!--header-bottom-->
            <section class="hero">
            <div class="container">
                <div class="row">
                    <div class="col-sm-4"><div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div class="mainmenu">
                            <ul class="nav navbar-nav collapse navbar-collapse">
                                <li class="dropdown"><a href="{{url('show-all-product')}}">Sản phẩm<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="{{url('show-all-product')}}">Tất cả sản phẩm</a></li>
                                        <li><a href="{{url('best-seller')}}">Sản phẩm bán chạy</a></li>
                                    </ul>
                                </li> 
                                <li class="dropdown"><a href="#">Khuyến mại</a>
                                </li> 
                                <li><a href="#">Hỗ trợ</a></li>
                            </ul>
                        </div></div>
                    <div class="col-sm-8">
                        <div class="hero__search">
                        <div class="hero__search__form">
                            <form action="{{URL::to('/search')}}" method="GET">
                                <input type="text" name="keyword" placeholder="Nhập từ khóa tìm kiếm">
                                <button type="submit" class="site-btn"><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                        <div class="hero__search__phone">
                            <div class="hero__search__phone__icon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <div class="hero__search__phone__text">
                                <span style="color: #365899; font-weight: 500; padding-left: 5px;">Gọi mua hàng:</span>
                                <h4 style="color: #EE0000; font-size: 25px;">1900 1900</h4>
                            </div>
                        </div>
                    </div>
                    </div>
                    
                </div>
            </div>
            </section>
        </div><!--/header-bottom-->
    </header><!--/header-->