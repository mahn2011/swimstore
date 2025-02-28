<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
class HomeController extends Controller
{
    public function index(Request $request)
    {
        // seo
        $meta_desc = "Các mẫu đồ bơi thời trang đẹp, kín đáo 2024 từ Calvin Klein, Mango, Nike, ..... được ACFC phân phối độc quyền với nhiều khuyến mãi hấp dẫn. Giao hàng tận nơi.";
        $meta_keywords = "Áo bơi, quần bơi, kính bơi, chân vịt";
        $meta_title = "Phụ kiện bơi thời trang , phù hợp mọi lứa tuổi";
        $url_canonical = $request->url();
        // seo
//        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
//        $brand_product = DB::table('tbl_brand_product')->where('brand_status','1')->orderby('brand_id','desc')->get();
//        $all_product = DB::table('tbl_product')->where('product_status','1')->orderby('product_id','desc')->limit(9)->get();
        $cate_product = Category::where('category_status', 1)->orderBy('category_id', 'desc')->get();
        $brand_product = Brand::where('brand_status', 1)->orderBy('brand_id', 'desc')->get();
        $all_product = Product::where('product_status', 1)->orderBy('product_id', 'desc')->limit(9)->get();
        return view('pages.home')->with('category',$cate_product)->with('brand',$brand_product)->with('all_product',$all_product)
            ->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical);
    }
    public function search(Request $request)
    {
        $keywords = $request->keywords_submit;
//        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
//        $brand_product = DB::table('tbl_brand_product')->where('brand_status','1')->orderby('brand_id','desc')->get();
//        $search_product = DB::table('tbl_product')->where('product_name','like','%'.$keywords.'%')->get();
        $cate_product = Category::where('category_status', 1)->orderBy('category_id', 'desc')->get();
        $brand_product = Brand::where('brand_status', 1)->orderBy('brand_id', 'desc')->get();
        $search_product = Product::where('product_name', 'like', '%' . $keywords . '%')->get();
        return view('pages.sanpham.search')->with('category',$cate_product)->with('brand',$brand_product)->with('search_product',$search_product);
    }
}
