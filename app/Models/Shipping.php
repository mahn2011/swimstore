<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    public $timestamps = false;// set time
    protected $fillable = [
        'shipping_name', 'shipping_phone','shipping_address', 'shipping_email','shipping_notes'
    ];
    protected $primaryKey = 'shipping_id';
    protected $table = 'tbl_shipping';
    public function orders()
    {
        return $this->hasMany(Order::class, 'shipping_id');
    }
}
