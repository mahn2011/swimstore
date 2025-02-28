<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;
class ProductController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('/dashboard');
        }else {
            return Redirect::to('/admin')->send();
        }
    }
    public function add_product(){
        $this->AuthLogin();
//        $cate_product = DB::table('tbl_category_product')->orderby('category_id','desc')->get();
//        $brand_product = DB::table('tbl_brand_product')->orderby('brand_id','desc')->get();
        $cate_product = Category::orderBy('category_id', 'desc')->get();
        $brand_product = Brand::orderBy('brand_id', 'desc')->get();
        return view('admin.add_product')->with('cate_product',$cate_product)->with('brand_product',$brand_product);
    }
    public function all_product(){
        $this->AuthLogin();
//        $all_product = DB::table('tbl_product')
//            ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
//            ->join('tbl_brand_product','tbl_brand_product.brand_id','=','tbl_product.brand_id')
//            ->orderby('tbl_product.product_id','desc')->get();
        $all_product = Product::with('category','brand')->orderBy('product_id', 'desc')->get();
        $manager_product = view('admin.all_product')->with('all_product',$all_product);
        return view('admin_layout')->with('admin.all_product',$manager_product);
    }
    public function save_product(Request $request){
        $this->AuthLogin();
//        $data = array();
//        $data['product_name'] = $request->product_name;
//        $data['product_desc'] = $request->product_desc;
//        $data['product_price'] = $request->product_price;
//        $data['product_content'] = $request->product_content;
//        $data['category_id'] = $request->product_cate;
//        $data['brand_id'] = $request->product_brand;
//        $data['product_status'] = $request->product_status;
//        $data['product_image'] = $request->product_status;
//        $get_image = $request->file('product_image');
//        if($get_image){
//            $get_name_image = $get_image->getClientOriginalName();
//            $name_image = current(explode('.',$get_name_image));
//            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
//            $get_image->move(public_path('uploads/product'), $new_image);
//            //   $get_image->storeAs('public/uploads/product', $new_image);
//            $data['product_image'] = $new_image;
//            DB::table('tbl_product')->insert($data);
//            Session::put('message','Thêm Danh Mục Sản Phẩm Thành Công');
//            return redirect('all-product');
//        }
//        $data['product_image'] = '';
//        DB::table('tbl_product')->insert($data);
//        Session::put('message','Thêm Danh Mục Sản Phẩm Thành Công');
//        return redirect('/add-product');
        $product = new Product();
        $product->product_name = $request->product_name;
        $product->product_desc = $request->product_desc;
        $product->product_price = $request->product_price;
        $product->product_content = $request->product_content;
        $product->category_id = $request->product_cate;
        $product->brand_id = $request->product_brand;
        $product->product_status = $request->product_status;

        // Xử lý ảnh
        if ($request->hasFile('product_image')) {
            $get_image = $request->file('product_image');
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = pathinfo($get_name_image, PATHINFO_FILENAME);
            $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move(public_path('uploads/product'), $new_image);
            $product->product_image = $new_image;
        } else {
            $product->product_image = '';
        }

        // Lưu sản phẩm vào database
        $product->save();

        Session::put('message', 'Thêm Danh Mục Sản Phẩm Thành Công');
        return redirect('/all-product');
    }
    public function unactive_product($product_id){
        $this->AuthLogin();
//        DB::table('tbl_product')->where('product_id',$product_id)->update(['product_status'=>0]);
        $product = Product::find($product_id);
        $product->product_status = 0;
        $product->save();
        Session::put('message','Thay Đổi Thành Công');
        return redirect('/all-product');
    }
    public function active_product($product_id){
        $this->AuthLogin();
//        DB::table('tbl_product')->where('product_id',$product_id)->update(['product_status'=>1]);
        $product = Product::find($product_id);
        $product->product_status = 1;
        $product->save();
        Session::put('message','Thay Đổi Thành Công');
        return redirect('/all-product');
    }
    public function edit_product($product_id){
        $this->AuthLogin();
//        $cate_product = DB::table('tbl_category_product')->orderby('category_id','desc')->get();
//        $brand_product = DB::table('tbl_brand_product')->orderby('brand_id','desc')->get();
        $cate_product = Category::orderby('category_id', 'desc')->get();
        $brand_product = Brand::orderby('brand_id', 'desc')->get();

//        $edit_product = DB::table('tbl_product')->where('product_id',$product_id)->get();
        $edit_product = Product::find($product_id);
        $manager_product = view('admin.edit_product')->with('edit_product',$edit_product)->with('cate_product',$cate_product)->with('brand_product',$brand_product);
        return view('admin_layout')->with('admin.edit_product',$manager_product);
    }
    public function update_product(Request $request,$product_id){
        $this->AuthLogin();
//        $data = array();
//        $data['product_name'] = $request->product_name;
//        $data['product_desc'] = $request->product_desc;
//        $data['product_price'] = $request->product_price;
//        $data['product_content'] = $request->product_content;
//        $data['category_id'] = $request->product_cate;
//        $data['brand_id'] = $request->product_brand;
//        $data['product_status'] = $request->product_status;
//        $get_image = $request->file('product_image');
//        if($get_image){
//            $get_name_image = $get_image->getClientOriginalName();
//            $name_image = current(explode('.',$get_name_image));
//            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
//            $get_image->move(public_path('uploads/product'), $new_image);
//            //   $get_image->storeAs('public/uploads/product', $new_image);
//            $data['product_image'] = $new_image;
//            DB::table('tbl_product')->where('product_id',$product_id)->update($data);
//            Session::put('message','Cập Nhật Sản Phẩm Thành Công');
//            return redirect('all-product');
//        }
//        DB::table('tbl_product')->where('product_id', $product_id)->update($data);
//        Session::put('message', 'Cập Nhật Sản Phẩm Thất Bại');
//        return redirect('/all-product');
//    }
//    public function delete_product($product_id){
//        $this->AuthLogin();
//        DB::table('tbl_product')->where('product_id',$product_id)->delete();
//        Session::put('message','Xoá Thành Công');
//        return redirect('/all-product');

        // Tìm sản phẩm theo ID
        $product = Product::find($product_id);

        // Cập nhật thông tin sản phẩm
        $product->product_name = $request->product_name;
        $product->product_desc = $request->product_desc;
        $product->product_price = $request->product_price;
        $product->product_content = $request->product_content;
        $product->category_id = $request->product_cate;
        $product->brand_id = $request->product_brand;
        $product->product_status = $request->product_status;

        // Xử lý ảnh sản phẩm (nếu có)
        if ($request->hasFile('product_image')) {
            $get_image = $request->file('product_image');
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = pathinfo($get_name_image, PATHINFO_FILENAME);
            $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move(public_path('uploads/product'), $new_image);

            // Cập nhật ảnh mới vào sản phẩm
            $product->product_image = $new_image;
        }

        // Lưu thay đổi
        $product->save();

        Session::put('message', 'Cập Nhật Sản Phẩm Thành Công');
        return redirect('/all-product');
    }
    public function delete_product($product_id) {
        $this->AuthLogin();

        // Tìm và xóa sản phẩm
        Product::find($product_id)->delete();

        Session::put('message', 'Xoá Thành Công');
        return redirect('/all-product');
    }

    // end function Admin page
    public function details_product(Request $request,$product_id){
//            $cate_product = DB::table('tbl_category_product')->orderby('category_id','desc')->get();
//            $brand_product = DB::table('tbl_brand_product')->orderby('brand_id','desc')->get();
//            $details_product = DB::table('tbl_product')
//                ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
//                ->join('tbl_brand_product','tbl_brand_product.brand_id','=','tbl_product.brand_id')
//                ->where('tbl_product.product_id',$product_id)->get();
//            // seo
//            $meta_desc = '';
//            $meta_brand_key = '';
//            $meta_title = '';
//            $url_canonical = $request->url();
//
//            foreach ($details_product as $key => $val) {
//                $meta_desc = $val->category_desc;
//                $meta_keywords = $val->meta_keywords;
//                $meta_title = $val->product_name;
//            }
//            // seo
//            return view('pages.sanpham.show_details')->with('category',$cate_product)
//                ->with('brand',$brand_product)->with('product_details',$details_product)
//                ->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)
//                ->with('meta_title',$meta_title)->with('url_canonical',$url_canonical);
//        }
        $cate_product = Category::orderBy('category_id', 'desc')->get();
        $brand_product = Brand::orderBy('brand_id', 'desc')->get();
        $details_product = Product::with(['category', 'brand'])
            ->where('product_id', $product_id)
            ->get();
        $url_canonical = $request->url();
        $meta_desc = $details_product->first()?->category?->category_desc ?? '';
        $meta_keywords = $details_product->first()?->category?->meta_keywords ?? '';
        $meta_title = $details_product->first()?->product_name ?? '';

        return view('pages.sanpham.show_details')->with('category',$cate_product)
               ->with('brand',$brand_product)->with('product_details',$details_product)
                ->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)
                ->with('meta_title',$meta_title)->with('url_canonical',$url_canonical);
    }
}
