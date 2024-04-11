<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\Resume;
use App\Models\Experience;
use App\Models\Formation;
use App\Models\Skill;
use App\Models\Language;
use App\Models\Template;
use Barryvdh\DomPDF\Facade\Pdf;

class CvController extends Controller
{
    

    public function updatePersonalData(Request $request) {

        $request->validate([
            'photoF' => 'image|mimes:jpeg,png,jpg,gif,jfif|max:2048',
        ]);

        $newData = $request->all();
        $nameImage = '';

        if($request->hasFile('photo')) {
            //$path = $request->file('photo')->store('public/files');

            $image = $request->file('photo');
            $nameImage = time().'.'.$image->getClientOriginalName();
            $image->move(app()->basePath('storage/app/public/images'), $nameImage);

            $newData['photo'] = $nameImage;
        }


        auth()->user()->fill($newData);

        $request->user()->save();

        return Redirect::route('dashboard');
    }


    public function viewCvs() {

        $cvs = auth()->user()->resumes()->get();

        return Inertia::render('MyCvs', ['cvs' => $cvs->all()]);

    }

    public function createNewCv() {
        
        return Inertia::render('CVForm');
    }

    public function saveNewCv(Request $request) {
        $request->validate([
            'title' => 'required',
        ]);

        $cv = new Resume;

        $cv->title = $request->title;
        $cv->user_id = auth()->user()->id;

        $sections = ['profile', 'experience', 'formation', 'complementary_formation', 'skills', 'languages'];
        $cv->visible_sections = json_encode($sections);


        $cv->save();

        //return Redirect::route('miscvs');

        return $cv;
    }


    public function deleteCV($id) {
        $cv = Resume::findOrFail($id);

        $cv->experiences()->detach();
        $cv->formations()->detach();
        $cv->skills()->detach();
        $cv->languages()->detach();

        Resume::destroy($id);

        return $id;
    }


    public function cvEditor() {
        return Inertia::render('CvEditor');
    }

    public function editCv($id) {
        $cv = Resume::find($id);
        $templates = Template::all();

        if($cv->description == null) $cv->description = auth()->user()->profile;

        $visibleSections = json_decode($cv->visible_sections);


        $experiences = getAllExperiences($cv);

        $formations = getAllFormations($cv);

        $complementary_formations = getAllComplementaryFormations($cv);

        $skills = getAllSkills($cv);

        $languages = getAllLanguages($cv);

        return Inertia::render('CvEditor', [
            'cv' => $cv, 
            'experiences' => $experiences, 
            'formations' => $formations,
            'complementary_formations' => $complementary_formations,
            'skills' => $skills,
            'languages' => $languages,
            'incv_sections' => $visibleSections,
            'templates' => $templates,
        ]);

    }

    public function updateCv(Request $request) {
        $cv = Resume::findOrFail($request->cv_id);

        $cv->title = $request->title;
        $cv->save();

        return Redirect::route('editcv', ['id' => $cv->id]);
    }


    public function viewCv($id) {

        $user = auth()->user();

        setlocale(LC_TIME, 'es_ES.UTF-8','esp');

        $cv = Resume::find($id);

        if($cv->description == null) $cv->description = auth()->user()->profile;

        $visibleSections = json_decode($cv->visible_sections);

        $experiences = $cv->experiences()->get()->all();

        foreach($experiences as $exp) {
            //$formattedStart = date("F Y", strtotime($exp->date_start));

            $formattedStart = strftime("%m %G", strtotime($exp->date_start));

            //$formattedFinish = date("F Y", strtotime($exp->date_finish));

            if($exp->date_finish) {
                $formattedFinish = strftime("%m %G", strtotime($exp->date_finish));
            } else {
                $formattedFinish = "Actualmente";
            }

            $exp->date_start = $formattedStart;
            $exp->date_finish = $formattedFinish;
        }

        $formations = $cv->formations()->where('type', 'académica')->get()->all();

        foreach($formations as $for) {
            $formattedFinish = strftime("%G", strtotime($for->date_finish));
            $for->date_finish = $formattedFinish;
        }

        $complementary_formations = $cv->formations()->where('type', 'complementaria')->get()->all();

        $skills = $cv->skills()->get()->all();
        $languages = $cv->languages()->get()->all();
        $profile = $cv->description; 
        $color = $cv->color_1;
        $colorIcons = $cv->color_2;
        $offer = $cv->offer;
        //$colorIcons = config("colors.".$cv->color_2);



        return view('cv.cv3', compact('user', 'experiences', 'formations', 'complementary_formations', 'skills', 'languages', 'visibleSections', 'profile', 'color', 'colorIcons', 'offer'));  


    }    

    public function createPdfCv($id) {

        $user = auth()->user();

        setlocale(LC_TIME, 'es_ES.UTF-8','esp');

        $cv = Resume::find($id);

        if($cv->description == null) $cv->description = auth()->user()->profile;

        $visibleSections = json_decode($cv->visible_sections);

        $experiences = $cv->experiences()->get()->all();

        foreach($experiences as $exp) {
            //$formattedStart = date("F Y", strtotime($exp->date_start));

            $formattedStart = strftime("%m-%G", strtotime($exp->date_start));

            //$formattedFinish = date("F Y", strtotime($exp->date_finish));

             if($exp->date_finish) {
                $formattedFinish = strftime("%m-%G", strtotime($exp->date_finish));
            } else {
                $formattedFinish = "Actualidad";
            }

            $exp->date_start = $formattedStart;
            $exp->date_finish = $formattedFinish;
        }

        $formations = $cv->formations()->where('type', 'académica')->get()->all();

        foreach($formations as $for) {
            $formattedFinish = strftime("%G", strtotime($for->date_finish));
            $for->date_finish = $formattedFinish;
        }

        $complementary_formations = $cv->formations()->where('type', 'complementaria')->get()->all();

        $skills = $cv->skills()->get()->all();
        $languages = $cv->languages()->get()->all();
        $profile = $cv->description; 
        $color = $cv->color_1;
        $colorIcons = $cv->color_2;
        $offer = $cv->offer;

        $pdf = Pdf::loadView('cv.'.$cv->template->view, compact('user', 'experiences', 'formations', 'complementary_formations', 'skills', 'languages', 'visibleSections', 'profile', 'color', 'colorIcons', 'offer'));

        return $pdf->stream('cv2.pdf');   



/*
        $content = $pdf->download()->getOriginalContent();
        Storage::put('public/pdfs/'.$user->name.'.pdf', $content);

        return Redirect::route('dashboard');
*/
    }    


    public function toggleIncludedSection(Request $request) {

        $cv = Resume::findOrFail($request->cv_id);

        $cv->toggleVisibleSection($request->section);

        $cv->save();

        return $cv->visible_sections;
    }

    public function updateCvProfile(Request $request) {

        $cv = Resume::findOrFail($request->cv_id);

        $cv->description = $request->profile;

        $cv->save();

        return $cv;

    }

    public function changeCvColor1(Request $request) {
        $cv = Resume::findOrFail($request->cv_id);

        $cv->color_1 = $request->color;

        $cv->save();

        return $cv;
    }

    public function changeCvColor2(Request $request) {
        $cv = Resume::findOrFail($request->cv_id);

        $cv->color_2 = $request->color;

        $cv->save();

        return $cv;
    }

    public function addOfferToCv(Request $request) {
        $cv = Resume::findOrFail($request->cv_id);

        $cv->offer = $request->offer;

        $cv->save();

        return $cv;
    }

    public function toggleAttachExperienceToCv(Request $request) {
        $cv = Resume::findOrFail($request->cv_id);
        $exp = Experience::findOrFail($request->exp_id);

        if($cv->experiences()->where('id', $request->exp_id)->exists()) {
            $cv->experiences()->detach($exp);
        } else {
            $cv->experiences()->attach($exp);
        }

        return $cv;
    }


    public function toggleAttachFormationToCv(Request $request) {
        $cv = Resume::findOrFail($request->cv_id);
        $for = Formation::findOrFail($request->for_id);

        if($cv->formations()->where('id', $request->for_id)->exists()) {
            $cv->formations()->detach($for);
        } else {
            $cv->formations()->attach($for);
        }

        return $cv;
    }


    public function toggleAttachSkillToCv(Request $request) {
        $cv = Resume::findOrFail($request->cv_id);
        $skill = Skill::findOrFail($request->skill_id);

        if($cv->skills()->where('id', $request->skill_id)->exists()) {
            $cv->skills()->detach($skill);
        } else {
            $cv->skills()->attach($skill);
        }

        return $cv;
    }


    public function toggleAttachLanguageToCv(Request $request) {
        $cv = Resume::findOrFail($request->cv_id);
        $lang = Language::findOrFail($request->lang_id);

        if($cv->languages()->where('id', $request->lang_id)->exists()) {
            $cv->languages()->detach($lang);
        } else {
            $cv->languages()->attach($lang);
        }

        return $cv;
    }

    public function changeResumeTemplate(Request $request) {
        $cv = Resume::findOrFail($request->cv_id);

        $cv->template_id = $request->template_id;

        $cv->save();

        return $cv;
    }

    public function cloneCv(Request $request) {
        $cv = Resume::findOrFail($request->cv_id);

        $newCv = $cv->replicate();
        $newCv->offer = '';
        $newCv->title .= '-copia';
        $newCv->save();

        $experiences = $cv->experiences()->get();

        foreach ($experiences as $exp) {
            $newCv->experiences()->attach($exp);
        }

        $formations = $cv->formations()->get();

        foreach ($formations as $for) {
            $newCv->formations()->attach($for);
        }

        $skills = $cv->skills()->get();

        foreach ($skills as $sk) {
            $newCv->skills()->attach($sk);
        }

        $languages = $cv->languages()->get();

        foreach ($languages as $lang) {
            $newCv->languages()->attach($lang);
        }


        return $newCv;

    }

}
