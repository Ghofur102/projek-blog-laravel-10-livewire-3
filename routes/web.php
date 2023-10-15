<?php

use App\Models\blogs;
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

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::view('tambah-tulisan', 'tambahTulisan')
    ->middleware(['auth'])
    ->name('tambah.tulisan');

Route::view('tulisan/{id}', 'tulisan')
    ->middleware(['auth'])
    ->name('tulisan');

Route::get('tulisan/{id}', function ($id) {
    $blog = blogs::find($id);
    return view('tulisan', compact("blog"));
});

require __DIR__.'/auth.php';
