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

    public function authors()
    {
        return $this->belongsToMany(Author::class, 'authorbook', 'book_id', 'author_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'categorybook', 'book_id', 'category_id');
    }
}

