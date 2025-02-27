<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';
    protected $primaryKey='id';
    protected $fillable =[
        'name',
    ];

    public function books()
    {
        return $this->belongsToMany(Book::class, 'categorybook', 'category_id', 'book_id');
    }

    public $timestamps = false;
}
