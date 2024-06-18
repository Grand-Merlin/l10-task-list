@extends('layouts.app')
{{-- @section('title', 'Edit Task') --}}
{{-- @region 
@section('styles')
    <style>
        .error-message{
            color: red;
            font-size: 0.8rm;
        }
    </style>
@endsection
@endregion --}}
@section('content')
    @region
        {{-- v1 --}}
        {{-- action specifie l'URL vers laquelle le formulaire va etre envoyé --}}
        {{-- <form method="POST" action="{{route('tasks.update', ['id'=>$task->id])}}"> --}}
        {{-- v2 --}}
        {{-- <form method="POST" action="{{ route('tasks.update', ['task' => $task->id]) }}"> --}}
        {{-- @csrf --}}
        {{-- technique appelee "methode spoofing" pour simuler une methode PUT a l'interieur de la methode POST (On px donc utilisée les methode non suportée par HTML directement dans les formulaire) --}}
        {{-- @method('PUT') --}}
        {{-- <div> --}}
        {{-- <label for="title"> --}}
        {{-- Title --}}
        {{-- </label> --}}
        {{-- <input text="text" name="title" id="title" value="{{ $task->title }}" /> --}}
        {{-- @error('title') --}}
        {{-- <p class="error-message">{{ $message }}</p> --}}
        {{-- @enderror --}}
        {{-- </div> --}}

        {{-- <div> --}}
        {{-- <label for="description">Description</label> --}}
        {{-- <textarea name="description", id="description" rows="5">{{ $task->description }}</textarea> --}}
        {{-- @error('description') --}}
        {{-- <p class="error-message">{{ $message }}</p> --}}
        {{-- @enderror --}}
        {{-- </div> --}}

        {{-- <div> --}}
        {{-- <label for="long_description">Long Description</label> --}}
        {{-- <textarea name="long_description", id="long_description" rows="10">{{ $task->long_description }}</textarea> --}}
        {{-- @error('long_description') --}}
        {{-- <p class="error-message">{{ $message }}</p> --}}
        {{-- @enderror --}}
        {{-- </div> --}}

        {{-- <div> --}}
        {{-- <button type="submit">Edit Task</button> --}}
        {{-- </div> --}}
        {{-- </form> --}}
    @endregion
{{-- passage des donnee de vue partielle, on pourra donc acceder a $task --}}
@include('form', ['task'=> $task])
@endsection
