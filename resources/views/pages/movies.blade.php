@extends('layouts.main-layout')

@section('content')
    <h1 class="text-danger mb-3">List Movie</h1>

    {{-- creo un bottone per far tornare l'utente alla home page --}}
    <a href="{{ route('home') }}" class="btn btn-danger my-3">
        <i class="fa-solid fa-igloo"></i>
        Home
    </a>

    {{-- creo le card per stampare le info sui film --}}
    <div class="d-flex flex-wrap gap-3">

        {{-- card del film --}}
        @foreach ($movies as $movie)
                <div class="card" style="width: 18rem;">
                    <div class="card-body text-start">
                        <h5 class="card-title">{{ $movie -> name }}</h5>
                        <span>Release Date: {{ $movie -> release_date }}</span>
                        <br>
                        <span>Cash Out: {{ $movie -> cashOut }}</span>
                    </div>
                </div>   
            @endforeach

    </div>
@endsection