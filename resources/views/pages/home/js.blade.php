    <script src="{{asset('public/frontend/js/jquery.js')}}"></script>
    <script src="{{asset('public/frontend/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('public/frontend/js/jquery.scrollUp.min.js')}}"></script>
    <script src="{{asset('public/frontend/js/price-range.js')}}"></script>
    <script src="{{asset('public/frontend/js/jquery.prettyPhoto.js')}}"></script>
    <script src="{{asset('public/frontend/js/main.js')}}"></script>
    <script src="{{asset('public/frontend/js/sweetalert.min.js')}}"></script>
    
    <script type="text/javascript">
        $(document).ready(function(){
            $('.add-to-cart').click(function(){
                var id = $(this).data('id_product');
                var cart_product_id = $('.cart_product_id_'+id).val();
                var cart_product_name = $('.cart_product_name_'+id).val();
                var cart_product_image = $('.cart_product_image_'+id).val();
                var cart_product_price = $('.cart_product_price_'+id).val();
                var cart_product_stock = $('.cart_product_stock_'+id).val();
                var cart_product_qty = $('.cart_product_qty_'+id).val();
                var _token = $('input[name="_token"]').val();
            $.ajax({
                url: '{{url('/add-cart')}}',
                method: 'POST',
                data:{cart_product_id:cart_product_id, cart_product_name:cart_product_name, cart_product_image:cart_product_image, cart_product_price:cart_product_price, cart_product_qty:cart_product_qty,cart_product_stock:cart_product_stock, _token:_token},
                success:function(){
                    swal({
                        title: "Đã thêm vào giỏ hàng",
                        type: "success",
                        titleClass: 'swal-title',
                        showCancelButton: true,
                        cancelButtonText: "Tiếp tục",
                        confirmButtonClass: "btn-blue btn-roundcorner",
                        confirmButtonText: "Tới giỏ hàng",
                        closeOnConfirm: false
                    },
                    function() {
                        window.location.href = "{{url('/cart')}}";
                    });

                }
            });
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.out-of-stock').click(function(){
                swal({
                        title: "Sản phẩm đã hết hàng!",
                        titleClass: 'swal-title',
                        type: "warning",
                        allowOutsideClick: true,
                        showCancelButton: false,
                        confirmButtonClass: "btn-blue btn-roundcorner",
                        confirmButtonText: "Đồng ý",
                        closeOnConfirm: false
                    });
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.choose').on('change',function(){
            var action = $(this).attr('id');
            var ma_id = $(this).val();
            var _token = $('input[name="_token"]').val();
            var result = '';
            if(action=='city'){
                result = 'province'
            }else{
                result='ward';
            }
            $.ajax({
                url: '{{url('/select-location-checkout')}}',
                method: 'POST',
                data:{action:action,ma_id:ma_id,_token:_token},
                success:function(data){
                    $('#'+result).html(data);
                }
            });
        });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.cal_shipping_fee').click(function(){
            var matinh = $('.city').val();
            var mahuyen = $('.province').val();
            var maxa = $('.ward').val();
            var shipping_name = $('.shipping_name').val();
            var shipping_address = $('.shipping_address').val();
            var shipping_phone = $('.shipping_phone').val();
            var _token = $('input[name="_token"]').val();
            if(matinh=='' || mahuyen=='' || maxa==''){
                alert('Chưa chọn địa chỉ');
            }else{
            $.ajax({
                url: '{{url('/cal-fee')}}',
                method: 'POST',
                data:{matinh:matinh,mahuyen:mahuyen,maxa:maxa, shipping_name:shipping_name, shipping_address:shipping_address, shipping_phone:shipping_phone, _token:_token},
                success:function(){
                    window.location.href = "{{url('/review-order')}}";
                }
                });
            }
            });
            
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.confirm_order').click(function(){
                var shipping_name = $('.shipping_name').val();
                var shipping_address = $('.shipping_address').val();
                var shipping_phone = $('.shipping_phone').val();
                var ma_tinh = $('.ma_tinh').val();
                var ma_huyen = $('.ma_huyen').val();
                var ma_xa = $('.ma_xa').val();
                var shipping_payment = $('.payment_select').val();
                var order_fee = $('.order_fee').val();
                var order_coupon = $('.order_coupon').val();
                var _token = $('input[name="_token"]').val();
                
            $.ajax({
                url: '{{url('/confirm-order')}}',
                method: 'POST',
                data:{shipping_name:shipping_name, shipping_address:shipping_address, shipping_phone:shipping_phone,
                ma_tinh:ma_tinh,ma_huyen:ma_huyen,ma_xa:ma_xa, shipping_payment:shipping_payment, order_fee:order_fee, order_coupon:order_coupon, _token:_token},
                success:function(){
                    swal({
                        title: "Đặt hàng thành công",
                        titleClass: 'swal-title',
                        type: "success",
                        showCancelButton: false,
                        cancelButtonText: "Quay lại",
                        confirmButtonClass: "btn-blue btn-roundcorner",
                        confirmButtonText: "Về trang chủ",
                        closeOnConfirm: false
                    },
                    function(isConfirm) {
                          if (isConfirm) {
                            window.location.href = "{{url('/')}}";
                          }else{
                            location.reload();
                          }
                        });
                    window.setTimeout(function(){
                            location.reload();
                        },3000);
                }
            });
            });
        });
    </script>
    <script type="text/javascript">
        $(function(){
            $('.sort_by').change(function(){
                $('#formSortby').submit();
            })
        });
    </script>