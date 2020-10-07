<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;
use App\Product;
use App\OrderDetails;
session_start();

class ProductController extends Controller
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
    public function add_product(){
    	$this ->AuthLogin();
    	$cate_product = DB::table('tbl_category')->orderby('category_id','desc')->get();
    	$brand_product = DB::table('tbl_brand')->orderby('brand_id','desc')->get();
    	return view('admin.add_product')->with('cate_product',$cate_product)->with('brand_product',$brand_product);

    }
    public function all_product(){
    	$this ->AuthLogin();
    	$all_product = DB::table('tbl_product')
    	->join('tbl_category','tbl_category.category_id','=','tbl_product.category_id')
    	->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')->orderby('tbl_product.product_id','desc')->paginate(10);
    	return view('admin.all_product')->with(compact('all_product'));
    }
    public function save_product(Request $request){
    	$this ->AuthLogin();
    	$data= array();
        $data['product_name'] = $request->product_name;
    	$data['product_stock'] = $request->product_stock;
    	$data['product_price'] = $request->product_price;
    	$data['product_desc'] = $request->product_desc;
    	$data['product_content'] = $request->product_content;
    	$data['category_id'] = $request->product_cate;
    	$data['brand_id'] = $request->product_brand;
    	$data['product_status'] = $request->product_status;
    	$get_image = $request -> file('product_image');
    	if($get_image){
    		$get_name_image =$get_image->getClientOriginalName();
    		$name_image = current(explode('.',$get_name_image));
    		$new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
    		$get_image->move('public/uploads/product',$new_image);
    		$data['product_image']= $new_image;
    	}else{
            $data['product_image']= '';
        }
    	DB::table('tbl_product')->insert($data);
        Session::put('message','Thêm sản phẩm thành công');
        return Redirect::to('add-product');
    }
    public function inactive_product($product_id){
    	$this ->AuthLogin();
    	DB::table('tbl_product')->where('product_id',$product_id)->update(['product_status'=>0]);
    	return Redirect::to('all-product');

    }
    public function active_product($product_id){
    	$this ->AuthLogin();
    	DB::table('tbl_product')->where('product_id',$product_id)->update(['product_status'=>1]);
    	return Redirect::to('all-product');
    	
    }
    public function edit_product($product_id){
    	$this ->AuthLogin();
    	$cate_product = DB::table('tbl_category')->orderby('category_id','desc')->get();
    	$brand_product = DB::table('tbl_brand')->orderby('brand_id','desc')->get();

    	$edit_product = DB::table('tbl_product')->where('product_id',$product_id)->get();
    	$manager_product = view('admin.edit_product')->with('edit_product',$edit_product)
    	->with('cate_product',$cate_product)
    	->with('brand_product',$brand_product);
    	return view('admin_layout')->with('admin.edit_product',$manager_product);

    }
    public function update_product(Request $request,$product_id){
    	$this ->AuthLogin();
    	$data= array();
    	$data['product_name'] = $request->product_name;
        $data['product_stock'] = $request->product_stock;
    	$data['product_price'] = $request->product_price;
    	$data['product_desc'] = $request->product_desc;
    	$data['product_content'] = $request->product_content;
    	$data['category_id'] = $request->product_cate;
    	$data['brand_id'] = $request->product_brand;
    	$data['product_status'] = $request->product_status;
    	$get_image = $request -> file('product_image');
    	
    	if($get_image){
    		$get_name_image =$get_image->getClientOriginalName();
    		$name_image = current(explode('.',$get_name_image));
    		$new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
    		$get_image->move('public/uploads/product',$new_image);
    		$data['product_image']= $new_image;
    	}
	    	
	    	DB::table('tbl_product')->where('product_id',$product_id)->update($data);
	    	return redirect()->back()->with('message','Đã cập nhật thông tin sản phẩm!');

    }
    public function delete_product($product_id){
    	$this ->AuthLogin();
    	DB::table('tbl_product')->where('product_id',$product_id)->delete();
    	Session::put('message','Xóa sản phẩm thành công');
    	return Redirect::to('all-product');
    }
    //End admin
    public function details_product($product_id){
        $cate_product = DB::table('tbl_category')->where('category_status','1')->orderby('category_id','asc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','asc')->get();
        $product_details = DB::table('tbl_product')
        ->join('tbl_category','tbl_category.category_id','=','tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        ->where('tbl_product.product_id',$product_id)->get();
        $lastest = DB::table('tbl_product')->where('product_status','1')->orderby('product_id','desc')->first();
        foreach ($product_details as $key => $value){
            $category_id = $value->category_id;
            $brand_id = $value->brand_id;
        }
        

        $relate = DB::table('tbl_product')
        ->join('tbl_category','tbl_category.category_id','=','tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        ->where('tbl_category.category_id',$category_id)->whereNotIn('tbl_product.product_id',[$product_id])->orWhere('tbl_brand.brand_id',$brand_id)->whereNotIn('tbl_product.product_id',[$product_id])->orderby('product_id','desc')->get();
        $count_relate = $relate->count();

        return view('pages.product.show_details')->with('category',$cate_product)->with('brand',$brand_product)
        ->with(compact('product_details','relate','count_relate','lastest'));
    }
    public function search_product(Request $request){
        $keyword = $request->keyword_submit;
        $search_product = DB::table('tbl_product')->join('tbl_category','tbl_category.category_id','=','tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')->where('product_name','like','%'.$keyword.'%')->orWhere('product_price',$keyword)->orWhere('product_content','like','%'.$keyword.'%')->orWhere('product_desc','like','%'.$keyword.'%')->get();

        return view('admin.product.searchresult')->with(compact('search_product','keyword'));
    }
    public function show_all_product(Request $request){
        $cate_product = DB::table('tbl_category')->where('category_status','1')->orderby('category_id','asc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','asc')->get();
        $all_product = DB::table('tbl_product')->where('product_status','1')->orderby('product_id','asc')->get();
        if($request->sort_by){
            $sort = $request->sort_by;
            switch($sort){
                case 'default':
                $all_product = DB::table('tbl_product')->where('product_status','1')->orderby('product_id','asc')->get();
                break;
                case 'newest':
                $all_product = DB::table('tbl_product')->where('product_status','1')->orderby('product_id','desc')->get();
                break;
                case 'price-asc':
                $all_product = DB::table('tbl_product')->where('product_status','1')->orderby('product_price','asc')->get();
                break;
                case 'price-desc':
                $all_product = DB::table('tbl_product')->where('product_status','1')->orderby('product_price','desc')->get();
                break;
                case 'name-asc':
                $all_product = DB::table('tbl_product')->where('product_status','1')->orderby('product_name','asc')->get();
                break;
                case 'name-desc':
                $all_product = DB::table('tbl_product')->where('product_status','1')->orderby('product_name','desc')->get();
                break;
            }
            
        }
        if($request->p){
            $price = $request->p;
            switch($price){
                case 'duoi-500':
                $all_product = $all_product->where('product_price','<', 500000);
                break;
                case '500-1trieu':
                $all_product = $all_product->whereBetween('product_price',[500000,1000000]);
                break;
                case '1trieu-2trieu':
                $all_product = $all_product->whereBetween('product_price',[1000000,2000000]);
                break;
                case '2trieu-5trieu':
                $all_product = $all_product->whereBetween('product_price',[2000000,5000000]);
                break;
                case 'tren-5trieu':
                $all_product = $all_product->where('product_price','>', 5000000);
                break;
            }
            
        }
        $count = $all_product->count();
        return view('pages.product.show_all_product')->with('all_product',$all_product)->with('category',$cate_product)->with('brand',$brand_product)->with('count',$count);
    }
    public function best_seller(Request $request){
        $cate_product = DB::table('tbl_category')->where('category_status','1')->orderby('category_id','asc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','asc')->get();
        $best_seller = Product::where('product_sold','>','10')->orderby('product_sold','desc')->get();
        if($request->sort_by){
            $sort = $request->sort_by;
            switch($sort){
                case 'default':
                $best_seller = Product::where('product_sold','>','10')->orderby('product_id','asc')->get();
                break;
                case 'newest':
                $best_seller = Product::where('product_sold','>','10')->orderby('product_id','desc')->get();
                break;
                case 'price-asc':
                $best_seller = Product::where('product_sold','>','10')->orderby('product_price','asc')->get();
                break;
                case 'price-desc':
                $best_seller = Product::where('product_sold','>','10')->orderby('product_price','desc')->get();
                break;
                case 'name-asc':
                $best_seller = Product::where('product_sold','>','10')->orderby('product_name','asc')->get();
                break;
                case 'name-desc':
                $best_seller = Product::where('product_sold','>','10')->orderby('product_name','desc')->get();
                break;
            }
            
        }
        if($request->p){
            $price = $request->p;
            switch($price){
                case 'duoi-500':
                $best_seller = $best_seller->where('product_price','<', 500000);
                break;
                case '500-1trieu':
                $best_seller = $best_seller->whereBetween('product_price',[500000,1000000]);
                break;
                case '1trieu-2trieu':
                $best_seller = $best_seller->whereBetween('product_price',[1000000,2000000]);
                break;
                case '2trieu-5trieu':
                $best_seller = $best_seller->whereBetween('product_price',[2000000,5000000]);
                break;
                case 'tren-5trieu':
                $best_seller = $best_seller->where('product_price','>', 5000000);
                break;
            }
            
        }
        return view('pages.product.best_seller')->with('category',$cate_product)->with('brand',$brand_product)->with(compact('best_seller'));
    }
}
