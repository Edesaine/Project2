<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;
    protected $table = 'authors';
    protected $primaryKey='id';
    protected $fillable =[
        'name',
        'country'
    ];

    public function books()
    {
        return $this->belongsToMany(Book::class, 'authorbook', 'author_id', 'book_id');
    }

    public $timestamps = false;
}
