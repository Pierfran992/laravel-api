<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use App\Models\Genre;
use App\Models\Tag;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;


class ApiController extends Controller
{   
    // funzione che trasmette al front-end tutti i dati presenti nel database
    public function movieWtagWgenreAll(){

        $movies = Movie :: with('tags')
            -> orderBy('created_at', 'desc')
            -> get();
        $genres = Genre :: all();
        $tags = Tag :: all();

        return response() -> json([
            'success' => true,
            'response' => [
                'movies' => $movies,
                'genres' => $genres,
                'tags' => $tags,
            ],

        ]);
    }


    // funzione per eliminare un elemento
    public function deleteMovie(Movie $movie) {
        $movie -> tags() -> sync([]);
        $movie -> delete();

        return response() -> json([
            'success' => true,
        ]);
    }
    
}
