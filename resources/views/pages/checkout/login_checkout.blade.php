@extends('layout')
@section('content')
    <section id="form"><!--form-->
        <div class="container">
            <div class="row">
                <div class="register-req">
                    <p>Vui lòng đăng nhập trước khi thanh toán để xem lịch sử mua hàng</p>
                </div><!--/register-req-->
                <div class="col-sm-4 col-sm-offset-1">
                    <div class="login-form"><!--login form-->
                        <h2>Đăng Nhập Tài Khoản Của Bạn</h2>
                        <form action="{{URL::to('/login-customer')}}" method="POST" >
                            {{csrf_field()}}
                            <input type="text" name="email_account" placeholder="Email Của Bạn" />
                            <input type="password" name="password_account" placeholder="Mật Khẩu" />
                            <span>
								<input type="checkbox" class="checkbox">
								Nhớ Mật Khẩu
							</span>
                            <button type="submit" class="btn btn-default">Đăng Nhập</button>
                        </form>
                    </div><!--/login form-->
                </div>
                <div class="col-sm-1">
                    <h2 class="or">Hoặc</h2>
                </div>
                <div class="col-sm-4">
                    <div class="signup-form"><!--sign up form-->
                        <h2>Đăng Kí</h2>
                        <form action="{{URL::to('/add-customer')}}" method="POST">
                            {{csrf_field()}}
                            <input type="text" name="customer_name" placeholder="Tên Đăng Nhập"/>
                            <input type="email" name="customer_email" placeholder="Email"/>
                            <input type="password" name="customer_password" placeholder="Mật Khẩu"/>
                            <input type="text" name="customer_phone" placeholder="Số Điện Thoại"/>
                            <button type="submit" class="btn btn-default">Đăng Kí</button>
                        </form>
                    </div><!--/sign up form-->
                </div>
            </div>
        </div>
    </section><!--/form-->


@endsection
