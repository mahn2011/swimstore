<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
//use MongoDB\Driver\Session;

class CategoryProduct extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('/dashboard');
        }else {
            return Redirect::to('/admin')->send();
        }
    }
    public function add_category_product(){
        $this->AuthLogin();
        return view('admin.add_category_product');
    }
    public function all_category_product(){
        $this->AuthLogin();
        $all_category_product = Category::orderBy('category_id','DESC')->get();
        $manager_category_product = view('admin.all_category_product')->with('all_category_product',$all_category_product);
        return view('admin_layout')->with('admin.all_category_product',$manager_category_product);
    }
    public function save_category_product(Request $request){
        $this->AuthLogin();
//        $data = array();
//        $data['category_name'] = $request->category_product_name;
//        $data['meta_keywords'] = $request->category_product_keywords;
//        $data['category_desc'] = $request->category_product_desc;
//        $data['category_status'] = $request->category_product_status;
//        DB::table('tbl_category_product')->insert($data);
        $data = $request->all();
        $category = new Category();
        $category->category_name = $data['category_product_name'];
        $category->meta_keywords = $data['category_product_keywords'];
        $category->category_desc = $data['category_product_desc'];
        $category->category_status = $data['category_product_status'];
        $category->save();
        Session::put('message','Thêm Danh Mục Sản Phẩm Thành Công');
        return redirect('/add-category-product');
    }
    public function unactive_category_product($category_product_id){
        $this->AuthLogin();
//        DB::table('tbl_category_product')->where('category_id',$category_product_id)->update(['category_status'=>0]);
        $category = Category::find($category_product_id);
        $category->category_status = 0;
        $category->save();
        Session::put('message','Đóng Hoạt Động Thương Hiệu Thành Công!!!');
        return redirect('/all-category-product');
    }
    public function active_category_product($category_product_id){
        $this->AuthLogin();
//        DB::table('tbl_category_product')->where('category_id',$category_product_id)->update(['category_status'=>1]);
        $category = Category::find($category_product_id);
        $category->category_status = 1;
        $category->save();
        Session::put('message','Thay Đổi Thành Công');
        return redirect('/all-category-product');
    }
    public function edit_category_product($category_product_id){
        $this->AuthLogin();
//        $edit_category_product = DB::table('tbl_category_product')->where('category_id',$category_product_id)->get();
        $edit_category_product = Category::find($category_product_id);
        $manager_category_product = view('admin.edit_category_product')->with('edit_category_product',$edit_category_product);
        return view('admin_layout')->with('admin.edit_category_product',$manager_category_product);
    }
    public function update_category_product(Request $request,$category_product_id){
        $this->AuthLogin();
//        $data = array();
//        $data['category_name'] = $request->category_product_name;
//        $data['meta_keywords'] = $request->category_product_keywords;
//        $data['category_desc'] = $request->category_product_desc;
//        DB::table('tbl_category_product')->where('category_id',$category_product_id)->update($data);
        $data = $request->all();
        $category = Category::find($category_product_id);
        $category->category_name = $data['category_product_name'];
        $category->meta_keywords = $data['category_product_keywords'];
        $category->category_desc = $data['category_product_desc'];
        $category->save();
        Session::put('message','Cập Nhật Thành Công');
        return redirect('/all-category-product');
    }
    public function delete_category_product($category_product_id){
        $this->AuthLogin();
//        DB::table('tbl_category_product')->where('category_id',$category_product_id)->delete();
        Category::find($category_product_id)->delete();
        Session::put('message','Xoá Thành Công');
        return redirect('/all-category-product');
    }
    // end function Admin page
    public function show_category_home(Request $request,$category_id){

//        $cate_product = DB::table('tbl_category_product')->orderby('category_id','desc')->get();
//        $brand_product = DB::table('tbl_brand_product')->orderby('brand_id','desc')->get();
//        $category_by_id = DB::table('tbl_product')
//            ->join('tbl_category_product','tbl_product.category_id','=','tbl_category_product.category_id')
//            ->where('tbl_product.category_id',$category_id)->get();
        $cate_product = Category::orderBy('category_id', 'desc')->get();
        $brand_product = Brand::orderBy('brand_id', 'desc')->get();
        $category_by_id = Product::with('category')
            ->where('category_id', $category_id)
            ->get();
        // seo
        $meta_desc = '';
        $meta_brand_key = '';
        $meta_title = '';
        $url_canonical = $request->url();

        if ($category_by_id->isNotEmpty()) {
            $meta_desc = $category_by_id->first()->category->category_desc ?? '';
            $meta_keywords = $category_by_id->first()->category->meta_keywords ?? '';
            $meta_title = $category_by_id->first()->category->category_name ?? '';
        }
        // seo
        $category_name = Category::where('category_id', $category_id)->first();
//        return view('pages.category.show_category')->with('category',$cate_product)
//            ->with('brand',$brand_product)->with('category_by_id',$category_by_id)->with('category_name',$category_name)
//        ->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical);
        return view('pages.category.show_category', [
            'category' => $cate_product,
            'brand' => $brand_product,
            'category_by_id' => $category_by_id,
            'category_name' => $category_name,
            'meta_desc' => $meta_desc,
            'meta_keywords' => $meta_keywords,
            'meta_title' => $meta_title,
            'url_canonical' => $url_canonical,
        ]);
    }
}
