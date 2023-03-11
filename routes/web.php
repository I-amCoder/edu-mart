<?php


use App\Http\Controllers\ClassesController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\FrontEndController as ControllersFrontEndController;
use App\Http\Controllers\JobsController;
use App\Http\Controllers\PastPaperController;
use App\Http\Controllers\SettingsController;
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


Auth::routes(['register' => false]);

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('/classes', ClassesController::class, ['as' => 'admin']);
    Route::resource('class/{class}/subjects', SubjectsController::class)->except(['index,show']);
    Route::resource('chapter/{chapter}/topic', TopicsController::class, ['as' => 'admin']);
    Route::post('topic/file/upload', [TopicsController::class, 'uploadFile'])->name('admin.topic.file.upload');
    Route::resource('past-papers', PastPaperController::class);
    Route::post('past-papers-category', [PastPaperController::class, 'storeCategory'])->name('past-papers-category.store');
    Route::delete('past-papers-category/{id}', [PastPaperController::class, 'deleteCategory'])->name('past-papers-category.delete');
    Route::delete('delete-job-category/{category}', [JobsController::class, 'deleteJobCategory'])->name('job.category.delete');
    Route::post('save-job-category', [JobsController::class, 'saveJobCategory'])->name('job.category.save');
    Route::resource('job-blog', JobsController::class, ['as' => 'admin']);
    // Route::post('image-upload', [JobsController::class, 'imageUpload'])->name('image.upload');
    Route::get('settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::post('settings', [SettingsController::class, 'update'])->name('settings.update');
    Route::get('classes/{class}/details', [ClassesController::class, 'classDetail'])->name('admin.class.details');
});


Route::get('/', [FrontendController::class, 'index'])->name('welcome');
Route::get('/class/{class}', [FrontEndController::class, 'class'])->name('front.class');
Route::get('/subject', [FrontEndController::class, 'subject'])->name('front.subject');

Route::get('/chapters', [FrontEndController::class, 'chapter'])->name('front.chapter');
Route::get('/topics/{class}/{subject}/{chapter}', [FrontEndController::class, 'tertiaryChapter'])->name('front.tertiary.chapter');


Route::get('/{board}/{class}/topic/{slug}', [FrontEndController::class, 'topic'])->name('front.topics.show');
Route::get('topic-download/{slug}', [FrontEndController::class, 'downloadPdf'])->name('topic.download');

Route::get('all-past-papers', [FrontEndController::class, 'pastPapers'])->name('front.pastpapers');
Route::get('download-past-paper/{id}', [FrontEndController::class, 'downloadPaper'])->name('paper.download');
Route::get('job-advertisements', [FrontEndController::class, 'showAllJobs'])->name('jobs.all.show');
Route::get('job-advertisements/{slug}', [FrontEndController::class, 'showJob'])->name('job.show');
Route::get('job-advertisements/download/{id}/{type}', [FrontEndController::class, 'downloadJobPdf'])->name('job.file.download');
