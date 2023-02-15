<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Tag;
use App\Models\Genre;
use App\Models\Movie;

class MainCotroller extends Controller
{
    // index
    public function home(){
        $genres = Genre :: all();
        return view('pages.home', compact('genres'));
    }

    public function movies() {
        $movies = Movie :: all();
        return view('pages.movies', compact('movies'));
    }

    // delete
    public function delete(Movie $movie) {
        $movie -> tags() -> sync([]);
        $movie -> delete();
        return redirect() -> route('movies');
    }
}
