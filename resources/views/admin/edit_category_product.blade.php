@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Cập Nhật Danh Mục Sản Phẩm
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
                        <form role="form" action="{{URL::to('/update-category-product/'.$edit_category_product->category_id)}}" method="post">
                            {{ csrf_field()}}
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên Danh Mục</label>
                                <input type="text" value="{{$edit_category_product->category_name}}" name="category_product_name" class="form-control" id="exampleInputEmail1">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Mô Tả Danh Mục</label>
                                <textarea style="resize: none" rows="5" class="form-control" name="category_product_desc" id="exampleInputPassword1">{{$edit_category_product->category_desc}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Từ Khóa Danh Mục</label>
                                <textarea style="resize: none" rows="5" class="form-control" name="category_product_keywords" id="exampleInputPassword1" >{{$edit_category_product->meta_keywords}}</textarea>
                            </div>
                            <button type="submit" name="add_category_product" class="btn btn-info">Cập Nhật Danh Mục</button>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection

