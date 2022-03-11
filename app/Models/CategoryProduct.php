<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryProduct extends Model
{
    use HasFactory;

    protected $table = 'category_product';
    protected $fillable = ['product_id','category_id'];

    public function categories()
    {
        return $this->belongsTo(Category::class);
    }

    public function product()
    {
        return $this->hasMany(Product::class);
    }
}
