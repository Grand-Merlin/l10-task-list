@extends('layouts.app')

@section('title', $task->title)
@section('content')    
{{-- <h1>{{ $task->completed?'completé':'pas encore faite fénéant !!! va bosser !!!' }}</h1> --}}

<div class="mb-4">
    <a href="{{ route('tasks.index')}}" 
       class="link"><- Retour a la liste des tâches :)</a>
</div>
<p class="mb-4 text-slate-700">{{$task->description}}</p>

@if ($task->long_description)
     <p>{{$task->long_description}}</p>
@endif
{{-- diffForHumans est une méthode de la bibliothèque Carbon, utilisée pour formater des date de manière convivial pour les humain --}}
<p class="mb-4 text-sm text-slate-500">Créé {{$task->created_at->diffForHumans()}} . Mise à jour {{$task->updated_at->diffForHumans()}}</p>

<p>
    {{-- deux façon de faire la meme chose, le if et la ternaire, tu connais --}}
    {{-- {{ $task->completed?"Cest ok BRO":"Aller bouge tes couille"; }} --}}
    @if ($task->completed)
    <span class="font-medium text-green-500">Complétée</span></span>
    @else
    <span class="font-medium text-red-500">non complétée</span></span>
    @endif
</p>

<div class="flex gap-2">
    <a href="{{ route('tasks.edit', ['task' => $task]) }}"
        class="btn">Edit</a>

    <form method="POST" action="{{ route('task.toggle-complete', ['task'=>$task]) }}">
        @csrf
        @method('PUT')
        <button type="submit" class="btn">
            Mark as {{ $task->completed ? 'not completed':'completed' }}
        </button>
    </form>

    <form action="{{ route('tasks.destroy', ['task' => $task->id])}}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn">Delete</button>
    </form>
</div>
@endsection










{{-- ////////////////////////////////////////TEST PERSO (HORS FORMATION)/////////////////////////////////////////////////////////
<h1>{{$tache->description}}</h1>

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}