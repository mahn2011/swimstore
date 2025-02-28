@extends('layout')
@section('content')

    <div class="features_items"><!--features_items-->
        <h2 class="title text-center">Kết Quả Tìm Kiếm</h2>
        @foreach($search_product as $key => $product)
            <div class="col-sm-4">
                <div class="product-image-wrapper">
                    <div class="single-products">
                        <div class="productinfo text-center">
                            <a href="{{URL::to('/chi-tiet-san-pham/'.$product->product_id)}}">
                                <img src="{{ asset('uploads/product/'.$product->product_image) }}" alt="{{$product->product_name}}" />
                            </a>
                            <h2>{{number_format($product->product_price).' '.'VNĐ'}}</h2>
                            <a href="{{URL::to('/chi-tiet-san-pham/'.$product->product_id)}}">
                                <p>{{$product->product_name}}</p>
                            </a>
                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm Vào Giỏ Hàng</a>
                        </div>
                    </div>
                    <div class="choose">
                        <ul class="nav nav-pills nav-justified">
                            <li><a href="#"><i class="fa fa-heart-o"></i>Yêu Thích</a></li>
                            <li><a href="#"><i class="fa fa-plus-square"></i>Thêm Thông Tin</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        @endforeach
    </div><!--features_items-->

@endsection

