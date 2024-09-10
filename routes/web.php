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
Route::get('login', function () {
    return view('dashboard');
});



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
    /***  For Course routes ***/
    Route::get('addlevel0', [InstituteController::class, 'categoryLevel0'])->name('addlevel0');
    Route::post('addlevel0', [InstituteController::class, 'storeLevel0'])->name('storelevel0');
    // Route::get('course_list', [InstituteController::class, 'level0List'])->name('course_list');
    Route::get('category_level0/data', [InstituteController::class, 'getLevel0Data'])->name('category_level0.data');
    // Route::get('course_list/data', [InstituteController::class, 'getLevel0Data'])->name('courses.data');
    Route::get('edit_level0/{id}', [InstituteController::class, 'editLevel0'])->name('edit_level0');
    Route::put('update_level0/{id}', [InstituteController::class, 'updateLevel0'])->name('update_level0');
    Route::delete('delete_level0/{id}', [InstituteController::class, 'deleteLevel0'])->name('delete_level0');
    /***  For Category routes ***/
    Route::get('category_level1', [InstituteController::class, 'CategoryLevel1'])->name('category_level1');
    Route::get('course_category/data', [InstituteController::class, 'getLevel1Data'])->name('course_category.data');
    Route::post('store_category', [InstituteController::class, 'StoreLevel1'])->name('store_level1');
    Route::get('edit_level1/{id}', [InstituteController::class, 'editLevel1'])->name('edit_level1');
    Route::put('edit_level1/{id}', [InstituteController::class, 'updateLevel1'])->name('update_level1');
    Route::delete('delete_level1/{id}', [InstituteController::class, 'deleteLevel1'])->name('delete_level1');
    /***  For Sub Category routes ***/
    Route::get('course_subcategory', [InstituteController::class, 'courseSubCategory'])->name('course_subcategory');
    Route::post('store_subcategory', [InstituteController::class, 'StoreSubCategory'])->name('store_subcategory');
    Route::get('course_subcategory/data', [InstituteController::class, 'getSubcategoriesData'])->name('subcategory.data');
    Route::get('edit_subcategory/{id}', [InstituteController::class, 'editSubCategory'])->name('edit_subcategory');
    Route::put('update_subcategory/{id}', [InstituteController::class, 'updateSubcategory'])->name('update_subcategory');
    Route::delete('delete_subcategory/{id}', [InstituteController::class, 'deleteSubcategory'])->name('delete_subcategory');

});
