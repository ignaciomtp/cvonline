<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resume;
use App\Models\Formation;

class FormationController extends Controller
{
    public function addFormation(Request $request) {

        $formation = new Formation;

        $formation->title = $request->title;
        $formation->name = $request->name;
        $formation->institution = $request->institution;
        $formation->institution_city = $request->institution_city;
        $formation->date_start = $request->date_start;
        $formation->date_finish = $request->date_finish;
        //$formation->resume_id = $request->resume_id;
        if($request->has('type')) $formation->type = $request->type;
        if($request->has('hours')) $formation->hours = $request->hours;
        if($request->has('year')) $formation->year = $request->year;

        $formation->save();

        $cv = Resume::find($request->resume_id);
        $cv->formations()->attach($formation);

        return $formation;
    }

    public function updateFormation(Request $request) {

        $formation = Formation::findOrFail($request->id);

        $formation->title = $request->title;
        $formation->name = $request->name;
        $formation->institution = $request->institution;
        $formation->institution_city = $request->institution_city;
        $formation->date_start = $request->date_start;
        $formation->date_finish = $request->date_finish;
        $formation->resume_id = $request->resume_id;
        if($request->has('type')) $formation->type = $request->type;
        if($request->has('hours')) $formation->hours = $request->hours;
        if($request->has('year')) $formation->year = $request->year;
 
        $formation->save();

        return $formation;
    }

    public function deleteFormation($id) {
        $formation = Formation::findOrFail($id);

        $formation->resumes()->detach();

        Formation::destroy($id);

        return $id;
    }
}
