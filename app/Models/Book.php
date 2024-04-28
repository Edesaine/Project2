<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $table = 'books';
    protected $primaryKey='id';
    protected $fillable=[
        'name',
        'quantity',
        'price',
        'description',
        'image',
        'status',
        'publisher_id',
        'NumberOfPages',
        'NumberOfAuthors',
        'NumberOfCategories'
    ];
    public $timestamps = false;

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}

