<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>CameraShop - Chuyên cung cấp các loại camara giám sát</title>
    <link href="{{asset('public/frontend/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/price-range.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/main.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/responsive.css')}}" rel="stylesheet">      
    <link rel="icon" href="{{asset('public/frontend/images/camera-icon.png')}}">
    <link href="{{asset('public/backend/css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/sweetalert.css')}}" rel="stylesheet">
    
</head><!--/head-->

<body>
    @include('pages.home.header')
    
    <section>
        <div class="container">
            <div class="row">
                
                
                <div class="col-sm-9 padding-right">
                    @yield('content')                   
                </div>
            </div>
        </div>
    </section>
    
    @include('pages/home/footer')
    
    @include('pages/home/js')
    
</body>
</html>