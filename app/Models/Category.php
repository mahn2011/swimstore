<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //tbl_category_product
    public $timestamps = false;// set time
    protected $fillable = [
        'category_name', 'meta_keywords', 'category_desc','category_status'
    ];
    protected $primaryKey = 'category_id';
    protected $table = 'tbl_category_product';
    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }
}
