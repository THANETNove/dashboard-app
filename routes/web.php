<?php

use Illuminate\Support\Facades\Route;
use App\Models\Message;
use App\Models\Announce;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {

    if (Auth::check()  && Auth::user()->status == 1) {
        return redirect('home');
    } else {
        $messages = Message::latest()->get();
        $announce = Announce::oldest()->get();

        return view('welcome', compact('messages', 'announce'));
    }
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/users', [App\Http\Controllers\HomeController::class, 'users'])->name('users');
Route::get('/delete-user/{id}', [App\Http\Controllers\HomeController::class, 'destroy'])->name('delete-user');
Route::get('/user-edit/{id}', [App\Http\Controllers\HomeController::class, 'edit'])->name('user-edit');
Route::put('/register-update/{id}', [App\Http\Controllers\HomeController::class, 'update'])->name('register-update');
Route::post('/forum-store', [App\Http\Controllers\HomeController::class, 'store'])->name('forum-store');
Route::get('/delete-message/{id}', [App\Http\Controllers\HomeController::class, 'destroyMessage'])->name('delete-message');
Route::get('/announces', [App\Http\Controllers\HomeController::class, 'announces'])->name('announces');
Route::get('/create-announces', [App\Http\Controllers\HomeController::class, 'createAnnounces'])->name('create-announces');
Route::post('/announces-store', [App\Http\Controllers\HomeController::class, 'announcesStore'])->name('announces-store');
Route::get('/delete-declare/{id}', [App\Http\Controllers\HomeController::class, 'deleteDeclare'])->name('delete-declare');
Route::post('/forum/reply/{message_id}', [App\Http\Controllers\HomeController::class, 'storeReply'])->name('forum-reply');
