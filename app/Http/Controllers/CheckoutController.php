<?php
namespace App\Http\Controllers;

use Darryldecode\Cart\Facades\CartFacade as Cart;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Customer;
use App\Models\Shipping;
use App\Models\Payment;
use App\Models\Category;
use App\Models\Brand;
class CheckoutController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('/dashboard');
        }else {
            return Redirect::to('/admin')->send();
        }
    }
    public function view_order($orderID){
        $this->AuthLogin();

//        // Lấy thông tin khách hàng, đơn hàng, vận chuyển (chỉ lấy một bản ghi)
//        $order_by_id = DB::table('tbl_order')
//            ->join('tbl_customer', 'tbl_order.customer_id', '=', 'tbl_customer.customer_id')
//            ->join('tbl_shipping', 'tbl_order.shipping_id', '=', 'tbl_shipping.shipping_id')
//            ->where('tbl_order.order_id', $orderID)
//            ->select('tbl_order.*', 'tbl_customer.*', 'tbl_shipping.*')
//            ->first(); // Lấy 1 bản ghi duy nhất
//
//        // Lấy danh sách sản phẩm (nhiều bản ghi)
//        $order_details = DB::table('tbl_order_details')
//            ->join('tbl_product', 'tbl_order_details.product_id', '=', 'tbl_product.product_id')
//            ->where('tbl_order_details.order_id', $orderID)
//            ->select('tbl_order_details.*', 'tbl_product.product_name', 'tbl_product.product_price')
//            ->get(); // Lấy danh sách sản phẩm
//        return view('admin.view_order', compact('order_by_id', 'order_details'));
        $order = Order::with(['customer', 'shipping', 'orderDetails.product'])->where('order_id', $orderID)->first();

        return view('admin.view_order', compact('order'));
    }

    public function login_checkout(Request $request){
        $meta_desc = "Đăng nhập tài khoản để có trải nghiệm tốt nhất!";
        $meta_keywords = " ";
        $meta_title = 'Trang đăng nhập!!!';
        $url_canonical = $request->url();
//        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
//        $brand_product = DB::table('tbl_brand_product')->where('brand_status','1')->orderby('brand_id','desc')->get();
        $cate_product = Category::where('category_status', 1)->orderByDesc('category_id')->get();
        $brand_product = Brand::where('brand_status', 1)->orderByDesc('brand_id')->get();
        return view('pages.checkout.login_checkout')->with('category',$cate_product)->with('brand',$brand_product)
                ->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical);
    }
    public function add_customer(Request $request){
//        $data = array();
//        $data['customer_name']=$request->customer_name;
//        $data['customer_email']=$request->customer_email;
//        $data['customer_phone']=$request->customer_phone;
//        $data['customer_password']=md5($request->customer_password);
//        $customer_id = DB::table('tbl_customer')->insertGetId($data);
        $customer = new Customer();
        $customer->customer_name = $request->customer_name;
        $customer->customer_email = $request->customer_email;
        $customer->customer_phone = $request->customer_phone;
        $customer->customer_password = md5($request->customer_password);
        $customer->save();
        Session::put('customer_id',$customer->customer_id);
        Session::put('customer_name',$customer->customer_name);
        return Redirect::to('/checkout');
    }
    public function checkout(Request $request){
        $meta_desc = " ";
        $meta_keywords = " ";
        $meta_title = 'Thêm Thông Tin Người Nhận!!!';
        $url_canonical = $request->url();
//        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
//        $brand_product = DB::table('tbl_brand_product')->where('brand_status','1')->orderby('brand_id','desc')->get();
        $cate_product = Category::where('category_status', 1)->orderByDesc('category_id')->get();
        $brand_product = Brand::where('brand_status', 1)->orderByDesc('brand_id')->get();
        return view('pages.checkout.checkout')->with('category',$cate_product)->with('brand',$brand_product)
            ->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical);
    }
    public function save_checkout_customer(Request $request){
//        $data = array();
//        $data['shipping_name']=$request->shipping_name;
//        $data['shipping_email']=$request->shipping_email;
//        $data['shipping_phone']=$request->shipping_phone;
//        $data['shipping_notes']=$request->shipping_notes;
//        $data['shipping_address']=$request->shipping_address;
//        $shipping_id = DB::table('tbl_shipping')->insertGetId($data);
        $shipping = new Shipping();
        $shipping->shipping_name = $request->shipping_name;
        $shipping->shipping_email = $request->shipping_email;
        $shipping->shipping_phone = $request->shipping_phone;
        $shipping->shipping_notes = $request->shipping_notes;
        $shipping->shipping_address = $request->shipping_address;
        $shipping->save();
        Session::put('shipping_id',$shipping->shipping_id);
        return Redirect::to('/payment');
    }
    public function payment(Request $request){
        $meta_desc = " ";
        $meta_keywords = " ";
        $meta_title = 'Chọn Hình Thức Thanh Toán!!!';
        $url_canonical = $request->url();
//        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
//        $brand_product = DB::table('tbl_brand_product')->where('brand_status','1')->orderby('brand_id','desc')->get();
        $cate_product = Category::where('category_status', 1)->orderByDesc('category_id')->get();
        $brand_product = Brand::where('brand_status', 1)->orderByDesc('brand_id')->get();
        return view('pages.checkout.payment')->with('category',$cate_product)->with('brand',$brand_product)
            ->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)
            ->with('meta_title',$meta_title)->with('url_canonical',$url_canonical);
    }
    public function order_place(Request $request){
        // insert payment_method dùng controller truy vấn DB trực tiếp
//        $data = array();
//        $data['payment_method']=$request->payment_option;
//        $data['payment_status']='Đang Chờ Xử Lý';
//        $payment_id = DB::table('tbl_payment')->insertGetId($data);
//        $meta_desc = " ";
//        $meta_keywords = " ";
//        $meta_title = 'SwimWear-Store';
//        $url_canonical = $request->url();
//        // Tính tổng tiền hàng
//        $subtotal = \Cart::getSubTotal(); // Không có dấu phân cách
//        $tax = $subtotal * 0.1; // Thuế 10%
//        $shipping_fee = 0; // Miễn phí vận chuyển
//        $total = $subtotal + $tax + $shipping_fee; // Tổng thanh toán
//
//        // insert order
//        $order_data = array();
//        $order_data['customer_id']=Session::get('customer_id');
//        $order_data['shipping_id']=Session::get('shipping_id');
//        $order_data['payment_id']=$payment_id;
//        $order_data['order_total']=$total;
//        $order_data['order_status']='Đang Chờ Xử Lý';
//        $order_id = DB::table('tbl_order')->insertGetId($order_data);
//
//        // insert order_details
//        $content = \Cart::getContent();
//        foreach ($content as $v_content) {
//            $data = array();
//            $order_d_data['order_id']=$order_id;
//            $order_d_data['product_id']=$v_content->id;
//            $order_d_data['product_name']=$v_content->name;
//            $order_d_data['product_price']=$v_content->price;
//            $order_d_data['product_sales_quantity']=$v_content->quantity;
//            DB::table('tbl_order_details')->insert($order_d_data);
//        }
//        $payment = DB::table('tbl_payment')->where('payment_id', $payment_id)->first();
//
//        if ($payment->payment_method == '1') {
//            \Cart::clear();
//            $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
//            $brand_product = DB::table('tbl_brand_product')->where('brand_status','1')->orderby('brand_id','desc')->get();
//            return view('pages.checkout.handcash')->with('category',$cate_product)->with('brand',$brand_product)
//                ->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)
//                ->with('meta_title',$meta_title)->with('url_canonical',$url_canonical);
//        } elseif ($payment->payment_method == '2') {
//            echo 'VnPay';
//        } else {
//            echo 'Paypal';
//        }

        //   return Redirect::to('/payment');
        // Dùng Model để truy vấn
        $meta_desc = " ";
        $meta_keywords = " ";
        $meta_title = 'SwimWear-Store';
        $url_canonical = $request->url();
        // Thêm thông tin thanh toán
        $payment = new Payment();
        $payment->payment_method = $request->payment_option;
        $payment->payment_status = 'Đang Chờ Xử Lý';
        $payment->save();

        // Tính tổng tiền hàng
        $subtotal = Cart::getSubTotal();
        $tax = $subtotal * 0.1;
        $shipping_fee = 0;
        $total = $subtotal + $tax + $shipping_fee;

        // Tạo đơn hàng
        $order = new Order();
        $order->customer_id = Session::get('customer_id');
        $order->shipping_id = Session::get('shipping_id');
        $order->payment_id = $payment->payment_id;
        $order->order_total = $total;
        $order->order_status = 'Đang Chờ Xử Lý';
        $order->save();

        // Lưu chi tiết đơn hàng
        foreach (Cart::getContent() as $item) {
            $orderDetail = new OrderDetail();
            $orderDetail->order_id = $order->order_id;
            $orderDetail->product_id = $item->id;
            $orderDetail->product_name = $item->name;
            $orderDetail->product_price = $item->price;
            $orderDetail->product_sales_quantity = $item->quantity;
            $orderDetail->save();
        }

        // Xử lý phương thức thanh toánnnn
        Cart::clear();
        if ($payment->payment_method == '1') {
            $cate_product = Category::where('category_status', 1)->orderBy('category_id', 'desc')->get();
            $brand_product = Brand::where('brand_status', 1)->orderBy('brand_id', 'desc')->get();
            return view('pages.checkout.handcash')->with('category',$cate_product)->with('brand',$brand_product)
                ->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)
                ->with('meta_title',$meta_title)->with('url_canonical',$url_canonical);
        } elseif ($payment->payment_method == '2') {
            return redirect('/vnpay');
        } else {
            return redirect('/paypal');
        }
    }
    public function logout_checkout(){
        Session::flush();
        return Redirect::to('/login-checkout');
    }
    public function login_customer(Request $request){
//        $email = $request->email_account;
//        $password = md5($request->password_account);
//        $result = DB::table('tbl_customer')->where('customer_email',$email)->where('customer_password',$password)->first();
//        if($result){
//            Session::put('customer_id',$result->customer_id);
//            return Redirect::to('/checkout');
//        }else{
//            return Redirect::to('/login-checkout');
//        }
        $customer = Customer::where('customer_email', $request->email_account)
            ->where('customer_password', md5($request->password_account))
            ->first();

        if ($customer) {
            Session::put('customer_id', $customer->customer_id);
            return Redirect::to('/checkout');
        } else {
            return Redirect::to('/login-checkout');
        }
    }
    public function manager_order(){
        $this->AuthLogin();
//        $all_order = DB::table('tbl_order')
//            ->join('tbl_customer','tbl_order.customer_id','=','tbl_customer.customer_id')
//            ->select('tbl_order.*','tbl_customer.customer_name')
//            ->orderby('tbl_order.order_id','desc')->get();
//        $manager_order = view('admin.manager_order')->with('all_order',$all_order);
        $orders = Order::with('customer')->orderByDesc('order_id')->get();
//        return view('admin_layout')->with('admin.manager_order',$manager_order);
        return view('admin.manager_order', compact('orders'));
    }
}
