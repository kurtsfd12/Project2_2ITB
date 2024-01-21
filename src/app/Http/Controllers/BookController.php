<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;
use App\Models\Book;

class BookController extends Controller
{
    public function list()
    {
        $items = Book::orderBy('name', 'asc')->get();
        return view(
            'book.list',
            [
                'title' => 'Books',
                'items' => $items
            ]
        );
    }
    public function create()
    {
        $authors = Author::orderBy('name', 'asc')->get();
        return view(
            'book.form',
            [
                'title' => 'Add book',
                'book' => new Book(),
                'authors' => $authors,
            ]
        );
    }
    public function put(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|min:3|max:256',
            'author_id' => 'required',
            'description' => 'nullable',
            'price' => 'nullable|numeric',
            'year' => 'numeric',
            'image' => 'nullable|image',
            'display' => 'nullable'
        ]);
        $book = new Book();
        $book->name = $validatedData['name'];
        $book->author_id = $validatedData['author_id'];
        $book->description = $validatedData['description'];
        $book->price = $validatedData['price'];
        $book->year = $validatedData['year'];
        $book->display = (bool) ($validatedData['display'] ?? false);
        $book->save();
        return redirect('/books');
    }

}
