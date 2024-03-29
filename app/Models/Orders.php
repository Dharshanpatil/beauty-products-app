<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use MongoDB\Laravel\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $collection = 'orders';

  public function shop()
    {
        return $this->belongsTo(User::class,'shop_id');
    }
    
    
}
