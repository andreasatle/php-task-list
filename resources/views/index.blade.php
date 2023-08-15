<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <div>
        List of tasks:
        {{-- Special command @forelse for special message when empty list --}}
        @forelse ($tasks as $task)
            <div>{{ $task->title }}</div>
        @empty
            <p>No tasks found</p>
        @endforelse
    </div>
</body>

</html>
