@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Cập Nhật Sản Phẩm
                </header>
                <div class="panel-body">
                    <?php
                    $message = Session::get('message');
                    if($message){
                        echo '<span class="text-alert">'.$message.'</span>';
                        Session::Put('message', null);
                    }
                    ?>
{{--                    @foreach($edit_product as $key => $produc)--}}

                        <div class="position-center">
                            <form role="form" action="{{URL::to('/update-product/'.$edit_product->product_id)}}" method="post">
                                {{ csrf_field()}}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên Sản Phẩm</label>
                                    <input type="text" value="{{$edit_product->product_name}}" name="product_name" class="form-control" id="exampleInputEmail1">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Giá Sản Phẩm</label>
                                    <input type="text" value="{{$edit_product->product_price}}" name="product_price" class="form-control" id="exampleInputEmail1">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Hình Ảnh Sản Phẩm</label>
                                    <input type="file" name="product_image" class="form-control" id="exampleInputEmail1" enctype="multipart/form-data">
{{--                                    <img src="{{ URL::to('uploads/product/'.$produc->product_image)}}" height="100" width="100">--}}
                                    <td>
                                        <img src="{{ URL::to('/uploads/product/'.$edit_product->product_image) }}" height="100" width="100" alt="Product Image">
                                    </td>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Mô Tả Sản Phẩm</label>
                                    <textarea style="resize: none" rows="5" name="product_desc" class="form-control" id="exampleInputEmail1">{!! htmlspecialchars_decode($edit_product->product_desc) !!}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nội Dung Sản Phẩm</label>
                                    <textarea style="resize: none" rows="5" name="product_content" class="form-control" id="exampleInputEmail1">{{$edit_product->product_content}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Thương Hiệu</label>
                                    <select name="product_brand" class="form-control input-sm m-bot15">
                                        @foreach($brand_product as $key => $brand)
                                            <option value="{{ $brand->brand_id }}" {{ $brand->brand_id == $edit_product->brand_id ? 'selected' : '' }}>
                                                {{ $brand->brand_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Danh Mục</label>
                                    <select name="product_cate" class="form-control input-sm m-bot15">
                                        @foreach($cate_product as $key => $cate)
                                            <option value="{{ $cate->category_id }}" {{ $cate->category_id == $edit_product->category_id ? 'selected' : '' }}>
                                                {{ $cate->category_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Tùy Chọn</label>
                                    <select name="product_status" class="form-control input-sm m-bot15">
                                        <option value="0">Ẩn</option>
                                        <option value="1">Hiển Thị</option>
                                    </select>
                                </div>
                                <button type="submit" name="add_product" class="btn btn-info">Cập Nhật Sản Phẩm</button>
                            </form>
                        </div>
{{--                    @endforeach--}}
                </div>
            </section>
        </div>
    </div>
@endsection

