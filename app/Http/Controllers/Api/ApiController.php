<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use Illuminate\Http\Request;


class ApiController extends Controller
{
    public function movieAll(){

        $movies = Movie :: all();

        return response() -> json([
            'success' => true,
            'response' => $movies,

        ]);

    }
}
