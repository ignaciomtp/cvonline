<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CvController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\FormationController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\SkillController;
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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



Route::middleware('auth')->group(function () {
    Route::get('/cv-editor/', [CvController::class, 'cvEditor'])->name('editor');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/personaldata', [CvController::class, 'updatePersonalData'])->name('personal.data');
    Route::get('/mis-cvs', [CvController::class, 'viewCvs'])->name('miscvs');
    Route::get('/new-cv', [CvController::class, 'createNewCv'])->name('createnewcv');
    Route::post('/savenewcv', [CvController::class, 'saveNewCv'])->name('savenewcv');
    Route::get('/editcv/{id}', [CvController::class, 'editCv'])->name('editcv');

    Route::get('/viewcv/{id}', [CvController::class, 'createPdfCv'])->name('view.cv');
    Route::post('/editcv/toggleincludedsection', [CvController::class, 'toggleIncludedSection'])->name('toggle.visile');

    Route::put('/editcv/', [CvController::class, 'updateCv'])->name('updatecv');

    Route::post('/editcv/addexperience/', [ExperienceController::class, 'addExperience'])->name('addexperience');
    Route::post('/editcv/updateexperience/', [ExperienceController::class, 'updateExperience'])->name('updateexperience');
    Route::delete('/editcv/deleteexperience/{id}', [ExperienceController::class, 'deleteExperience'])->name('deleteexperience');

    Route::post('/editcv/addformation/', [FormationController::class, 'addFormation'])->name('addformation');
    Route::post('/editcv/updateformation/', [FormationController::class, 'updateFormation'])->name('updateformation');
    Route::delete('/editcv/deleteformation/{id}', [FormationController::class, 'deleteFormation'])->name('deleteformation');


    Route::post('/editcv/addskill/', [SkillController::class, 'addSkill'])->name('addskill');
    Route::delete('/editcv/deleteskill/{id}', [SkillController::class, 'deleteSkill'])->name('deleteskill');

    Route::post('/editcv/addlanguage/', [LanguageController::class, 'addLanguage'])->name('addlanguage');
    Route::delete('/editcv/deletelanguage/{id}', [LanguageController::class, 'deleteLanguage'])->name('deletelanguage');

});

require __DIR__.'/auth.php';
