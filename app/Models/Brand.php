<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    public $timestamps = false;// set time
    protected $fillable = [
        'brand_name', 'meta_keywords', 'brand_desc','brand_status'
    ];
    protected $primaryKey = 'brand_id';
    protected $table = 'tbl_brand_product';
    public function products()
    {
        return $this->hasMany(Product::class, 'brand_id', 'id');
    }
}
