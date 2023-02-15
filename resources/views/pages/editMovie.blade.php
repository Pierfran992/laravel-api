@extends('layouts.main-layout')

@section('content')

    <h1 class="text-danger">Edit Selected Movie</h1>

    {{-- creo un bottone per far tornare l'utente alla pagina dei prodotti --}}
    <a href="{{ route('movies') }}" class="btn btn-danger my-3">
        <i class="fa-solid fa-clipboard-list"></i>
        Movie List
    </a>

    {{-- messaggi di errore --}}
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    {{-- creo il form con cui andar a creare il nuovo elemento da inviare al database --}}
    <form method="POST" action="{{route('update.movie', $movie)}}" class="p-3">
        
        @csrf

        <div class="input-group my-2">
            <label for="name" class="input-group-text" id="basic-addon1">Name</label>
            <input type="text" class="form-control" name="name" value="{{ $movie -> name }}">
        </div>

        <div class="input-group my-2">
            <label for="release_date" class="input-group-text" id="basic-addon1">Release Date</label>
            <input type="date" class="form-control" name="release_date" value="{{ $movie -> release_date }}">
        </div>

        <div class="input-group my-2">
            <label for="cashOut" class="input-group-text" id="basic-addon1">Cash Out</label>
            <input type="number" class="form-control" name="cashOut" value="{{ $movie -> cashOut }}">
        </div>

        <select name="genre_id" class="form-select form-select-sm" aria-label=".form-select-sm example">
            <option selected>Select Genre</option>
            @foreach ($genres as $genre)
                <option value="{{$genre -> id}}"
                    @if ($movie -> genre -> id == $genre -> id)
                        selected
                    @endif
                    >{{$genre -> name}}</option>
            @endforeach
        </select>

        <div class="card text-center my-5">
            <div class="card-header">
                <h4>Select Category</h4>
            </div>
            <div class="card-body d-flex flex-wrap gap-3">
                @foreach ($tags as $tag)
                <div class="form-check">
                    <input name="tags[]" class="form-check-input" type="checkbox" value="{{ $tag -> id }}" id="flexCheckIndeterminate"
                    @foreach ($movie -> tags as $movieTag)
                            @if ($movieTag -> id == $tag -> id)
                                checked
                            @endif
                        @endforeach
                    >
                    <label class="form-check-label" for="tags">
                        {{ $tag -> name }}
                    </label>
                </div>
                @endforeach
            </div>
        </div>

        <button class="btn btn-danger my-2" type="submit">
            <i class="fa-regular fa-pen-to-square"></i>
            Edit
        </button>
        
    </form>
    
@endsection