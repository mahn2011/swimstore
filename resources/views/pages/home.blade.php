@extends('layout')
@section('content')
<div class="features_items"><!--features_items-->
    <div class="fb-share-button" data-href="http://127.0.0.1:8000/" data-layout="" data-size="">
        <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{$url_canonical}}&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Chia sẻ</a></div>
    <h2 class="title text-center">Sản Phẩm Mới Nhất</h2>
            @foreach($all_product as $key => $product)
            <a href="{{URL::to('/chi-tiet-san-pham/'.$product->product_id)}}">
            <div class="col-sm-4">
                <div class="product-image-wrapper">
                    <div class="single-products">
                        <div class="productinfo text-center">
    {{--                        <img src="{{ URL::to('public/uploads/product/'.$product->product_image) }}" alt="" />--}}
                            <img src="{{ asset('uploads/product/'.$product->product_image) }}" alt="" />
                            <h2>{{number_format($product->product_price).' '.'VNĐ'}}</h2>
                            <p>{{$product->product_name}}</p>
                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm Vào Giỏ Hàng</a>
                        </div>
    {{--                    <div class="product-overlay">--}}
    {{--                        <div class="overlay-content">--}}
    {{--                            <h2>{{number_format($product->product_price).' '.'VNĐ'}}</h2>--}}
    {{--                            <p>{{$product->product_name}}</p>--}}
    {{--                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm Vào Giỏ Hàng</a>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
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
