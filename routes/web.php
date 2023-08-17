<?php

use \App\Models\Task;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route to the home page, redirect to the task list page
Route::get('/', function () {
    return redirect()->route('tasks.index');
});

// Route to the task list page
Route::get('/tasks', function () {
    // Retrieve all the rows from the DB table, has to be finished
    // by get() that finalizes the SQL-query.
    return view('index', ['tasks' => Task::latest()->get()]);
})->name('tasks.index');

// Route to the task creation page
Route::view('/tasks/create', 'create')->name('tasks.create');

// Route to the task edit detail page
Route::get('/tasks/{task}/edit', function (Task $task) {
    // Retrieve the row with $id from the DB table
    return view('edit', ['task' => $task]);
})->name('tasks.edit');

// Route to the task detail page
Route::get('/tasks/{task}', function (Task $task) {
    // Retrieve the row with $id from the DB table
    return view('show', ['task' => $task]);
})->name('tasks.show');

Route::post('/tasks', function (Request $request) {
    // Validate the data
    $data = $request->validate([
        'title' => 'required|max:255',
        'description' => 'required',
        'long_description' => 'required',
    ]);
    $task = new Task;
    $task->title = $data['title'];
    $task->description = $data['description'];
    $task->long_description = $data['long_description'];
    $task->save();

    return redirect()
        ->route('tasks.show', ['id' => $task->id])
        ->with('success', 'Task created successfully');
})->name('tasks.store');

Route::put('/tasks/{task}', function (Task $task, Request $request) {
    // Validate the data
    $data = $request->validate([
        'title' => 'required|max:255',
        'description' => 'required',
        'long_description' => 'required',
    ]);
    $task->title = $data['title'];
    $task->description = $data['description'];
    $task->long_description = $data['long_description'];
    $task->save();

    return redirect()
        ->route('tasks.show', ['task' => $task])
        ->with('success', 'Task updated successfully');
})->name('tasks.update');

Route::fallback(function () {
    return 'Page not found';
});