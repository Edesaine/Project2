<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $table = 'tasks';
    protected $primaryKey='id';
    protected $fillable =[
        'title',
        'description',
        'time',
        'date',
        'status',
        'admin_id',
    ];
    public $timestamps = false;

    public function admin()
    {
        return $this->belongsTo(Author::class);
    }
}
