<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImagesController;


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
    return view('welcome');
});

Route::prefix('/images')->group(function () {
    Route::post('/upload', [ImagesController::class, 'uploadeImg'])->name('lib.image.uploade');
    Route::get('/get_images', [ImagesController::class, 'getImages'])->name('lib.getImages');
    Route::post('/put_seo', [ImagesController::class, 'putSEO'])->name('image.put.seo');
    Route::post('/search', [ImagesController::class, 'search'])->name('lib.images.search');
});

