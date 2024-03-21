<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resume;
use App\Models\Skill;

class SkillController extends Controller
{
    public function addSkill(Request $request) {
        $skill = new Skill;

        $skill->name = $request->name;
        $skill->level = $request->level;
       
        $skill->save();

        $cv = Resume::find($request->resume_id);
        $cv->skills()->attach($skill);

        return $skill;
    }

    public function updateSkill(Request $request) {
        
        $skill = Skill::findOrFail($request->id);

        $skill->name = $request->name;
        $skill->level = $request->level;

        $skill->save();

        return $skill;

    }

    public function deleteSkill($id) {
        $skill = Skill::findOrFail($id);

        $skill->resumes()->detach();

        Skill::destroy($id);

        return $id;
    }

}
