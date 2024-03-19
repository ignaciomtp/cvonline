<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resume;
use App\Models\Experience;

class ExperienceController extends Controller
{

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
