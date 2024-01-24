<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DataController extends Controller
{
    public function getTopBooks()
    {
        $books = Book::where('display', true)
            ->inRandomOrder()
            ->take(3)
            ->get();
        return $books;
    }
    // Returns the selected Book object, if it’s published
    public function getBook(Book $book)
    {
        $selectedBook = Book::where([
            'id' => $book->id,
            'display' => true,
        ])
            ->firstOrFail();
        return $selectedBook;
    }
    // Returns 3 published Book objects in random order- except the selected one
    public function getRelatedBooks(Book $book)
    {
        $books = Book::where('display', true)
            ->where('id', '<>', $book->id)
            ->inRandomOrder()
            ->take(3)
            ->get();
        return $books;
    }
}
