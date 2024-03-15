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

class CvController extends Controller
{
    

    public function updatePersonalData(Request $request) {

        $request->validate([
            'photoF' => 'image|mimes:jpeg,png,jpg,gif,jfif|max:2048',
        ]);

        $newData = $request->all();
        $nameImage = '';

        if($request->hasFile('photoF')) {
            //$path = $request->file('photo')->store('public/files');

            $image = $request->file('photoF');
            $nameImage = time().'.'.$image->getClientOriginalName();
            $image->move(app()->basePath('storage/app/public'), $nameImage);

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


}
