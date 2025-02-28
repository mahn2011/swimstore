@extends('layout')
@section('content')


    <section id="cart_items">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="{{URL::to('/')}}">Trang Chủ</a></li>
                <li class="active">Giỏ Hàng Của Bạn</li>
            </ol>
        </div>

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


        <section id="do_action">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="total_area">
                            <ul>
                                <li>Tổng Tiền Hàng: <span id="subtotal_price">{{ number_format(\Cart::getSubTotal(), 0, '.', '.') }} VNĐ</span></li>
                                <li>Thuế (10%): <span id="tax_price">{{ number_format(\Cart::getSubTotal() * 0.1, 0, '.', '.') }} VNĐ</span></li>
                                <li>Phí Ship: <span>Miễn Phí Vận Chuyển</span></li>
                                <li>Tổng Thanh Toán: <span id="total_price">{{ number_format(\Cart::getSubTotal() * 1.1, 0, '.', '.') }} VNĐ</span></li>
                            </ul>
                            <?php
                            $customer_id = Session::get('customer_id');
                            ?>
                            <li>
                                <?php if ($customer_id != NULL) { ?>
                                <a class="btn btn-default check_out" href="{{URL::to('/checkout')}}">Thanh Toán</a>
                                <?php } else { ?>
                                <a class="btn btn-default check_out" href="{{URL::to('/login-checkout')}}">Thanh Toán</a>
                                <?php } ?>
                            </li>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Thêm JavaScript AJAX để cập nhật số lượng -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {
                console.log("jQuery đã được tải thành công!");

                $(".cart_quantity_up, .cart_quantity_down").click(function(e) {
                    e.preventDefault();

                    let cartId = $(this).data("id"); // Lấy ID sản phẩm trong giỏ hàng
                    let action = $(this).hasClass("cart_quantity_up") ? 1 : -1; // Xác định tăng hay giảm số lượng
                    let quantityInput = $("#quantity_" + cartId);
                    let newQuantity = parseInt(quantityInput.val()) + action;

                    if (newQuantity < 1) return; // Không cho giảm dưới 1

                    $.ajax({
                        url: "{{ route('cart.update_quantity') }}",
                        method: "POST",
                        data: {
                            _token: "{{ csrf_token() }}",
                            cart_id: cartId,
                            quantity: newQuantity
                        },
                        success: function(response) {
                            if (response.success) {
                                quantityInput.val(newQuantity); // Cập nhật số lượng trên giao diện
                                $("#total_" + cartId).text(response.item_total); // Cập nhật tổng tiền sản phẩm
                                $("#total_price").text(response.total); // Cập nhật tổng tiền giỏ hàng
                                $("#subtotal_price").text(response.subtotal); // Cập nhật tổng phụ
                                $("#tax_price").text(response.tax); // Cập nhật thuế
                            } else {
                                alert("Lỗi: " + response.message);
                            }
                        },
                        error: function(xhr, status, error) {
                            console.log(xhr.responseText);
                            alert("Có lỗi xảy ra khi cập nhật số lượng!");
                        }
                    });
                });
            });
        </script>


@endsection
