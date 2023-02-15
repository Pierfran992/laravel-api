<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Tag;
use App\Models\Genre;
use App\Models\Movie;

class MainCotroller extends Controller
{
    // index
    public function home() {
        return view('pages.home');
    }
}
