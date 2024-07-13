<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PersonController;
use Illuminate\Support\Facades\Route;

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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// login routes
Route::get('/redirects', [AdminController::class, 'index']);

// person route
Route::group(['prefix' => '/person'], function () {
    Route::get('/', [PersonController::class, 'index'])->name('admin.person.table');
    Route::get('/add', [PersonController::class, 'add'])->name('admin.person.add');
    Route::post('/add', [PersonController::class, 'store'])->name('admin.person.store');
    Route::get('/edit{id}', [PersonController::class, 'edit'])->name('admin.person.editForm');
    Route::post('/update', [PersonController::class, 'update'])->name('admin.person.update');
    Route::get('/delete/{id}', [PersonController::class, 'destroy'])->name('delete');
});

Route::group(['prefix' => '/member'], function () {
    Route::get('/', [MemberController::class, 'index'])->name('admin.member.form');
});

