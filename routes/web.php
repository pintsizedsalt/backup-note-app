<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NoteController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/notes', [NoteController::class, 'showAll'])->name('showAll');

Route::get('/notes/create', [NoteController::class, 'createNote'])->name('createNote');
Route::post('/notes/store', [NoteController::class, 'storeNote'])->name('storeNote');

Route::get('/notes/{id}', [NoteController::class, 'showNote'])->name('showNote');

Route::get('/notes/{id}/edit', [NoteController::class, 'editNote'])->name('editNote');
Route::put('/notes/{id}/update', [NoteController::class, 'updateNote'])->name('updateNote');
 
Route::delete('/notes/{id}/delete', [NoteController::class, 'deleteNote'])->name('deleteNote');

//changes
Route::get('/notes/search',[NoteController::class, 'searchNote'])->name('searchNote');

//Requirements
//Note Resource, User Resource

//Note Model
//Title
//Description
//Content


//methods
//showAll = Read
//createNote = Create
//storeNote = Create
//showNote = Read
//editNote = Update
//updateNote = Update
//deleteNote = Delete

//User Model
// name
// email
// birthday