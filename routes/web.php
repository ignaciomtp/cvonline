<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CvController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\FormationController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\CustomCategoryController;
use App\Http\Controllers\DefaultTemplateSettingController;
use App\Http\Controllers\TemplateController;

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
    Route::post('/clonecv', [CvController::class, 'cloneCv'])->name('clonecv');
    Route::get('/editcv/{id}', [CvController::class, 'editCv'])->name('editcv');
    Route::delete('/mis-cvs/deletecv/{id}', [CvController::class, 'deleteCV'])->name('deletecv');

    Route::get('/templates', [TemplateController::class, 'viewTemplates'])->name('templates');

    Route::get('/viewcv/{id}', [CvController::class, 'createPdfCv'])->name('view.cv');
    Route::get('/viewcv2/{id}', [CvController::class, 'viewCv'])->name('viewhtml.cv');
    Route::post('/editcv/toggleincludedsection', [CvController::class, 'toggleIncludedSection'])->name('toggle.visile');
    Route::post('/editcv/updateprofile', [CvController::class, 'updateCvProfile'])->name('update.cv.profile');
    Route::post('/editcv/changecolor1', [CvController::class, 'changeCvColor1'])->name('change.color1');
    Route::post('/editcv/changecolor2', [CvController::class, 'changeCvColor2'])->name('change.color2');
    Route::post('/editcv/addoffer', [CvController::class, 'addOfferToCv'])->name('add.offer');

    Route::post('/editcv/attachexp', [CvController::class, 'toggleAttachExperienceToCv'])->name('attach.exp');
    Route::post('/editcv/attachformation', [CvController::class, 'toggleAttachFormationToCv'])->name('attach.form');
    Route::post('/editcv/attachskill', [CvController::class, 'toggleAttachSkillToCv'])->name('attach.skill');
    Route::post('/editcv/attachlang', [CvController::class, 'toggleAttachLanguageToCv'])->name('attach.lang');

    Route::post('/editcv/changetemplate', [CvController::class, 'changeResumeTemplate'])->name('template.change');

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


    Route::post('/editcv/addcategory/', [CustomCategoryController::class, 'addCustomCategory'])->name('addcategory');
    Route::delete('/editcv/deletecategory/{id}', [CustomCategoryController::class, 'deleteCustomCategory'])->name('deletecategory');
});

require __DIR__.'/auth.php';
