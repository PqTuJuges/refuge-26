<?php
use App\Http\Controllers\AnimalController;
use App\Http\Controllers\ShelterController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/animaux');
Route::view('/composants', 'styleguide')->name('styleguide');

Route::get('/animaux', [AnimalController::class,'index'])->name('animals.index');
Route::get('/animaux/nouveau' , [AnimalController::class,'create'])->name('animals.create');
Route::post('/animaux', [AnimalController::class,'store'])->name('animals.store');
Route::get('/animaux/{id}', [AnimalController::class,'show'])->name('animals.show');
Route::get('/animaux/{id}/modifier', [AnimalController::class,'edit'])->name('animals.edit');
Route::put('/animaux/{id}', [AnimalController::class,'update'])->name('animals.update');
Route::patch('/animaux/{id}/adoption', [AnimalController::class,'adopt'])->name('animals.adopt');
Route::delete('/animaux/{id}', [AnimalController::class,'destroy'])->name('animals.destroy');

Route::get('/refuges/{id}', [ShelterController::class,'show'])->name('shelters.show');
