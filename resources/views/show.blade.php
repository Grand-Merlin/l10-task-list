@extends('layouts.app')

@section('title', $task->title)
@section('content')    
{{-- <h1>{{ $task->completed?'completé':'pas encore faite fénéant !!! va bosser !!!' }}</h1> --}}
<p>{{$task->description}}</p>

@if ($task->long_description)
<p>{{$task->long_description}}</p>
@endif
<p>{{$task->created_at}}</p>
<p>{{$task->updated_at}}</p>

<p>
    {{-- deux façon de faire la meme chose, le if et la ternaire, tu connais --}}
    {{-- {{ $task->completed?"Cest ok BRO":"Aller bouge tes couille"; }} --}}
    @if ($task->completed)
    Cest ok BRO
    @else
    Aller bouge tes couille
    @endif
</p>

<div>
    <a href="{{ route('tasks.edit', ['task' => $task]) }}">Edit</a>
</div>

<div>
    <form method="POST" action="{{ route('task.toggle-complete', ['task'=>$task]) }}">
        @csrf
        @method('PUT')
        <button type="submit">
            Mark as {{ $task->completed ? 'not completed':'completed' }}
        </button>
    </form>
</div>

<div>
    <form action="{{ route('tasks.destroy', ['task' => $task->id])}}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit">Delete</button>
    </form>
</div>
@endsection










{{-- ////////////////////////////////////////TEST PERSO (HORS FORMATION)/////////////////////////////////////////////////////////
<h1>{{$tache->description}}</h1>

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}