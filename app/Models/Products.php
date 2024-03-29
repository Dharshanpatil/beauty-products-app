<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class Products extends Model
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $collection = 'products';

  public function categorys()
    {
        return $this->belongsTo(Category::class,'category_id');
    }
    
      public function subcategorys()
    {
        return $this->belongsTo(Category::class,'sub_category_id');
    }
}
