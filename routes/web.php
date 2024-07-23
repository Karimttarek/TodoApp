<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::middleware(['auth', 'verified'])->prefix('todo-list')->controller(TaskController::class)->group(function () {

    Route::get('/', 'index')->name('task.index');
    Route::get('/create', 'create')->name('task.create');
    Route::post('/store', 'store')->name('task.store');
    Route::get('/edit/{id}/{slug}', 'edit')->name('task.edit');
    Route::post('/update/{id}/{slug}', 'update')->name('task.update');
    Route::get('/trash', 'trash')->name('task.trash');
    /**
     * Extra Routes
     */
    Route::get('/trashed', 'trashed')->name('task.trashed');
    Route::get('/deleteTrashed', 'deleteTrashed')->name('task.deleteTrashed');
    Route::get('/deleteAllTrashed', 'deleteAllTrashed')->name('task.deleteAllTrashed');
    Route::get('/undoTrash/{id}', 'undoTrash')->name('task.undoTrash');
    /**
     * Extra Routes
     */
    Route::get('/mark-completed/{id}', 'markAsCompleted')->name('task.markAsCompleted');
    Route::get('/filter', 'filter')->name('task.filter');
});
