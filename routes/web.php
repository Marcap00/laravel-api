<?php

use App\Http\Controllers\Admin\ProjectController as AdminProjectController;
use App\Http\Controllers\Admin\TechnologyController as AdminTechnologyController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', [WelcomeController::class, 'welcome'])->name('welcome');

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    /* Route::get('/', [AdminProjectController::class, 'index'])->name('index');
    Route::post('/', [AdminProjectController::class, 'store'])->name('store');
    Route::get('/create', [AdminProjectController::class, 'create'])->name('create');
    Route::get('/{id}', [AdminProjectController::class, 'show'])->name('show');
    Route::get('/{id}/edit', [AdminProjectController::class, 'edit'])->name('edit');
    Route::put('/{id}', [AdminProjectController::class, 'update'])->name('update');
    Route::delete('/{id}', [AdminProjectController::class, 'destroy'])->name('destroy');
    */
    Route::get('/projects/bin', [AdminProjectController::class, 'bin'])->name('projects.bin');
    Route::resource('/projects', AdminProjectController::class);
    Route::delete('/projects/{id}/{title}/permanent-delete', [AdminProjectController::class, 'permanentDestroy'])->name('projects.permanent-destroy');
    Route::patch('/projects/{id}/{title}/restore', [AdminProjectController::class, 'restore'])->name('projects.restore');
});

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/technologies/bin', [AdminTechnologyController::class, 'bin'])->name('technologies.bin');
    Route::resource('/technologies', AdminTechnologyController::class);
    Route::delete('/technologies/{id}/{name}/permanent-delete', [AdminTechnologyController::class, 'permanentDestroy'])->name('technologies.permanent-destroy');
    Route::patch('/technologies/{id}/{name}/restore', [AdminTechnologyController::class, 'restore'])->name('technologies.restore');
});
