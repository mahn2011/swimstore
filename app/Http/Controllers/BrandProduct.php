<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class BrandProduct extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('/dashboard');
        }else {
            return Redirect::to('/admin')->send();
        }
    }
    public function add_brand_product(){
        $this->AuthLogin();
        return view('admin.add_brand_product');
    }
    public function all_brand_product(){
        $this->AuthLogin();
//        $all_brand_product = DB::table('tbl_brand_product')->get();
        $all_brand_product = Brand::orderBy('brand_id','DESC')->get();
        $manager_brand_product = view('admin.all_brand_product')->with('all_brand_product',$all_brand_product);
        return view('admin_layout')->with('admin.all_brand_product',$manager_brand_product);
    }
    public function save_brand_product(Request $request){
        $this->AuthLogin();
//        $data = array();
//        $data['brand_name'] = $request->brand_product_name;
//        $data['meta_keywords'] = $request->brand_product_key;
//        $data['brand_desc'] = $request->brand_product_desc;
//        $data['brand_status'] = $request->brand_product_status;
//        DB::table('tbl_brand_product')->insert($data);
        $data = $request->all();
        $brand = new Brand();
        $brand->brand_name = $data['brand_product_name'];
        $brand->meta_keywords = $data['brand_product_key'];
        $brand->brand_desc = $data['brand_product_desc'];
        $brand->brand_status = $data['brand_product_status'];
        $brand->save();
        Session::put('message','Thêm Thương Hiệu Sản Phẩm Thành Công');
        return redirect('/add-brand-product');
    }
    public function unactive_brand_product($brand_product_id){
        $this->AuthLogin();
        $brand = Brand::find($brand_product_id);
        if ($brand) {
            $brand->brand_status = 0;
            $brand->save();
            Session::put('message','Đóng Hoạt Động Thương Hiệu Thành Công!!!');
        } else {
            Session::put('message','Thương Hiệu Không Tồn Tại!');
        }
        return redirect('/all-brand-product');
    }

    public function active_brand_product($brand_product_id){
        $this->AuthLogin();
        $brand = Brand::find($brand_product_id);
        if ($brand) {
            $brand->brand_status = 1;
            $brand->save();
            Session::put('message','Mở Hoạt Động Thương Hiệu Thành Công!!!');
        }else {
            Session::put('message','Thương Hiệu Không Tồn Tại!');
        }
        return redirect('/all-brand-product');
    }
    public function edit_brand_product($brand_product_id){
        $this->AuthLogin();
//        $edit_brand_product = DB::table('tbl_brand_product')->where('brand_id',$brand_product_id)->get();
        $edit_brand_product = Brand::find($brand_product_id);
        $manager_brand_product = view('admin.edit_brand_product')->with('edit_brand_product',$edit_brand_product);
        return view('admin_layout')->with('admin.edit_brand_product',$manager_brand_product);
    }
    public function update_brand_product(Request $request,$brand_product_id){
        $this->AuthLogin();
//        $data = array();
//        $data['brand_name'] = $request->brand_product_name;
//        $data['meta_keywords'] = $request->brand_product_key;
//        $data['brand_desc'] = $request->brand_product_desc;
//        DB::table('tbl_brand_product')->where('brand_id',$brand_product_id)->update($data);
        $data = $request->all();
        $brand = Brand::find($brand_product_id);
        $brand->brand_name = $data['brand_product_name'];
        $brand->meta_keywords = $data['brand_product_key'];
        $brand->brand_desc = $data['brand_product_desc'];
        $brand->save();
        Session::put('message','Cập Nhật Thành Công');
        return redirect('/all-brand-product');
    }
    public function delete_brand_product($brand_product_id){
        $this->AuthLogin();
//        DB::table('tbl_brand_product')->where('brand_id',$brand_product_id)->delete();
        Brand::find($brand_product_id)->delete();
        Session::put('message','Xoá Thành Công');
        return redirect('/all-brand-product');
    }
    // end function Brand page
    public function show_brand_home(Request $request,$brand_id){
//        $cate_product = DB::table('tbl_category_product')->orderby('category_id','desc')->get();
//        $brand_product = DB::table('tbl_brand_product')->orderby('brand_id','desc')->get();
//        $brand_by_id = DB::table('tbl_product')
//            ->join('tbl_brand_product','tbl_product.brand_id','=','tbl_brand_product.brand_id')
//            ->where('tbl_product.brand_id',$brand_id)->get();
        $cate_product = Category::orderBy('category_id', 'desc')->get();
        $brand_product = Brand::orderBy('brand_id', 'desc')->get();
        $brand_by_id = Product::with('brand')
            ->where('brand_id',$brand_id)->where('product_status', 1)->get();
        $meta_desc = '';
        $meta_brand_key = '';
        $meta_title = '';
        $url_canonical = $request->url();

//        foreach ($brand_by_id as $key => $val) {
//            $meta_desc = $val->brand_desc;
//            $meta_brand_key = $val->meta_keywords;
//            $meta_title = $val->brand_name;
//        }
        if ($brand_by_id->isNotEmpty()) {
            $meta_desc = $brand_by_id->first()->brand->brand_desc ?? '';
            $meta_keywords = $brand_by_id->first()->brand->meta_keywords ?? '';
            $meta_title = $brand_by_id->first()->brand->brand_name ?? '';
        }
//        $brand_name = DB::table('tbl_brand_product')->where('tbl_brand_product.brand_id',$brand_id)->limit(1)->get();
        $brand_name = Brand::where('brand_id',$brand_id)->first();
        return view('pages.brand.show_brand')->with('category',$cate_product)
            ->with('brand',$brand_product)->with('brand_by_id',$brand_by_id)->with('brand_name',$brand_name)
            ->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_brand_key)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical);
    }
}
