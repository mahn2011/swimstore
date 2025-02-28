<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $timestamps = false;// set time
    protected $fillable = [
        'order_total', 'order_status','	customer_id	', 'shipping_id','payment_id',
    ];
    protected $primaryKey = 'order_id';
    protected $table = 'tbl_order';
    // Quan hệ với Customer (1 Đơn hàng thuộc về 1 khách hàng)
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
    // Quan hệ với Shipping (1 Đơn hàng có 1 thông tin giao hàng)
    public function shipping()
    {
        return $this->belongsTo(Shipping::class, 'shipping_id');
    }
    // Quan hệ với OrderDetail (1 Đơn hàng có nhiều sản phẩm)
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'order_details_id');
    }
    // Quan hệ với Payment (1 Đơn hàng có 1 phương thức thanh toán)
    public function payment()
    {
        return $this->belongsTo(Payment::class, 'payment_id');
    }
}
