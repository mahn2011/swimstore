@extends('layout')
@section('content')


    <section id="cart_items">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="{{URL::to('/')}}">Trang Chủ</a></li>
                <li class="active">Thanh Toán Giỏ Hàng</li>
            </ol>
        </div>
        <div class="review-payment">
            <h2>Xem Lại Giỏ Hàng</h2>
            <div class="table-responsive cart_info">
                <?php $content = Cart::getContent(); ?>
                <table class="table table-condensed">
                    <thead>
                    <tr class="cart_menu">
                        <td class="image">Hình Ảnh</td>
                        <td class="description">Mô Tả</td>
                        <td class="price">Giá Tiền</td>
                        <td class="quantity">Số Lượng</td>
                        <td class="total">Tổng Tiền</td>
                        <td></td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($content as $v_content)
                        <tr>
                            <td class="cart_product">
                                <a href=""><img src="{{ asset('uploads/product/'.$v_content->attributes->image) }}" width="150" alt="" /></a>
                            </td>
                            <td class="cart_description">
                                <h4><a href="">{{$v_content->name}}</a></h4>
                                <p>ID Sản Phẩm: {{$v_content->id}}</p>
                            </td>
                            <td class="cart_price">
                                <p>{{number_format($v_content->price)}} VNĐ</p>
                            </td>
                            <td class="cart_quantity">
                                <div class="cart_quantity_button">
                                    <button class="cart_quantity_up" data-id="{{ $v_content->id }}"> + </button>
                                    <input class="cart_quantity_input" type="text" id="quantity_{{ $v_content->id }}" value="{{ $v_content->quantity }}" autocomplete="off" size="2" readonly>
                                    <button class="cart_quantity_down" data-id="{{ $v_content->id }}"> - </button>
                                </div>
                            </td>
                            <td class="cart_total">
                                <p class="cart_total_price" id="total_{{ $v_content->id }}">
                                    {{ number_format($v_content->price * $v_content->quantity) }} VNĐ
                                </p>
                            </td>
                            <td class="cart_delete">
                                <a class="cart_quantity_delete" href="{{URL::to('/delete-to-cart/'.md5($v_content->id))}}"><i class="fa fa-times"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <h4 style="margin: 40px 0; font-size: 20px;">Chọn Hình Thức Thanh Toán</h4>
        <form method="POST" action="{{URL::to('/order-place')}}">
            {{csrf_field()}}
        <div class="payment-options">
					<span>
						<label><input type="radio" name="payment_option" value="1" > Thanh Toán Tiền Mặt</label>
					</span>
            <span>
						<label><input type="radio" name="payment_option" value="2" > Thanh Toán VnPay</label>
					</span>
            <span>
						<label><input type="radio" name="payment_option" value="3"> Paypal</label>
					</span>
            <input type="submit" value="Đặt Hàng" name="send_order_place" class="btn btn-primary btn-sm">
        </div>
        </form>
        </div>
    </section> <!--/#cart_items-->
@endsection

