<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    public $timestamps = false;// set time
    protected $fillable = [
        'payment_method', 'payment_status'
    ];
    protected $primaryKey = 'payment_id';
    protected $table = 'tbl_payment';
    public function orders()
    {
        return $this->hasMany(Order::class, 'payment_id');
    }
}
