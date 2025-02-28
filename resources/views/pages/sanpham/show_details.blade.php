@extends('layout')
@section('content')
    @foreach($product_details as $key => $value)
        <div class="product-details">
            <div class="col-sm-5">
                <div class="view-product">
                    <!-- Thêm thẻ <a> để FancyBox hoạt động -->
                    <a href="{{ URL::to('/uploads/product/'.$value->product_image) }}" data-fancybox="gallery">
                        <img id="zoom_01" src="{{ URL::to('/uploads/product/'.$value->product_image) }}"
                             data-zoom-image="{{ URL::to('/uploads/product/'.$value->product_image) }}" alt=""/>
                    </a>
                </div>
            </div>
            <div class="col-sm-7">
                <div class="product-information">
                    <img src="{{ URL::to('/frontend/images/new.jpg')}}" class="newarrival" alt="" />
                    <h2>{{$value->product_name}}</h2>
                    <p>ID Sản Phẩm: {{$value->product_id}}</p>
                    <img src="{{ URL::to('/frontend/images/rating.png')}}" alt="" />
                    <form action="{{URL::to('/save-cart')}}" method="POST">
                        {{csrf_field()}}
                        <span>
                    <span>{{number_format($value->product_price)}} VNĐ</span>
                    <label>Số Lượng:</label>
                    <input name="quantity" type="number" min="1" value="1" />
                    <input name="productid_hidden" type="hidden" value="{{$value->product_id}}" />
                    <button type="submit" class="btn btn-fefault cart">
                        <i class="fa fa-shopping-cart"></i>
                        Thêm Vào Giỏ Hàng
                    </button>
                </span>
                    </form>
                    <p><b>Tình Trạng:</b> Còn Hàng</p>
                    <p><b>Chất Lượng Sản Phẩm:</b> Mới 100%</p>
                    <p><b>Thương Hiệu:</b> {{$value->brand_name}}</p>
                    <p><b>Danh Mục:</b> {{$value->category_name}}</p>
                    <a href=""><img src="{{ URL::to('/frontend/images/share.png')}}" class="share img-responsive"  alt="" /></a>
                </div>
            </div>
        </div>

        <!-- Thêm script để khởi tạo chức năng zoom -->
        <script>
            $(document).ready(function(){
                // Kích hoạt Elevate Zoom
                $("#zoom_01").elevateZoom({
                    zoomType: "lens",
                    lensShape: "round",
                    lensSize: 200,
                    scrollZoom: true // Cho phép cuộn chuột để zoom
                });
                // Kích hoạt FancyBox khi ảnh được click
                $("[data-fancybox]").fancybox();
            });
        </script>
<div class="category-tab shop-details-tab"><!--category-tab-->
    <div class="col-sm-12">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#details" data-toggle="tab">Chi Tiết Sản Phẩm</a></li>
            <li><a href="#desc" data-toggle="tab">Mô Tả </a></li>
            <li><a href="#reviews" data-toggle="tab">Đánh Giá</a></li>
        </ul>
    </div>
    <div class="tab-content">
        <div class="tab-pane fade active in" id="details" >
            <p>{!!$value->product_content!!}</p>
        </div>
        <div class="tab-pane fade" id="desc" >
            <p>{!!$value->product_desc!!}</p>
        </div>
        <div class="tab-pane fade" id="reviews" >
            <div class="col-sm-12">
                <ul>
                    <li><a href=""><i class="fa fa-user"></i>EUGEN</a></li>
                    <li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
                    <li><a href=""><i class="fa fa-calendar-o"></i>31 DEC 2014</a></li>
                </ul>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                <p><b>Write Your Review</b></p>

                <form action="#">
										<span>
											<input type="text" placeholder="Your Name"/>
											<input type="email" placeholder="Email Address"/>
										</span>
                    <textarea name="" ></textarea>
                    <b>Rating: </b> <img src="{{ URL::to('/frontend/images/rating.png')}}" alt="" />
                    <button type="button" class="btn btn-default pull-right">
                        Submit
                    </button>
                </form>
            </div>
        </div>
    </div>
        <div class = "fb-comments" id="comments" data-href = "{{$url_canonical}}" data-width = "820" data-numposts = "12" ></div>
    </div>

    </div>
</div><!--/category-tab-->
@endforeach
<div class="recommended_items"><!--recommended_items-->
    <h2 class="title text-center">Sản Phẩm Liên Quan</h2>

    <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="item active">
                <div class="col-sm-4">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="{{ URL::to('/uploads/product/'.$value->product_image)}}" alt="" />
                                <h2>$56</h2>
                                <p>Easy Polo Black Edition</p>
                                <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="{{ URL::to('/uploads/product/'.$value->product_image)}}" alt="" />
                                <h2>$56</h2>
                                <p>Easy Polo Black Edition</p>
                                <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="{{ URL::to('/uploads/product/'.$value->product_image)}}" alt="" />
                                <h2>$56</h2>
                                <p>Easy Polo Black Edition</p>
                                <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="col-sm-4">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="{{ URL::to('/uploads/product/'.$value->product_image)}}   " alt="" />
                                <h2>$56</h2>
                                <p>Easy Polo Black Edition</p>
                                <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
            <i class="fa fa-angle-left"></i>
        </a>
        <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
            <i class="fa fa-angle-right"></i>
        </a>
    </div>
</div><!--/recommended_items-->

@endsection


