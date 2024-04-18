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
        $cv->experiences()->attach($category);

        return $category;

    }
}
