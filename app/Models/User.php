<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use MongoDB\Laravel\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class User extends Model
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $collection = 'users';

 protected $fillable = [
        'location',
    ];
    
  protected $casts = [
        'location' => 'array',
    ];
}
