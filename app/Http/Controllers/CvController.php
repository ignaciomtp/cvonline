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
        $cv->save();

        //return Redirect::route('miscvs');

        return $cv;
    }

    public function cvEditor() {
        return Inertia::render('CvEditor');
    }

    public function editCv($id) {
        $cv = Resume::find($id);

        $experiences = $cv->experiences()->get()->all();

        if(!$experiences) {

            $var = new \stdClass();
            $var->id = 0;
            $var->title = '';
            $var->company_name = '';
            $var->company_city = '';
            $var->date_start = '';
            $var->date_finish = '';
            $var->job = '';

            $experiences = [$var];
        }

        $formations = $cv->formations()->where('type', 'académica')->get()->all();

        if(!$formations) {

            $var = new \stdClass();
            $var->id = 0;
            $var->name = '';
            $var->title = '';
            $var->institution = '';
            $var->institution_city = '';
            $var->date_start = '';
            $var->date_finish = '';

            $formations = [$var];
        }

        $complementary_formations = $cv->formations()->where('type', 'complementaria')->get()->all();

        if(!$complementary_formations) {

            $var = new \stdClass();
            $var->id = 0;
            $var->name = '';
            $var->type = 'complementaria';
            $var->title = '';
            $var->institution = '';
            $var->institution_city = '';
            //$var->year = 0;
            $var->hours = 0;

            $complementary_formations = [$var];
        }

        $skills = $cv->skills()->get()->all();

        if(!$skills) {
            $var = new \stdClass();
            $var->id = 0;
            $var->name = '';
            $var->level = 0;

            $skills = [$var];
        }

        return Inertia::render('CvEditor', [
            'cv' => $cv, 
            'experiences' => $experiences, 
            'formations' => $formations,
            'complementary_formations' => $complementary_formations,
            'skills' => $skills,
        ]);

    }

    public function updateCv(Request $request) {
        $cv = Resume::findOrFail($request->cv_id);

        $cv->title = $request->title;
        $cv->save();

        return Redirect::route('editcv', ['id' => $cv->id]);
    }


    public function createPdfCv($id) {

        $user = auth()->user();

        setlocale(LC_TIME, 'es_ES.UTF-8','esp');

        $cv = Resume::find($id);

        $experiences = $cv->experiences()->get()->all();

        foreach($experiences as $exp) {
            //$formattedStart = date("F Y", strtotime($exp->date_start));

            $formattedStart = strftime("%B %G", strtotime($exp->date_start));

            //$formattedFinish = date("F Y", strtotime($exp->date_finish));

            $formattedFinish = strftime("%B %G", strtotime($exp->date_finish));

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

        $pdf = Pdf::loadView('cv.cv1', compact('user', 'experiences', 'formations', 'complementary_formations', 'skills'));

        return $pdf->stream('cv1.pdf');   



/*
        $content = $pdf->download()->getOriginalContent();
        Storage::put('public/pdfs/'.$user->name.'.pdf', $content);

        return Redirect::route('dashboard');
*/
    }    

    public function addExperience(Request $request) {
        $request->validate([
            'title' => 'required',
            'company_name' => 'required',
            'company_city' => 'required',
            'date_start' => 'required',
            'date_finish' => 'required',
            'job_description' => 'required'
        ], );

        $exp = new Experience;
        $exp->title = $request->title;
        $exp->company_name = $request->company_name;
        $exp->company_city = $request->company_city;
        $exp->date_start = $request->date_start;
        $exp->date_finish = $request->date_finish;
        $exp->job_description = $request->job_description;
        //$exp->resume_id = $request->resume_id;

        $exp->save();

        $cv = Resume::find($request->resume_id);
        $cv->experiences()->attach($exp);

        return $exp;

    }

    public function updateExperience(Request $request) {
/*        $request->validate([
            'id' => 'required',
            'title' => 'required',
            'company_name' => 'required',
            'company_city' => 'required',
            'date_start' => 'required',
            'date_finish' => 'required',
            'job_description' => 'required'
        ]);
*/
        $exp = Experience::findOrFail($request->id);
        $exp->title = $request->title;
        $exp->company_name = $request->company_name;
        $exp->company_city = $request->company_city;
        $exp->date_start = $request->date_start;
        $exp->date_finish = $request->date_finish;
        $exp->job_description = $request->job_description;
        //$exp->resume_id = $request->resume_id;

        $exp->save();

        //return Redirect::route('editcv', ['id' => $exp->resume_id]);

        return $exp;
    }


    public function deleteExperience($id) {
        $exp = Experience::findOrFail($id);

        $exp->resumes()->detach();

        Experience::destroy($id);

        return $id;
    }


}
