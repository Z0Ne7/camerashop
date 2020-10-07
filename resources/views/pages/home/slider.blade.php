<section id="slider"><!--slider-->
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
                            <li data-target="#slider-carousel" data-slide-to="1"></li>
                            <li data-target="#slider-carousel" data-slide-to="2"></li>
                            <li data-target="#slider-carousel" data-slide-to="3"></li>
                        </ol>
                        
                        <div class="carousel-inner">
                            <div class="item active">
                                <a href="{{url('/categories/10')}}"><img src="{{asset('public/frontend/images/banner2.jpg')}}" class="img-responsive" alt="" /></a>
                            </div>
                            <div class="item">
                                <img src="{{asset('public/frontend/images/banner1.jpg')}}" class="img-responsive" alt="" />
                            </div>
                            <div class="item">
                                <img src="{{asset('public/frontend/images/banner3.jpg')}}" class="img-responsive" alt="" />
                            </div>
                            <div class="item">
                                <img src="{{asset('public/frontend/images/BannerHomepage2.png')}}" class="img-responsive" alt="" />
                            </div>
                            
                        </div>
                        
                        <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </div>
                    
                </div>
            </div>
        </div>
    </section><!--/slider-->