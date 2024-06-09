<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];
    protected $table = 'shipping_methods';

    public function orders()
    {
        return $this->hasMany(Order::class, 'method_id');
    }
}
