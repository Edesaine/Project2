<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Customer extends Model implements \Illuminate\Contracts\Auth\Authenticatable
{
    use HasFactory;
    use Authenticatable;

    protected $table = 'customer';
    protected $primaryKey='id';
    protected $fillable=[
        'name',
        'email',
        'password',
        'phone',
        'image',
        'gender',
        'address',
        'account_status'
    ];
    public $timestamps = false;

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
