@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Cập Nhật Thương Hiệu Sản Phẩm
                </header>
                <div class="panel-body">
                    <?php
                    $message = Session::get('message');
                    if($message){
                        echo '<span class="text-alert">'.$message.'</span>';
                        Session::Put('message', null);
                    }
                    ?>


                        <div class="position-center">
                            <form role="form" action="{{URL::to('/update-brand-product/'.$edit_brand_product->brand_id)}}" method="post">
                                {{ csrf_field()}}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên Thương Hiệu</label>
                                    <input type="text" value="{{$edit_brand_product->brand_name}}" name="brand_product_name" class="form-control" id="exampleInputEmail1">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô Tả Thương Hiệu</label>
                                    <textarea style="resize: none" rows="5" class="form-control" name="brand_product_desc" id="exampleInputPassword1">{{$edit_brand_product->brand_desc}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Từ Khóa Thương Hiệu</label>
                                    <textarea style="resize: none" rows="5" class="form-control" name="brand_product_key" id="exampleInputPassword1">{{$edit_brand_product->meta_keywords}}</textarea>
                                </div>
                                <button type="submit" name="add_brand_product" class="btn btn-info">Cập Nhật Thương Hiệu</button>
                            </form>
                        </div>
                </div>
            </section>
        </div>
    </div>
@endsection

