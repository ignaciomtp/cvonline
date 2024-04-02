<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resume;
use App\Models\Language;

class LanguageController extends Controller
{
    public function addLanguage(Request $request) {
        $lang = new Language;

        $lang->name = $request->name;
        $lang->level = $request->level;
        $lang->certification = $request->certification;
        $lang->user_id = auth()->user()->id;
       
        $lang->save();

        $cv = Resume::find($request->resume_id);
        $cv->languages()->attach($lang);

        return $lang;
    }


    public function deleteLanguage($id) {
        $lang = Language::findOrFail($id);

        $lang->resumes()->detach();

        Language::destroy($id);

        return $id;
    }
}
