<?php

use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ReunionController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
/*
Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});
*/
/*Route::middleware(['auth:sanctum', 'verified'])->get('/', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');
*/
/*
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');

Route::put("reunions/{reunion}/restore", [ReunionController::class, "restore"])->name("reunions.restore");
Route::resource("reunions", ReunionController::class);
*/

Route::group(["middleware" => ['auth:sanctum', 'verified']], function () {
    Route::get('/', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
    Route::get("/dashboard", function () {
        return Inertia::render('Dashboard');
    })->name("dashboard");
    Route::resource("reunions", ReunionController::class);
    Route::resource("questions", QuestionController::class)->except(["show"]);
});
