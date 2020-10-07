<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\City;
use App\Province;
use App\Ward;
use App\Shippingfee;
use Illuminate\Support\Facades\Redirect;
use Session;
session_start();

class DeliveryController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }
        else{
            return Redirect::to('admin')->send();
        }

    }
    public function shipping_fee(Request $request){
        $this ->AuthLogin();
    	$city = City::orderby('idCity','asc')->get();
    	return view('admin.delivery.add_fee')->with(compact('city'));

    }
    public function select_location(Request $request){
    	$data = $request->all();
    	if($data['action']){
    		$output='';
    		if($data['action']=='city'){
    			$select_province = Province::where('idCity',$data['ma_id'])->orderby('idProvince','asc')->get();
    			$output.='<option>Chọn Quận/Huyện</option>';
    			foreach($select_province as $key => $province){
    			$output.='<option value="'.$province->idProvince.'">'.$province->nameProvince.'</option>';
    			}
    		}else{
    			$select_ward = Ward::where('idProvince',$data['ma_id'])->orderby('idWard','asc')->get();
    			$output.='<option>Chọn Phường/Xã</option>';
    			foreach($select_ward as $key => $ward){
    			$output.='<option value="'.$ward->idWard.'">'.$ward->nameWard.'</option>';
    			}
    		}
    	}
    	echo $output;
    }
    public function add_shipping_fee(Request $request){
    	$data = $request->all();
    	$fee_ship = new Shippingfee();
    	$fee_ship->fee_idCity = $data['city'];
    	$fee_ship->fee_idProvince = $data['province'];
    	$fee_ship->fee_idWard = $data['ward'];
    	$fee_ship->fee_value = $data['shippingfee'];
    	$fee_ship->save();
    }
    public function list_shipping_fee() {
    	$feeship = Shippingfee::orderby('fee_id','desc')->get();
    	$output='';
    	$output .= '<div class="table-responsive">
    					<table class="table table-bordered">
    						<thread>
    							<tr>
    								<th>Thành phố/Tỉnh</th>
    								<th>Phường/Xã</th>
    								<th>Quận/Huyện</th>
    								<th>Số tiền</th>
                                    <th>Đơn vị</th>
    							</tr>
    						</thread>
    						<tbody>
    						';
    						foreach($feeship as $key => $fee){
    							$output .='<tr>
    								<td>'.$fee->city->nameCity.'</td>
    								<td>'.$fee->province->nameProvince.'</td>
    								<td>'.$fee->ward->nameWard.'</td>
    								<td contenteditable data-feeship_id="'.$fee->fee_id.'" class="feeship_edit">'.number_format($fee->fee_value,'0',',','.').'</td>
                                    <td>VNĐ</td>
    							</tr>';
    						}
    						$output .= '</tbody>
    					</table>
    				</div>';
    				echo $output;
    }
    public function update_shipping_fee(Request $request){
    	$data = $request->all();
    	$fee_ship = Shippingfee::find($data['id_feeship']);
    	$fee_trim = rtrim($data['value_feeship'],'.');
    	$fee_ship->fee_value = $fee_trim;
    	$fee_ship->save();
    }
}
