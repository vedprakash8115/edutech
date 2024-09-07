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
    /***  For Course routes ***/
    Route::get('addcourse', [InstituteController::class, 'addcourse'])->name('addcourse');
    Route::post('addcourse', [InstituteController::class, 'storeCourse'])->name('storecourse');
    Route::get('course_list', [InstituteController::class, 'courseList'])->name('course_list');
    Route::get('course_list/data', [InstituteController::class, 'getCoursesData'])->name('courses.data');
    Route::get('edit_course/{id}', [InstituteController::class, 'editCourse'])->name('edit_course');
    Route::put('update_course/{id}', [InstituteController::class, 'updateCourse'])->name('update_course');
    Route::delete('delete_course/{id}', [InstituteController::class, 'deleteCourse'])->name('delete_course');
    /***  For Category routes ***/
    Route::get('course_category', [InstituteController::class, 'courseCategory'])->name('course_category');
    Route::get('course_category/data', [InstituteController::class, 'getCategoriesData'])->name('course_category.data');
    Route::post('store_category', [InstituteController::class, 'StoreCategory'])->name('store_category');
    Route::get('edit_category/{id}', [InstituteController::class, 'editCategory'])->name('edit_category');
    Route::put('update_category/{id}', [InstituteController::class, 'updateCategory'])->name('update_category');
    Route::delete('delete_category/{id}', [InstituteController::class, 'deleteCategory'])->name('delete_category');
    /***  For Sub Category routes ***/
    Route::get('course_subcategory', [InstituteController::class, 'courseSubCategory'])->name('course_subcategory');
    Route::post('store_subcategory', [InstituteController::class, 'StoreSubCategory'])->name('store_subcategory');
    Route::get('course_subcategory/data', [InstituteController::class, 'getSubcategoriesData'])->name('subcategory.data');
    Route::get('edit_subcategory/{id}', [InstituteController::class, 'editSubCategory'])->name('edit_subcategory');
    Route::put('update_subcategory/{id}', [InstituteController::class, 'updateSubcategory'])->name('update_subcategory');
    Route::delete('delete_subcategory/{id}', [InstituteController::class, 'deleteSubcategory'])->name('delete_subcategory');

});
