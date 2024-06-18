@extends('layouts.app')
{{-- @section('title', 'Add Task') --}}
{{-- @region 
@section('styles')
    <style>
        .error-message {
            color: red;
            font-size: 0.8rm;
        }
    </style>
@endsection
@endregion --}}
@section('content')
    @region
        {{-- permet de voir rapidement ou se trouve les erreur 
{{-- {{ $errors }} --}}
        {{-- <form method="POST" action="{{route('tasks.store')}}"> --}}
        {{-- Cross Site Request Forgnery --}}
        {{-- Inclu un token unique pour chaque formulaire afin de proteger l'utilisateur contre des attaque qui pourrais soumettre des requete a leur insu --}}
        {{-- 1 generation du token
         2 verification (laravel verifie si le token est valide)
         3 Protection (Si le token est invalide, laravel renvoie une erreur 419, session expirée) --}}
        {{-- @csrf --}}
        {{-- <div> --}}
        {{-- "for" sert a lier le label a un champ specifique du formulaire avec le mot cles "id" --}}
        {{-- <label for="title"> --}}
        Title
        {{-- </label> --}}
        {{-- la fonction helper "old" dans l'attribut "value" permet de conserver ce qui a été taper dans l'input, apres la verification échouée --}}
        {{-- <input text="text" name="title" id="title" value="{{old('title')}}"/> --}}
        {{-- @error('title') --}}
        {{-- <p class="error-message">{{ $message }}</p> --}}
        {{-- @enderror --}}
        {{-- </div> --}}

        {{-- <div> --}}
        {{-- <label for="description">Description</label> --}}
        {{-- <textarea name="description", id="description" rows="5">{{old('description')}}</textarea> --}}
        {{-- Permet d'afficher un message d'erreur si le champ est manquant --}}
        {{-- @error('description') --}}
        {{-- <p class="error-message">{{ $message }}</p> --}}
        {{-- @enderror --}}
        {{-- </div> --}}

        {{-- <div> --}}
        {{-- <label for="long_description">Long Description</label> --}}
        {{-- <textarea name="long_description", id="long_description" rows="10">{{old('long_description')}}</textarea> --}}
        {{-- @error('long_description') --}}
        {{-- <p class="error-message">{{ $message }}</p> --}}
        {{-- @enderror --}}
        {{-- </div> --}}

        {{-- <div> --}}
        {{-- <button type="submit">Add Task</button> --}}
        {{-- </div> --}}
        {{-- </form> --}}
    @endregion
@include('form')
@endsection
