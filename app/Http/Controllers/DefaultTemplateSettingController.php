<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\DefaultTemplateSetting;

class DefaultTemplateSettingController extends Controller
{
    public function viewDefaults() {

        $data = DefaultTemplateSetting::all();

        //$settings->toArray();

        $settings = [];

        foreach($data as $d) {
            array_push($settings, $d->toArray());
        }

        return Inertia::render('templates', ['settings' => $settings]);

    }
}
