<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// richiamo tutti i model che servono per la creazione del movie
use App\Models\Tag;
use App\Models\Genre;
use App\Models\Movie;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Movie :: factory() -> count(100) -> make() -> each(function($p){

            $genre = Genre :: inRandomOrder() -> first();
            $p -> genre() -> associate($genre);

            $p -> save();

            $tags = Tag :: inRandomOrder() -> limit(rand(1, 3)) -> get();
            $p -> tags() -> attach($tags);
        }); 
    }
}
