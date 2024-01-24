<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genre;


class GenreController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function list()
    {
        $items = Genre::orderBy('name', 'asc')->get();
        return view(
            'genre.list',
            [
                'title' => 'Genres',
                'items' => $items
            ]
        );
    }
    public function create()
    {
        return view(
            'genre.form',
            [
                'title' => 'Add new genre',
                'genre' => new genre()
            ]
        );
    }
    public function put(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
        ]);
        $genre = new genre();
        $genre->name = $validatedData['name'];
        $genre->save();
        return redirect('/genres');
    }
    public function update(genre $genre)
    {
        return view(
            'Genre.form',
            [
                'title' => 'Edit genre',
                'genre' => $genre
            ]
        );
    }
    public function patch(genre $genre, Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
        ]);
        $genre->name = $validatedData['name'];
        $genre->save();
        return redirect('/Genres');
    }
    public function delete(genre $genre)
    {
        $genre->delete();
        return redirect('/genres');
    }

}
