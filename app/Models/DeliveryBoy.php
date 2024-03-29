<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use MongoDB\Laravel\Eloquent\Model;

class DeliveryBoy extends Model
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $collection = 'delivery_boys';

}
