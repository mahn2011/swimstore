<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    public $timestamps = false;// set time
    protected $fillable = [
        'customer_name', 'customer_email','customer_password', 'customer_phone',
    ];
    protected $primaryKey = 'customer_id';
    protected $table = 'tbl_customer';
    // Quan hệ với Order (1 Khách hàng có nhiều đơn hàng)
    public function orders()
    {
        return $this->hasMany(Order::class, 'customer_id');
    }
}
