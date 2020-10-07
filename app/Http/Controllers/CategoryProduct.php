<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class CategoryProduct extends Controller
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
    public function add_category_product(){
        $this ->AuthLogin();
    	return view('admin.add_category_product');

    }
    public function all_category_product(){
        $this ->AuthLogin();
    	$all_category_product = DB::table('tbl_category')->get();
    	$manager_category_product = view('admin.all_category_product')->with('all_category_product',$all_category_product);
    	return view('admin_layout')->with('admin.all_category_product',$manager_category_product);
    }
    public function save_category_product(Request $request){
        $this ->AuthLogin();
    	$data= array();
    	$data['category_name'] = $request->category_product_name;
    	$data['category_desc'] = $request->category_product_desc;
    	$data['category_status'] = $request->category_product_status;
    	
    	DB::table('tbl_category')->insert($data);
    	Session::put('message','Thêm danh mục sản phẩm thành công');
    	return Redirect::to('add-category-product');
    }
    public function inactive_category_product($category_product_id){
        $this ->AuthLogin();
    	DB::table('tbl_category')->where('category_id',$category_product_id)->update(['category_status'=>0]);
    	return Redirect::to('all-category-product');

    }
    public function active_category_product($category_product_id){
        $this ->AuthLogin();
    	DB::table('tbl_category')->where('category_id',$category_product_id)->update(['category_status'=>1]);
    	return Redirect::to('all-category-product');
    	
    }
    public function edit_category_product($category_product_id){
        $this ->AuthLogin();
    	$edit_category_product = DB::table('tbl_category')->where('category_id',$category_product_id)->get();
    	$manager_category_product = view('admin.edit_category_product')->with('edit_category_product',$edit_category_product);
    	return view('admin_layout')->with('admin.edit_category_product',$manager_category_product);

    }
    public function update_category_product(Request $request,$category_product_id){
        $this ->AuthLogin();
    	$data = array();
    	$data['category_name'] = $request->category_product_name;
    	$data['category_desc'] = $request->category_product_desc;
        $data['category_status'] = $request->category_product_status;
    	DB::table('tbl_category')->where('category_id',$category_product_id)->update($data);
    	Session::put('message','Đã cập nhật thông tin danh mục!');
    	return Redirect::to('all-category-product');

    }
    public function delete_category_product($category_product_id){
        $this ->AuthLogin();
    	DB::table('tbl_category')->where('category_id',$category_product_id)->delete();
    	Session::put('message','Đã xóa danh mục!');
    	return Redirect::to('all-category-product');
    }

    //Front end
    public function show_category_home(Request $request, $category_id){
        $cate_product = DB::table('tbl_category')->where('category_status','1')->orderby('category_id','asc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','asc')->get();
        $category_by_id = DB::table('tbl_product')->join('tbl_category','tbl_product.category_id','=','tbl_category.category_id')->where('tbl_product.category_id',$category_id)->get();
        $category_name = DB::table('tbl_category')->where('tbl_category.category_id',$category_id)->first();
        if($request->sort_by){
            $sort = $request->sort_by;
            switch($sort){
                case 'default':
                $category_by_id = DB::table('tbl_product')->join('tbl_category','tbl_product.category_id','=','tbl_category.category_id')->where('tbl_product.category_id',$category_id)->orderby('product_id','asc')->get();
                break;
                case 'newest':
                $category_by_id = DB::table('tbl_product')->join('tbl_category','tbl_product.category_id','=','tbl_category.category_id')->where('tbl_product.category_id',$category_id)->orderby('product_id','desc')->get();
                break;
                case 'price-asc':
                $category_by_id = DB::table('tbl_product')->join('tbl_category','tbl_product.category_id','=','tbl_category.category_id')->where('tbl_product.category_id',$category_id)->orderby('product_price','asc')->get();
                break;
                case 'price-desc':
                $category_by_id = DB::table('tbl_product')->join('tbl_category','tbl_product.category_id','=','tbl_category.category_id')->where('tbl_product.category_id',$category_id)->orderby('product_price','desc')->get();
                break;
                case 'name-asc':
                $category_by_id = DB::table('tbl_product')->join('tbl_category','tbl_product.category_id','=','tbl_category.category_id')->where('tbl_product.category_id',$category_id)->orderby('product_name','asc')->get();
                break;
                case 'name-desc':
                $category_by_id = DB::table('tbl_product')->join('tbl_category','tbl_product.category_id','=','tbl_category.category_id')->where('tbl_product.category_id',$category_id)->orderby('product_name','desc')->get();
                break;
            }
            
        }
        if($request->p){
            $price = $request->p;
            switch($price){
                case 'duoi-500':
                $category_by_id = $category_by_id->where('product_price','<', 500000);
                break;
                case '500-1trieu':
                $category_by_id = $category_by_id->whereBetween('product_price',[500000,1000000]);
                break;
                case '1trieu-2trieu':
                $category_by_id = $category_by_id->whereBetween('product_price',[1000000,2000000]);
                break;
                case '2trieu-5trieu':
                $category_by_id = $category_by_id->whereBetween('product_price',[2000000,5000000]);
                break;
                case 'tren-5trieu':
                $category_by_id = $category_by_id->where('product_price','>', 5000000);
                break;
            }
            
        }
        $count = $category_by_id->count();
        
        return view('pages.category.show_category')->with('category',$cate_product)->with('brand',$brand_product)->with(compact('count','category_by_id','category_name'));
    }

}
