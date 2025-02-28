<?php

namespace App\Http\Controllers;

use Darryldecode\Cart\Facades\CartFacade as Cart;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Order;
use Illuminate\Support\Facades\Redirect;
class CartController extends Controller
{
    public function save_cart(Request $request)
    {
        $productId = $request->productid_hidden;
        $quantity = $request->quantity;
//        $product_info= DB::table('tbl_product')->where('product_id',$productId)->first();
        $product = Product::find($productId);
//        $data = [
//            'id' => $product_info->product_id,
//            'name' => $product_info->product_name,
//            'price' => $product_info->product_price,
//            'quantity' => $quantity,
//            'attributes' => [
//                'weight' => $product_info->product_desc,
//                'image' => $product_info->product_image
//            ]
//        ];
        $data = [
            'id' => $product->product_id,
            'name' => $product->product_name,
            'price' => $product->product_price,
            'quantity' => $quantity,
            'attributes' => [
                'weight' => $product->product_desc,
                'image' => $product->product_image
            ]
        ];
         Cart::add($data);
         return Redirect::to('/show_cart');
    }

    public function show_cart(Request $request){
//        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
//        $brand_product = DB::table('tbl_brand_product')->where('brand_status','1')->orderby('brand_id','desc')->get();
        $cate_product = Category::where('category_status', 1)->orderBy('category_id', 'desc')->get();
        $brand_product = Brand::where('brand_status', 1)->orderBy('brand_id', 'desc')->get();

        $subtotal = Cart::getSubtotal(); // Lấy tổng tiền sản phẩm
        $tax = $subtotal * 0.1; //0.1 là % thuế (=10%)
        $total = Cart::getTotal() + $tax; // Cộng thuế vào tổng tiền
        // seo
        $meta_desc = "Giỏ hàng của bạn tại cửa hàng chúng tôi. Kiểm tra và thanh toán ngay!";
        $meta_keywords = "Giỏ hàng, mua sắm, thanh toán, sản phẩm, cửa hàng trực tuyến";
        $meta_title = 'Giỏ hàng của bạn!!!';
        $url_canonical = $request->url();
        // compact tương đương with
        return view('pages.cart.show_cart', compact('subtotal', 'tax', 'total', 'meta_desc', 'meta_keywords','url_canonical','meta_title'))
            ->with('category',$cate_product)->with('brand',$brand_product);

    }
    public function delete_cart($id)
    {
        $content = Cart::getContent();

        // Tìm sản phẩm có MD5(id) trùng khớp
        foreach ($content as $v_content) {
            if (md5($v_content->id) === $id) {
                Cart::remove($v_content->id); // Xóa theo ID
                break;
            }
        }

        return redirect::to('/show_cart');
    }
    public function update_cart_quantity(Request $request)
    {
        $id = $request->cart_id; // Nhận ID sản phẩm
        $quantity = $request->quantity; // Nhận số lượng mới

        // Kiểm tra xem sản phẩm có tồn tại trong giỏ hàng không
        $cartItem = Cart::get($id);
        if (!$cartItem) {
            return response()->json([
                'success' => false,
                'message' => 'Sản phẩm không tồn tại trong giỏ hàng!'
            ]);
        }

        // Cập nhật số lượng sản phẩm
        Cart::update($id, [
            'quantity' => ['relative' => false, 'value' => $quantity]
        ]);

        // Tính toán lại giá trị
        $subtotal = Cart::getSubtotal(); // Tổng phụ
        $tax = $subtotal * 0.1; // Thuế 10% (có thể điều chỉnh)
        $total = $subtotal + $tax; // Tổng tiền sau thuế

        return response()->json([
            'success' => true,
            'total' => number_format($total) . ' VNĐ', // Tổng tiền giỏ hàng
            'subtotal' => number_format($subtotal) . ' VNĐ', // Tổng phụ
            'tax' => number_format($tax) . ' VNĐ', // Thuế
            'item_total' => number_format(Cart::get($id)->price * Cart::get($id)->quantity) . ' VNĐ' // Tổng tiền của sản phẩm
        ]);
    }
    public function show_paid_orders(Request $request)
    {
        $meta_desc = " ";
        $meta_keywords = " ";
        $meta_title = 'Đơn Mua';
        $url_canonical = $request->url();
        $cate_product = Category::where('category_status', 1)->orderByDesc('category_id')->get();
        $brand_product = Brand::where('brand_status', 1)->orderByDesc('brand_id')->get();
        // Lấy danh sách đơn hàng đã thanh toán (payment_status = 1)
        $orders = Order::where('order_status', 'Đang Chờ Xử Lý')->orderBy('order_id', 'desc')->get();

        return view('pages.cart.paid_orders')->with('orders', $orders)
            ->with('category',$cate_product)->with('brand',$brand_product)
            ->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)
            ->with('meta_title',$meta_title)->with('url_canonical',$url_canonical);
    }
}
