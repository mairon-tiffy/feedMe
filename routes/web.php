<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TopController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\EventDetailController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ResultController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('/top', [TopController::class, 'show']);
Route::post('/top', [TopController::class, 'search'])->name('search');
Route::resource('events', EventController::class);
Route::get('/eventdetails/{event_id}/edit', [EventDetailController::class, 'index']);
Route::get('/eventdetails/create/{event_id}', [EventDetailController::class, 'create'])->name('eventDetailcreate');
Route::resource('eventdetails', EventDetailController::class);
Route::get('/users/firstChange', [UserController::class, 'firstChange'])->name('firstChange');
Route::post('/users/firstChangeStore', [UserController::class, 'firstChangeStore'])->name('firstChange.store');
Route::get('/users/userShow', [UserController::class, 'show'])->name('userShow');
Route::resource('users', UserController::class);
Route::get('/chat/message/{host_id}', [ChatController::class, 'message'])->name('message');
Route::resource('chat', ChatController::class);


