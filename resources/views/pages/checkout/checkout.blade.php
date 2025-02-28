@extends('layout')
@section('content')


<section id="cart_items">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="{{URL::to('/')}}">Trang Chủ</a></li>
                <li class="active">Giỏ Hàng Của Bạn</li>
            </ol>
        </div>


        <div class="shopper-informations">
            <div class="row">
                <div class="col-sm-16 clearfix">
                    <div class="bill-to">
                        <p>Thông Tin Người Nhận</p>
                        <div class="form-one">
                            <form action="{{URL::to('/save-checkout-customer')}}" method="POST">
                                {{ csrf_field() }}
                                <input type="text" name="shipping_email" placeholder="Email">
                                <input type="text" name="shipping_name" placeholder="Tên Người Nhận">
                                <input type="text" name="shipping_address" placeholder="Địa Chỉ">
                                <input type="text" name="shipping_phone" placeholder="Số Điện Thoại">
                                <textarea name="shipping_notes"  placeholder="Ghi Chú Cho Đơn Hàng" rows="16"></textarea>
                                <input type="submit" value="Gửi" name="send_order" class="btn btn-primary btn-sm ">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
{{--        <div class="review-payment">--}}
{{--            <h2>Xem Lại Giỏ Hàng</h2>--}}
{{--        </div>--}}
{{--        <div class="payment-options">--}}
{{--					<span>--}}
{{--						<label><input type="checkbox"> Direct Bank Transfer</label>--}}
{{--					</span>--}}
{{--            <span>--}}
{{--						<label><input type="checkbox"> Check Payment</label>--}}
{{--					</span>--}}
{{--            <span>--}}
{{--						<label><input type="checkbox"> Paypal</label>--}}
{{--					</span>--}}
{{--        </div>--}}
    </div>
</section> <!--/#cart_items-->
@endsection
