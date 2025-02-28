@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm Thương Hiệu Mục Sản Phẩm
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
                        <form role="form" action="{{URL::to('/save-brand-product')}}" method="post">
                            {{ csrf_field()}}
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên Thương Hiệu Mục</label>
                                <input type="text" name="brand_product_name" class="form-control" id="exampleInputEmail1" placeholder="Tên Thương Hiệu Mục">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Mô Tả Thương Hiệu</label>
                                <textarea style="resize: none" rows="5" class="form-control" name="brand_product_desc" id="exampleInputPassword1" placeholder="Mô tả Thương Hiệu"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Từ Khóa Thương Hiệu</label>
                                <textarea style="resize: none" rows="5" class="form-control" name="brand_product_key" id="exampleInputPassword1" placeholder="Mô tả Thương Hiệu"></textarea>
                            </div>
                            <div class="form-group">
                                <select name="brand_product_status" class="form-control input-sm m-bot15">
                                    <label for="exampleInputPassword1">Tùy Chọn</label>
                                    <option value="0">Ẩn</option>
                                    <option value="1">Hiển Thị</option>
                                </select>
                            </div>
                            <button type="submit" name="add_brand_product" class="btn btn-info">Thêm Thương Hiệu</button>
                        </form>
                    </div>

                </div>
            </section>

        </div>
    </div>
@endsection
