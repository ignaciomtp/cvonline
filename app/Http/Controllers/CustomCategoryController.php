<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resume;
use App\Models\CustomCategory;

class CustomCategoryController extends Controller
{
    public function addCustomCategory(Request $request) {

        $category = new CustomCategory;

        $category->user_id = auth()->user()->id;
        $category->category_title = $request->category_title;

        $category->save();

        $cv = Resume::find($request->resume_id);
        $cv->categories()->attach($category);

        $cv->toggleVisibleSection($category->category_title);
        $cv->save();

        return $category;

    }


    public function deleteCustomCategory($id) {
        $category = CustomCategory::findOrFail($id);

        $resumes = auth()->user()->resumes()->get()->all();

        foreach($resumes as $res) {
            $visibleSections = json_decode($res->visible_sections);
            $k = array_search($category->category_title, $visibleSections);
            if($k) array_splice($visibleSections, $k, 1);
            $res->visible_sections = json_encode($visibleSections);
            $res->save();
        }

        $category->resumes()->detach();

        CustomCategory::destroy($id);

        return $id;
    }
}
