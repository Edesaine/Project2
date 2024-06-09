<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'date_buy',
        'status',
        'customer_id',
        'admin_id',
        'receiver_name',
        'receiver_phone',
        'receiver_address',
        'amount',
        'method_id',
        'payment_id'
    ];
    protected $table = 'orders';

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function payment()
    {
        return $this->belongsTo(Method::class, 'payment_id');
    }

    public function shipping()
    {
        return $this->belongsTo(Shipping::class, 'method_id');
    }
}
