<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\Template;

class TemplateController extends Controller
{
    public function viewTemplates() {
        $data = Template::with('settings')->get();

        $templates = [];

        foreach($data as $d) {
            array_push($templates, $d->toArray());
        }


        return Inertia::render('Templates', ['templates' => $templates]);
    }
}
