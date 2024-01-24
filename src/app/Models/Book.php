<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{

    protected $fillable = ['name', 'author_id', 'genre_id', 'description', 'price', 'year'];

    use HasFactory;
    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }
    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function jsonSerialize(): mixed
    {
        return [
            'id' => intval($this->id),
            'name' => $this->name,
            'description' => $this->description,
            'author' => $this->author->name,
            'genre' => ($this->genre ? $this->genre->name : ''),
            'price' => number_format($this->price, 2),
            'year' => intval($this->year),
            'image' => asset('images/' . $this->image),
        ];
    }
}
