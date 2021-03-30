<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect;
use App\Shippingfee;
use App\Order;
use App\OrderDetails;
use App\Shipping;
use App\Customer;
use App\Coupon;
use App\City;
use App\Province;
use App\Ward;
use App\Product;
use App\Statistical;
use PDF;
use Session;

session_start();

class OrderController extends Controller
{
    public function AuthLogin()
    {
        $admin_id = Session::get('admin_id');
        if ($admin_id) {
            return Redirect::to('dashboard');
        } else {
            return Redirect::to('admin')->send();
        }
    }
    public function manage_order(Request $request)
    {
        $this->AuthLogin();
        $order = Order::orderby('created_at', 'desc')->paginate(10);
        if ($request->status) {
            $stat = $request->status;
            switch ($stat) {
                case 'all':
                    $order = Order::orderby('created_at', 'desc')->paginate(10);
                    break;
                case 'success':
                    $order = Order::where('order_status', 1)->orderby('created_at', 'desc')->paginate(10);
                    break;
                case 'confirmed':
                    $order = Order::where('order_status', 2)->orderby('created_at', 'desc')->paginate(10);
                    break;
                case 'shipping':
                    $order = Order::where('order_status', 3)->orderby('created_at', 'desc')->paginate(10);
                    break;
                case 'delivered':
                    $order = Order::where('order_status', 4)->orderby('created_at', 'desc')->paginate(10);
                    break;
                case 'rejected':
                    $order = Order::where('order_status', 5)->orderby('created_at', 'desc')->paginate(10);
                    break;
                case 'canceled':
                    $order = Order::where('order_status', 0)->orderby('created_at', 'desc')->paginate(10);
                    break;
            }
            $order->appends(['status' => $stat]);
        }

        return view('admin.order.manage_order')->with(compact('order'));
    }
    public function accept_order($order_code)
    {
        $order_cod = Order::where('order_code', $order_code)->first();
        $order_cp = $order_cod->order_couponcode;
        if ($order_cod->order_status == 0 || $order_cod->order_status == 5) {
            return redirect()->back()->with('errmsg', 'Đơn hàng đã bị hủy');
        } elseif ($order_cod->order_status == 1) {
            if ($order_cp != 'NULL') {
                $coupon = Coupon::where('coupon_value', $order_cp)->first();
                $cp_time_after = $coupon->coupon_time - 1;
                $coupon->update(['coupon_time' => $cp_time_after]);
            }
            $order_cod->update(['order_status' => 2]);
            return redirect()->back()->with('message', 'Đã xác nhận đơn hàng');
        } elseif ($order_cod->order_status == 2) {
            return redirect()->back()->with('errmsg', 'Đơn hàng đã được xác nhận');
        } elseif ($order_cod->order_status == 4) {
            return redirect()->back()->with('errmsg', 'Đơn hàng đã hoàn thành');
        } elseif ($order_cod->order_status == 3) {
            return redirect()->back()->with('errmsg', 'Đơn hàng đang được giao');
        } else {
            return redirect()->back();
        }
    }
    public function ship_order($order_code)
    {
        $order_cod = Order::where('order_code', $order_code)->first();
        if ($order_cod->order_status == 0 || $order_cod->order_status == 5) {
            return redirect()->back()->with('errmsg', 'Đơn hàng đã bị hủy');
        } elseif ($order_cod->order_status == 1) {
            $order_cod->update(['order_status' => 3]);
            return redirect()->back()->with('message', 'Đã gửi hàng');
        } elseif ($order_cod->order_status == 2) {
            $order_cod->update(['order_status' => 3]);
            return redirect()->back()->with('message', 'Đã gửi hàng');
        } elseif ($order_cod->order_status == 4) {
            return redirect()->back()->with('errmsg', 'Đơn hàng đã hoàn thành');
        } elseif ($order_cod->order_status == 3) {
            return redirect()->back()->with('errmsg', 'Đơn hàng đang được giao');
        } else {
            return redirect()->back();
        }
    }
    public function complete_order($order_code)
    {
        $order = Order::where('order_code', $order_code)->first();
        $order_details = OrderDetails::where('order_code', $order_code)->get();
        $products = Product::orderby('product_id', 'asc')->get();
        $newStats = new Statistical;

        $stats = Statistical::where('order_date', $order->created_at)->first();
        if ($order->order_status == 0 || $order->order_status == 5) {
            return redirect()->back()->with('errmsg', 'Đơn hàng đã bị hủy');
        } elseif ($order->order_status == 4) {
            return redirect()->back()->with('errmsg', 'Đơn hàng đã hoàn thành');
        } elseif ($order->order_status == 1 || $order->order_status == 2 || $order->order_status == 3) {
            $timeOrder = date_format(now(), "Y-m-d");
            $stats = Statistical::where('order_date', $timeOrder)->first();
            $totalProducts = 0;
            $totalPrices = 0;
            foreach ($order_details as $order_detail) {
                $totalProducts = $totalProducts + $order_detail->product_sale_quantity;
                $totalPrices = $totalPrices + $order_detail->product_price;
            }
            if ($stats) {
                $countOrders = Order::where('created_at', $order->created_at)->count();
                dd($countOrders);
            }
            // $order->update(['order_status' => 4]);
            // foreach($stats as $stat){
            //     if($stat->order_date)
            // }
            dd($stats);
            return redirect()->back()->with('message', 'Đã hoàn thành đơn hàng');
        } else {
            return redirect()->back();
        }
    }
    public function cancel_order($order_code)
    {
        $order_cod = Order::where('order_code', $order_code)->first();
        if ($order_cod->order_status == 0 || $order_cod->order_status == 5) {
            return redirect()->back()->with('errmsg', 'Đơn hàng đã bị hủy');
        } elseif ($order_cod->order_status == 4) {
            return redirect()->back()->with('errmsg', 'Đơn hàng đã hoàn thành');
        } else {
            $order_cod->update(['order_status' => 5]);
            return redirect()->back()->with('message', 'Đã hủy đơn hàng');
        }
    }

    public function view_order($order_code)
    {
        $this->AuthLogin();
        $order_details = OrderDetails::with('product')->where('order_code', $order_code)->get();
        $order = Order::where('order_code', $order_code)->get();
        foreach ($order as $key => $ord) {
            $customer_id = $ord->customer_id;
            $matinh = $ord->order_idCity;
            $mahuyen = $ord->order_idProvince;
            $maxa = $ord->order_idWard;
            $city = City::where('idCity', $matinh)->first();
            $province = Province::where('idProvince', $mahuyen)->first();
            $ward = Ward::where('idWard', $maxa)->first();
        }
        $customer = Customer::where('customer_id', $customer_id)->first();
        // $details_order = OrderDetails::with('product')->where('order_code',$order_code)->get();

        foreach ($order as $key => $ord_detail) {
            $order_coupon = $ord_detail->order_couponcode;
            $feeship = $ord_detail->order_shippingfee;
        }
        if ($order_coupon != 'NULL') {
            $coupon = Coupon::where('coupon_value', $order_coupon)->first();
            $coupon_type = $coupon->coupon_type;
            $coupon_number = $coupon->coupon_number;
        } else {
            $coupon_type = 0;
            $coupon_number = 0;
        }
        return view('admin.order.view_order')->with(compact('order_details', 'customer', 'coupon_type', 'coupon_number', 'order', 'city', 'province', 'ward', 'feeship'));
    }
    public function search_order(Request $request)
    {
        $keyword = $request->keyword_submit;
        if ($keyword == NULL) {
            return redirect()->back()->with('errmsg', 'Chưa nhập từ khóa');
        } else {
            $orders = Order::all();
            $details_order = OrderDetails::where('product_name', 'like', '%' . $keyword . '%')->orWhere('product_price', $keyword)->get();
            $search_order = Order::where('order_code', 'like', '%' . $keyword . '%')
                ->orWhere('created_at', 'like', '%' . $keyword . '%')
                ->orWhere('order_shipping_name', 'like', '%' . $keyword . '%')
                ->orWhere('order_shipping_address', 'like', '%' . $keyword . '%')
                ->orWhere('order_shipping_phone', $keyword)->get();
            return view('admin.order.search_order')->with(compact('search_order', 'keyword', 'details_order', 'orders'));
        }
    }
    public function filter_order(Request $request)
    {
        $data = $request->all();
        $from = $data['dateFrom'];
        $to = $data['dateTo'];
        if ($from != NULL && $to != NULL) {
            $result = Order::whereBetween('created_at', [$from, $to])->get();
            return view('admin.order.filter_order')->with(compact('result', 'from', 'to'));
        } else {
            return redirect()->back()->with('errmsg', 'Chưa chọn khoảng thời gian');
        }
    }
    public function print_receipt($order_code)
    {
        $this->AuthLogin();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->print_receipt_convert($order_code));
        return $pdf->stream();
    }
    public function print_receipt_convert($order_code)
    {
        $this->AuthLogin();
        $order_details = OrderDetails::with('product')->where('order_code', $order_code)->get();
        $order = Order::where('order_code', $order_code)->get();
        foreach ($order as $key => $ord) {
            $customer_id = $ord->customer_id;
            $payment_id = $ord->order_payment;
            $matinh = $ord->order_idCity;
            $mahuyen = $ord->order_idProvince;
            $maxa = $ord->order_idWard;
            $city = City::where('idCity', $matinh)->first();
            $province = Province::where('idProvince', $mahuyen)->first();
            $ward = Ward::where('idWard', $maxa)->first();
        }
        if ($payment_id == 1) {
            $payment = 'Tiền mặt';
        } else {
            $payment = 'Chuyển khoản';
        }
        $customer = Customer::where('customer_id', $customer_id)->first();
        foreach ($order as $key => $ord_detail) {
            $order_coupon = $ord_detail->order_couponcode;
            $feeship = $ord_detail->order_shippingfee;
        }
        if ($order_coupon != 'NULL') {
            $coupon = Coupon::where('coupon_value', $order_coupon)->first();
            $coupon_type = $coupon->coupon_type;
            $coupon_number = $coupon->coupon_number;
        } else {
            $coupon_type = 0;
            $coupon_number = 0;
        }
        $total = 0;
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $date = getdate();
        $day = $date['mday'];
        $month = $date['mon'];
        $year = $date['year'];
        $output = '';
        $output .= '
            <style type="text/css">body{font-family: DejaVu Serif;} .text-center{text-align: center;} .text-top{vertical-align:top;}</style>
            <center style="font-size: 25px; color:#FF0000; text-transform: uppercase;">Hóa đơn bán hàng</center>
            <center>Ngày ' . $day . ' tháng ' . $month . ' năm ' . $year . '</center>
            <table border="0" cellspacing="0" cellpadding="0" width="100%" style="font-size:13px; margin-top:15px; line-height:18px;">
            <tr>
              <td width="90" valign="middle" nowrap="nowrap">Đơn vị bán hàng</td>
              <td width="8" valign="top">:</td>
              <td valign="middle">
                <b style="font-size:16px!important;font-weight:bold;">Công ty TNHH phát triển công nghệ viễn thông 247</b>
              </td>
            </tr>
            <tr>
              <td width="90" valign="top" nowrap="nowrap">Địa chỉ</td>
              <td width="8" valign="top">:</td>
              <td valign="middle">
                <span style="line-height:17px;">Phố Ngô Thì Nhậm, Hà Đông, Hà Nội</span>
              </td>
            </tr>
            <tr>
              <td width="90" valign="top" nowrap="nowrap">Điện thoại</td>
              <td width="8" valign="top">:</td>
              <td valign="middle">
                <span style="line-height:17px;">0888888888</span>
              </td>
            </tr>
            <tr>
              <td width="90" valign="top" nowrap="nowrap">Email</td>
              <td width="8" valign="top">:</td>
              <td valign="middle">
                <span style="line-height:17px;">vienthong247@gmail.com</span>
              </td>
            </tr>
          </table>
          <div style="line-height: 17px; padding-bottom:5px; margin-bottom:5px; border:1px #000 solid;padding-left:10px; padding-top: 5px;">
            <table style="font-size:13px;">
              <tr>
                <td width="110" valign="left" nowrap="nowrap">Họ tên</td>
                <td width="5" valign="top">:</td>
                <td valign="left">
                  <span>' . $ord->order_shipping_name . '</span>
                </td>
              </tr>
              <tr>
                <td width="110" valign="top" nowrap="nowrap">Địa chỉ</td>
                <td valign="top">:</td>
                <td valign="left">
                  <span style="line-height:17px;">' . $ord->order_shipping_address . ', ' . $ward->nameWard . ', ' . $province->nameProvince . ', ' . $city->nameCity . '</span>
                </td>
              </tr>
              <tr>
                <td width="110" valign="left" nowrap="nowrap">Điện thoại</td>
                <td width="5" valign="left">:</td>
                <td valign="middle" nowrap="nowrap">' . $ord->order_shipping_phone . '</td>
              </tr>
              <tr>
                <td width="110" valign="left" nowrap="nowrap">Hình thức thanh toán</td>
                <td width="5" valign="left">:</td>
                <td valign="middle" nowrap="nowrap">' . $payment . '</td>
              </tr>
            </table>
          </div>
        <div style="padding-bottom:5px; margin-bottom:5px; border:1px #000 solid;padding-left:10px;">
        <table class="table table-bordered" style="width: 100%;">
          <thead class="text-center">
            <tr class="thead" style="font-size:15px; line-height:15px;">
              <th>
                <p>
                  <span>STT</span>
                </p>
              </th>
              <th>
                <p>
                  <span>Tên sản phẩm</span>
                </p>

              </th>

              <th>
                <p>
                  <span>Số lượng</span>
                </p>

              </th>
              <th>
                <p>
                  <span>Đơn giá</span>
                </p>

              </th>
              <th>
                <p>
                  <span>Tổng số tiền</span>
                </p>
              </th>
            </tr>
          </thead>
          <tbody style="font-size:15px">';
        foreach ($order_details as $key => $details) {
            $subtotal = $details->product_price * $details->product_sale_quantity;
            $total += $subtotal;
            $output .= '
            <tr style="width: 100%">
              <td class="text-center text-top">' . ($key + 1) . '</td>
              <td class="text-center">' . $details->product_name . '</td>
              <td class="text-center text-top">' . $details->product_sale_quantity . '</td>
              <td class="text-center text-top">' . number_format($details->product_price, '0', ',', '.') . 'Đ' . '</td>
              <td class="text-center text-top">' . number_format($subtotal, '0', ',', '.') . 'Đ' . '</td>
            </tr>';
        }

        $output .= '</tbody>
        </table>
      </div>
        <div class="row border2 footerInvoice">
            <table>
              <tbody>
                <tr>
                  <td>
                    <i>Tổng cộng:</i>
                  </td>
                  <td >
                    <b>' . number_format($total, '0', ',', '.') . 'Đ' . '</b>
                  </td>
                </tr>
                <tr>
                  <td colspan="2">
                    <i>Số tiền viết bằng chữ: ......................................................................................................................................</i>
                  </td>
                </tr>
              </tbody>
            </table>
            <table style="width: 100%">
              <tr>
                <td>
                  <p class="text-center">
                  <b>Người mua hàng </b>
                  <br />
                  <i>(Ký, ghi rõ họ tên)</i>
                  <br />
                  </p>
                </td>
                <td>
                  <p class="text-center" style="float: right;">
                  <b>Người bán hàng </b>
                  <br />
                  <i>(Ký, ghi rõ họ tên)</i>
                  <br />
                </p>
                </td>
              </tr>
            </table>
        </div>';

        return $output;
    }
    //Huy don hang frontend
    public function cancel_ord($order_code)
    {
        $order_cod = Order::where('order_code', $order_code)->first();
        $order_cod->update(['order_status' => 0]);
        return redirect()->back()->with('message', 'Đã hủy đơn hàng');
    }
}
