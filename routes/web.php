<?php

use App\Http\Controllers\AdminProfileController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\FolderController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\StudentHomeController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\InstituteController;
use App\Http\Controllers\LiveClassController;
use App\Http\Controllers\LiveClassPdfController;
use App\Http\Controllers\ElibraryController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\user_frontend\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VideoCourseController;
use App\Http\Controllers\UploadMonitorController;
use App\Http\Controllers\MockTestController;
use App\Livewire\Tests;
use App\Livewire\MockTest;
use App\Livewire\SubjectForm;
use App\Livewire\QuestionForm;
use App\Livewire\QuestionManagement;
use App\Http\Controllers\SliderController;

// use App\Livewire\Test;
// use livewire\livewire;
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

Route::get('/login', function () {
    return view('auth.login');
});
// Route::get('login', function () {
//     return view('dashboard');
// });

Route::get('ins/login', [LoginController::class, 'insindex'])->name('inslogin');
Route::post('login', [LoginController::class, 'login'])->name('login');

Route::get('/',[HomeController::class,'index'])->name('index');
Route::get('/course-details/{id}',[HomeController::class,'details'])->name('course.details');

// Route::post('login', [LoginController::class, 'login'])->name('login');

Route::middleware(['auth'])->group(function () {
    Route::middleware(['auth', 'role:admin|teacher|superadmin'])->group(function () {
        Route::get('ins/content', [LiveClassController::class, 'index'])->name('liveclass');
        Route::post('ins/content', [LiveClassController::class, 'store'])->name('liveclass.store');
        Route::get('/live-classes/{id}', [LiveClassController::class, 'show'])->name('liveClasses.show');
        Route::get('/live-classes/data', [LiveClassController::class, 'getData'])->name('liveClasses.data');
        // Route for editing a live class
        Route::get('/live-Class/{id}/edit', [LiveClassController::class, 'edit'])->name('liveClasses.edit');

        // Route for updating a live class (this will handle the form submission)
        Route::put('/live-Classes/{id}', [LiveClassController::class, 'update'])->name('liveclass.update');

        // Route for deleting a live class
        Route::delete('/live-Classes/{id}', [LiveClassController::class, 'destroy'])->name('liveClasses.destroy');
        Route::get('/live-classes/clear-session', [LiveClassController::class, 'resetSession'])->name('liveclass.reset');

        // In get Category route , fetching category 1 and category 2
        Route::get('/live-classes/cat1/{categoryId}', [LiveClassController::class, 'getCategoryOptions'])->name('liveclass.getCategoryOptions');
        Route::get('/live-classes/cat2/{categoryId}', [LiveClassController::class, 'getCategory_2Options'])->name('liveclass.getCategory_2Options');

        Route::get('ins/video', [VideoCourseController::class, 'index'])->name('videocourse');
        Route::post('ins/video', [VideoCourseController::class, 'store'])->name('videocourse.store');
        Route::get('ins/video/edit/{id}', [VideoCourseController::class, 'edit'])->name('videocourse.edit');
        // Route for the update method in VideoCourseController
        Route::put('/videocourses/{id}', [VideoCourseController::class, 'update'])->name('videocourse.update');
        Route::get('/videocourses/{id}/videos', [VideoCourseController::class, 'showVideos'])->name('videocourse.showVideos');
        Route::delete('/videos/{id}', [VideoCourseController::class, 'destroy'])->name('videocourse.deleteVideo');
        Route::post('ins/video/upload', [VideoCourseController::class, 'uploadVideos'])->name('videocourse.uploadVideos');
        Route::delete('/ins/video/delete_multiple', [VideoCourseController::class, 'deleteMultiple'])->name('videocourse.deleteMultiple');

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
        // Route::get('course_subcategory', [InstituteController::class, 'courseSubCategory'])->name('course_subcategory');
        // Route::post('store_subcategory', [InstituteController::class, 'StoreSubCategory'])->name('store_subcategory');
        // Route::get('course_subcategory/data', [InstituteController::class, 'getSubcategoriesData'])->name('subcategory.data');
        // Route::get('edit_subcategory/{id}', [InstituteController::class, 'editSubCategory'])->name('edit_subcategory');
        // Route::put('update_subcategory/{id}', [InstituteController::class, 'updateSubcategory'])->name('update_subcategory');
        // Route::delete('delete_subcategory/{id}', [InstituteController::class, 'deleteSubcategory'])->name('delete_subcategory');

        Route::resource('roles', RoleController::class);

        // ---------------------------------------------------------------------------E Library Section Routes

        // use App\Http\Controllers\ElibraryController;

        Route::get('/ins/content/e-library', [ElibraryController::class, 'index'])->name('elibrary');
        Route::post('/ins/content/e-library/store', [ElibraryController::class, 'store'])->name('elibrary.store');
        Route::get('/ins/content/e-library/edit/{id}', [ElibraryController::class, 'edit'])->name('elibrary.edit');
        Route::get('/ins/content/e-library/show', [ElibraryController::class, 'show'])->name('elibrary.show');
        Route::put('/ins/content/e-library/update/{id}', [ElibraryController::class, 'update'])->name('elibrary.update');
        Route::get('/ins/content/e-library/files/{id}', [ElibraryController::class, 'files'])->name('elibrary.files');

        // Route for deleting multiple eLibrary files
        Route::delete('/delete-multiple', [ElibraryController::class, 'deleteMultiple'])->name('elibrary.deleteMultiple');
        Route::post('/elibrary/upload-files', [ElibraryController::class, 'uploadFiles'])->name('elibrary.uploadFiles');
        // Route::get('/ins/content/e-library', [ElibraryController::class, 'index'])->name('elibrary.store');
        // Route::get('/upload-monitor', [UploadMonitorController::class, 'index'])->name('upload.monitor');
        Route::resource('users', UserController::class);

        // ----------------------------Mock test ------------------------------------------------------------------
        Route::get('/ins/content/mock', [MockTestController::class, 'index'])->name('mock');
        Route::get('/ins/content/mock/submit-form', [MockTestController::class, 'form'])->name('mock.subject_form');
        Route::get('/ins/content/mock/question-form', [MockTestController::class, 'question'])->name('mock.question_form');
        Route::get('/ins/content/mock/test', Tests::class)->name('mock_test');
        Route::get('/ins/content/mock/subjects', SubjectForm::class)->name('mock_subjects');
        Route::get('/ins/content/mock/question', QuestionForm::class)->name('mock_questions');
        Route::resource('coupons',CouponController::class);


        // ----------------------------------testing--------------------------------------
        // Route::get('/ins/content/test')

        // ----------------------------------------------------------------------------------


        Route::prefix('live-class-pdfs')->group(function () {
            Route::get('/live-class-pdf/{id}', [LiveClassPdfController::class,'index'])->name('live-class-pdfs.index');
            Route::post('/upload', [LiveClassPdfController::class , 'upload'])->name('live-class-pdfs.upload');
            Route::delete('/delete/{id}', [LiveClassPdfController::class , 'delete'])->name('live-class-pdfs.delete');
            Route::post('/delete-multiple', [LiveClassPdfController::class , 'deleteMultiple'])->name('live-class-pdfs.deleteMultiple');
        });
        Route::resource('testimonials',TestimonialController::class);
        Route::put('/testimonials/{id}/status', [TestimonialController::class, 'updateStatus'])->name('testimonials.updateStatus');
        Route::get('/userroles/{id}', [TestimonialController::class, 'getRolesByUser'])->name('roles.byUser');
        Route::resource('sliders',SliderController::class);
        Route::put('/sliders/{id}/status', [SliderController::class, 'updateStatus'])->name('sliders.updateStatus');

        route::prefix('setting')->group(function () {
            Route::get('profile', [AdminProfileController::class,'show'])->name('admin.profile');
            Route::post('profile', [AdminProfileController::class, 'update'])->name('admin.profile.update');
            Route::post('user/add', [AdminProfileController::class, 'addUser'])->name('admin.user.add');
            route::post('user/bulk-add-users', [AdminProfileController::class, 'bulkAddUsers'])->name('admin.bulkAddUsers');

        });

                // View file manager for a video course
        Route::get('/video-course/{id}/folders', [FolderController::class, 'index'])->name('folders.index');
        Route::get('folder/{folderId}', [FolderController::class, 'showFolder'])->name('folders.show');

        // Create a new folder
        Route::post('/video-course/{id}/folders/create', [FolderController::class, 'createFolder'])->name('folders.create');

        // Upload a file to a folder
        // Root-level upload
        Route::post('/video-course/{videoCourseId}/upload', [FolderController::class, 'uploadFile'])->name('folders.upload');

        // Subfolder-level upload
        Route::post('/video-course/{videoCourseId}/folder/{folderId}/upload', [FolderController::class, 'uploadFile'])->name('folders.subfolder.upload');

        Route::put('/folders/{id}/rename', [FolderController::class, 'rename'])->name('folders.rename');
        Route::delete('/folders/{id}/delete', [FolderController::class, 'delete'])->name('folders.delete');
        Route::get('/search-folders/{videoCourseId}', [FolderController::class, 'searchFolders'])->name('folders.search');
        Route::put('/files/{fileId}/rename', [FileController::class, 'renameFile'])->name('files.rename');
        Route::delete('/files/{fileId}/delete', [FileController::class, 'deleteFile'])->name('files.delete');
        Route::get('/hierarchy/{videoCourseId}', [FolderController::class, 'showHierarchy'])->name('folders.hierarchy');
        Route::get('/folders/load-subfolders/{parentId}', [FolderController::class, 'loadSubfolders'])->name('folder.subfolders');
        Route::post('/move-folder/{draggedId}/to/{targetId}', [FolderController::class, 'moveFolder']);
        Route::post('/move-file/{fileId}/to/{targetFolderId}', [FileController::class,'moveFile']);



        // chats
        Route::get('/chat-support',[ChatController::class,'index'])->name('chats'); 
        Route::get('/chat-support/{videoCoursesId}/groups', [ChatController::class, 'chatroom'])->name('chats.groups');
        Route::post('groups/store', [ChatController::class, 'storeGroup'])->name('groups.store');

        Route::post('groups/add-people/{groupId}', [MessageController::class, 'addPeopleToGroup'])->name('groups.addPeople');
        Route::get('/chat-support/groups/{groupId}/load-chat', [MessageController::class, 'index'])->name('groups.loadChat');
        Route::post('/chat-support/messages/store', [MessageController::class, 'store'])->name('messages.store');
        Route::get('/chat-support/groups/{groupId}/available-students', [MessageController::class, 'availableStudents']);
        // Route to fetch available teachers
        Route::get('/chat-support/groups/teachers', [MessageController::class, 'getAvailableTeachers']);

        // Route to assign a teacher to a group
        Route::post('/chat-support/groups/{groupId}/assign-teacher', [MessageController::class, 'assignTeacher']);




                    
    });

    

    // Student Dashboard Route (accessible only by student)
    Route::prefix('student')->middleware(['auth', 'role:student'])->group(function () {
        Route::get('profile', [StudentHomeController::class, 'index'])->name('student.profile');
        Route::put('profile/update-details', [StudentHomeController::class, 'updateDetails'])->name('student.profile.updateDetails');
        Route::put('profile/update-image', [StudentHomeController::class, 'updateImage'])->name('student.profile.updateImage');

        Route::get('tests', [TestController::class, 'index'])->name('tests');

        


    });

    Route::post('logout', [LoginController::class, 'logout'])->name('logout');



});
Route::get('/mock-test', MockTest::class)->name('mock_sample');
Route::get('/mock-test/ques', QuestionManagement::class)->name('mock.man');
// Auth::routes();
// Route::get('/check' , Check::class);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
