<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Method extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];
    protected $table = 'payment_method';

    public function orders()
    {
        return $this->hasMany(Order::class, 'payment_id');
    }
}
