<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    public $timestamps = false;// set time
    protected $fillable = [
        'product_name', 'product_price','product_id', '	order_id', 'product_sales_quantity'
    ];
    protected $primaryKey = 'order_details_id';
    protected $table = 'tbl_order_details';
    // Quan hệ với Product (1 OrderDetail thuộc về 1 sản phẩm)
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    // Quan hệ với Order (Nhiều sản phẩm thuộc về 1 đơn hàng)
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
