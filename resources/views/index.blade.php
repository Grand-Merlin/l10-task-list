@extends('layouts.app')
@section('title', 'Liste des taches')
@section('content')
<nav class="mb-4">
    {{-- lien pour naviger vers la page de creation de tache --}}
    <a href="{{ route('tasks.create')}}" 
       class="font-medium text-gray-700 underline decoration-pink-500">Add Task :)</a>
</nav>
    {{-- @if (count($tasks))
        <div>Il y a des tache</div>
        @foreach ($tasks as $task)
            <div>{{$task->title}}</div>
        @endforeach
        @else
        <div>Il n'y a pas de taches</div>
    @endif --}}
    @forelse ($totosss as $task)
        {{-- <div>{{$task->title}}</div> --}}
        <div>
            {{-- v1 --}}
            {{-- <a href="{{ route('tasks.show', ['id' =>$task->id]) }}">{{$task->title}}</a> --}}
            {{-- v2 --}}
            <a href="{{ route('tasks.show', ['task' =>$task->id]) }}"
                {{-- directive css conditionnel, ici, la tache sera barrée sur elle est marquée comme completée (true) --}}
                @class(['line-through' => $task->completed])>{{$task->title}}</a>
        </div>
    @empty
    <div>Il n'y a pas de taches</div>
    @endforelse
{{-- la methode count retourn un nombre superieur a zero, ici le nombre d'element dans la collection ou le tableau $tasks --}}
{{-- En résumé, ce code vérifie s'il y a au moins une tâche dans la collection $tasks. Si c'est le cas, il affiche les liens de pagination pour naviguer entre les pages de tâches. --}}
    @if ($totosss->count())
    <nav class="mt-4">
         {{-- links genere les liens de pagination en HTML pour naviger entre les page de resultat. Utiliser avec la methode paginate() definie dans les routes --}}
         {{ $totosss->links() }}
    </nav>
       
    @endif
@endsection

