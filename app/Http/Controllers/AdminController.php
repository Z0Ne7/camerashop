<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;

session_start();

use App\Customer;
use App\Order;
use App\OrderDetails;
use App\City;
use App\Province;
use App\Ward;
use App\Shipping;
use App\Statistical;
use App\Product;
use Carbon\Carbon;

class AdminController extends Controller
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
    public function index()
    {
        if (Session::get('admin_id')) {
            return Redirect::to('dashboard');
        } else {
            return view('pages.login.admin_login');
        }
    }
    public function dashboard_filter(Request $request)
    {
        $data = $request->all();
        $chart_data = [];
        $beginThisMonth = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();
        $beginLastMonth = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateString();
        $endLastMonth = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateString();
        $sub7days = Carbon::now('Asia/Ho_Chi_Minh')->subDay(7)->toDateString();
        $sub365days = Carbon::now('Asia/Ho_Chi_Minh')->subDay(365)->toDateString();
        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        switch ($data['dashboardValue']) {
            case 'lastWeek':
                $filterDatas = Statistical::whereBetween('order_date', [$sub7days, $now])->orderby('order_date', 'asc')->get();
                break;
            case 'lastMonth':
                $filterDatas = Statistical::whereBetween('order_date', [$beginLastMonth, $endLastMonth])->orderby('order_date', 'asc')->get();
                break;
            case 'thisMonth':
                $filterDatas = Statistical::whereBetween('order_date', [$beginThisMonth, $now])->orderby('order_date', 'asc')->get();
                break;
            case 'lastYear':
                $filterDatas = Statistical::whereBetween('order_date', [$sub365days, $now])->orderby('order_date', 'asc')->get();
                break;
        }
        if ($filterDatas) {
            foreach ($filterDatas as $filterData) {
                // $chart_data[] = array(
                //     'period' => $filterData->order_date,
                //     'order' => $filterData->total_order,
                //     'sales' => $filterData->sales,
                //     'quantity' => $filterData->quantity
                // );
                array_push($chart_data, [
                    'period' => $filterData->order_date,
                    'order' => $filterData->total_order,
                    'sales' => $filterData->sales,
                    'quantity' => $filterData->quantity
                ]);
            }
        }

        return json_encode($chart_data);
    }
    public function show_dashboard()
    {
        $this->AuthLogin();
        $user = Customer::orderby('customer_id', 'desc')->get();
        $order = Order::orderby('created_at', 'desc')->get();
        $success_order = Order::where('order_status', 4)->get();
        $OrderDetails = OrderDetails::all();
        $count_user = $user->count();
        $count_order = $success_order->count();
        $order_details = OrderDetails::orderby('order_details_id', 'desc')->get();
        $total = 0;
        $sold_product = 0;
        foreach ($success_order as $success) {
            foreach ($order_details as $details) {
                if ($details->order_code == $success->order_code) {
                    $subtotal = $details->product_price * $details->product_sale_quantity;
                    $total += $subtotal;
                }
            }
        }
        foreach ($OrderDetails as $OrderDetail) {
            $sold_product = $sold_product + $OrderDetail->product_sale_quantity;
        }
        return view('admin.dashboard')->with(compact('count_user', 'count_order', 'order_details', 'total', 'order', 'sold_product'));
    }
    public function dashboard(Request $request)
    {
        $admin_email = $request->admin_email;
        $admin_password = md5($request->admin_password);

        $result = DB::table('tbl_admin')->where('admin_email', $admin_email)->where('admin_password', $admin_password)->first();
        if ($result) {
            Session::put('admin_name', $result->admin_name);
            Session::put('admin_id', $result->admin_id);
            return Redirect::to('/dashboard');
        } else {
            Session::put('message', 'Sai tài khoản hoặc mật khẩu!');
            return Redirect::to('/admin');
        }
    }
    public function all_user()
    {
        $this->AuthLogin();
        $customer = Customer::orderby('customer_id', 'asc')->get();
        $address = Shipping::all();
        $city = City::all();
        $province = Province::all();
        $ward = Ward::all();
        return view('admin.user.manage_user')->with(compact('customer', 'address', 'city', 'province', 'ward'));
    }
    public function logout()
    {
        $this->AuthLogin();
        Session::put('admin_name', null);
        Session::put('admin_id', null);
        return Redirect::to('/admin');
    }
    public function filter_by_date(Request $request)
    {
        $data = $request->all();
        $chart_data = [];
        $dateFrom = $data['dateFrom'];
        $dateTo = $data['dateTo'];
        $stats = Statistical::whereBetween('order_date', [$dateFrom, $dateTo])->orderby('order_date', 'asc')->get();
        foreach ($stats as $stat) {
            array_push($chart_data, [
                'period' => $stat->order_date,
                'order' => $stat->total_order,
                'sales' => $stat->sales,
                'quantity' => $stat->quantity
            ]);
        }
        return json_encode($chart_data);
    }

    public function getStatsOnLoad(){
        $chart_data = [];
        $sub365days = Carbon::now('Asia/Ho_Chi_Minh')->subDay(365)->toDateString();
        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $filterDatas = Statistical::whereBetween('order_date', [$sub365days, $now])->orderby('order_date', 'asc')->get();
        foreach ($filterDatas as $filterData) {
            array_push($chart_data, [
                'period' => $filterData->order_date,
                'order' => $filterData->total_order,
                'sales' => $filterData->sales,
                'quantity' => $filterData->quantity
            ]);
        }
        return json_encode($chart_data);
    }

    public function getBestSoldProductOnLoad(){
        $best_sold_product = [];
        $Products = Product::orderby('product_sold','desc')->limit(15)->get();
        foreach($Products as $index => $Product){
            array_push($best_sold_product, [
                'period' => $Product->product_name,
                'quantity' => $Product->product_sold
            ]);
        }
        return json_encode($best_sold_product);
    }
}
