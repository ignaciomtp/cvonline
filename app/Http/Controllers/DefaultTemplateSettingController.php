<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\DefaultTemplateSetting;

class DefaultTemplateSettingController extends Controller
{


    public function updateTemplateDefaults(Request $request) {
        $default = DefaultTemplateSetting::findOrFail($request->id);

        $default->address_line_height = $request->address_line_height;
        $default->address_size = $request->addres_size;
        $default->base_font_size = $request->base_font_size;
        $default->base_line_height = $request->base_line_height;
        $default->job_line_height = $request->job_line_height;
        $default->job_size = $request->job_size;
        $default->name_line_height = $request->name_line_height;
        $default->name_size = $request->name_size;
        $default->photo_height = $request->photo_height;
        $default->section_separation = $request->section_separation;
        $default->section_size = $request->section_size;
        $default->sidebar_font_size = $request->sidebar_font_size;
        $default->sidebar_line_height = $request->sidebar_line_height;
        $default->sidebar_section_size = $request->sidebar_section_size;

        $default->save();

        return $default;
    }
}
