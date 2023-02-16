<?php


use App\Http\Controllers\ClassesController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\FrontEndController as ControllersFrontEndController;
use App\Http\Controllers\JobsController;
use App\Http\Controllers\SubjectsController;
use App\Http\Controllers\TopicsController;
use App\Models\Classes;
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

Route::get('/', [FrontendController::class, 'index'])->name('welcome');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('/classes', ClassesController::class, ['as' => 'admin']);
Route::resource('class/{class}/subjects', SubjectsController::class)->except(['index,show']);
Route::resource('chapter/{chapter}/topic', TopicsController::class, ['as' => 'admin']);
Route::delete('delete-job-category/{category}', [JobsController::class, 'deleteJobCategory'])->name('job.category.delete');
Route::post('save-job-category', [JobsController::class, 'saveJobCategory'])->name('job.category.save');
Route::resource('job-blog', JobsController::class, ['as' => 'admin']);
Route::post('image-upload', [JobsController::class, 'imageUpload'])->name('image.upload');

Route::get('classes/{class}/details', [ClassesController::class, 'classDetail'])->name('admin.class.details');

Route::get('/class/{class}', [FrontEndController::class, 'class'])->name('front.class');
Route::get('/subject', [FrontEndController::class, 'subject'])->name('front.subject');

Route::get('/chapters', [FrontEndController::class, 'chapter'])->name('front.chapter');
Route::get('/topics/{class}/{subject}/{chapter}', [FrontEndController::class, 'tertiaryChapter'])->name('front.tertiary.chapter');


Route::get('/{board}/{class}/topic/{slug}', [FrontEndController::class, 'topic'])->name('front.topics.show');
Route::get('topic-download/{slug}', [FrontEndController::class, 'downloadPdf'])->name('topic.download');

Route::get('jobs/{slug}', [FrontEndController::class, 'showJob'])->name('job.show');
