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

    // funzione per creare un nuovo elemento
    public function createMovie(Request $request) {

        $data = $request -> validate([
            'name' => 'required|string|min:3|max:64',
            'release_date' => 'required|date|before:today',
            'cashOut' => 'required|integer|min:0|',
            'genre_id' => 'required|integer|min:1',
            'tags_id' => 'required|array'
        ]);

        $movie = New Movie();

        $movie -> name = $data ['name'];
        $movie -> release_date = $data ['release_date'];
        $movie -> cashOut = $data ['cashOut'];
        
        $genre = Genre :: find($data['genre_id']);
        $movie -> genre() -> associate($genre);

        $movie -> save();

        $tags = tag :: find($data['tags_id']);
        $movie -> tags() -> attach($tags);

        return response() -> json([
            'success' => true,
            'response' => $movie,
            'data' => $request -> all(),
        ]);
    }

    // funzione per modificare un elemento
    public function editMovie(Request $request, Movie $movie) {
        $data = $request -> validate([
            'name' => 'required|string|min:3|max:64',
            'release_date' => 'required|date|before:today',
            'cashOut' => 'required|integer|min:0|',
            'genre_id' => 'required|integer|min:1',
            'tags_id' => 'required|array'
        ]);

        $movie -> name = $data ['name'];
        $movie -> release_date = $data ['release_date'];
        $movie -> cashOut = $data ['cashOut'];
        
        $genre = Genre :: find($data['genre_id']);
        $movie -> genre() -> associate($genre);

        $movie -> save();

        $tags = tag :: find($data['tags_id']);
        $movie -> tags() -> sync($tags);

        return response() -> json([
            'success' => true,
            'response' => $movie,
            'data' => $request -> all(),
        ]);
    }
    
}
