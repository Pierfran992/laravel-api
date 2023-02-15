@extends('layouts.main-layout')

@section('content')
    <h1 class="text-danger">Movie Categories</h1>

    {{-- creo un bottone per indirizzare l'utente in una pagina dove sono presenti tutti i film --}}
    <a href="{{ route('movies') }}" class="btn btn-danger">
        <i class="fa-solid fa-rectangle-list"></i>
        All Movie
    </a>

    {{-- Creo la card contenente il genere con l'elenco di tutti i film appartenenti ad essa --}}
    @foreach ($genres as $genre)

    <div class="card text-center my-5">

        <div class="card-header">
            <h3><strong>Genre:</strong> {{ $genre -> name }}</h3>
        </div>

        {{-- container contenente tutti i film che appartengono al genere --}}
        <div class="card-body d-flex flex-wrap gap-3">

            {{-- card del film --}}
            @foreach ($genre -> movies as $movie)
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

        <div class="card-footer text-muted text-start">
            <h6><strong>Info Genre:</strong></h6>
            <p><strong>DESCRIPTION:</strong> {{ $genre -> description ? $genre -> description : 'Description not available'}}</p>
        </div>

    </div>
    @endforeach
@endsection