<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\InstituteController;
use App\Http\Controllers\LiveClassController;
use App\Http\Controllers\VideoCourseController;

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
    return view('auth.login');
});
// Route::get('login', function () {
//     return view('auth.login');
// });



Route::get('ins/content', [LiveClassController::class, 'index'])->name('liveclass');
Route::post('ins/content', [LiveClassController::class, 'store'])->name('liveclass.store');
Route::get('/live-classes/{id}', [LiveClassController::class, 'show'])->name('liveClasses.show');
Route::get('/live-classes/{id}/edit', [LiveClassController::class, 'edit'])->name('liveClasses.edit');

Route::get('ins/video', [VideoCourseController::class, 'index'])->name('videocourse');
Route::post('ins/video', [VideoCourseController::class, 'store'])->name('videocourse.store');


Route::get('ins/login', [LoginController::class, 'insindex'])->name('inslogin');

Route::post('login', [LoginController::class, 'login'])->name('login');
Route::middleware(['auth'])->group(function () {
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('ins/dashboard', [InstituteController::class, 'index'])->name('insdashboard');
    Route::get('addcourse', [InstituteController::class, 'addcourse'])->name('addcourse');
    Route::post('addcourse', [InstituteController::class, 'storeCourse'])->name('storecourse');
    Route::get('course_category', [InstituteController::class, 'courseCategory'])->name('course_category');
    Route::post('store_category', [InstituteController::class, 'StoreCategory'])->name('store_category');

    Route::get('course_subcategory', [InstituteController::class, 'courseSubCategory'])->name('course_subcategory');
    Route::post('store_subcategory', [InstituteController::class, 'StoreSubCategory'])->name('store_subcategory');
});
