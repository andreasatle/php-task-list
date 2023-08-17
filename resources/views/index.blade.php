@extends('layouts.app')

@section('title', 'List of tasks')

@section('content')
    @forelse ($tasks as $task)
        <div>
            <a href="{{ route('tasks.show', ['task' => $task->id]) }}"> {{ $task->title }}</a>
        </div>
    @empty
        <p>No tasks found</p>
    @endforelse

    @if ($tasks->count())
        <nav>
            {{ $tasks->links() }}
        </nav>
    @endif
@endsection
