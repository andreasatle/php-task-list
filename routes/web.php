<?php

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

// Temporarily use a class Task, that will be automatically created by some DB magic later.
class Task
{
    public function __construct(
        public int $id,
        public string $title,
        public string $description,
        public ?string $long_description,
        public bool $completed = false,
        public string $created_at,
        public string $updated_at
    ) {
    }
}

// Create some random tasks, will be read from DB later.
$tasks = [
    new Task(1, "Kroger", "Shopping", "For Robyn's birthday party", false, "2021-09-01 12:00:00", "2021-09-01 12:00:00"),
    new Task(2, "Randalls", "Shopping", "Weekly groceries", false, "2021-09-01 12:00:00", "2021-09-01 12:00:00"),
    new Task(3, "Whole food", "Shopping", "Monthly groceries", false, "2021-09-01 12:00:00", "2021-09-01 12:00:00")
];

// Route to the root of the application
Route::get('/tasks', function () use ($tasks) {
    return view('index', ['tasks' => $tasks]);
})->name('tasks.index');

// Route to the task detail page
Route::get('/tasks/{id}', function ($id) {
    return "One single task with id: $id";
})->name('tasks.show');

Route::fallback(function () {
    return 'Page not found';
});