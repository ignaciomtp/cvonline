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
        $data = Template::all();

        $templates = [];

        foreach($data as $d) {
            array_push($templates, $d->toArray());
        }


        return Inertia::render('Templates', ['templates' => $templates]);
    }

    public function editTemplate($id) {
        $template = Template::find($id);
        $settings = $template->settings->toArray();

        return Inertia::render('TemplateEditor', ['template' => $template, 'settings' => $settings]);
    }

}
