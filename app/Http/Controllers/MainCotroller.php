<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainCotroller extends Controller
{
    // index
    public function home() {
        return view('pages.home');
    }
}
