<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resume;
use App\Models\CustomViewSetting;



class CustomViewSettingController extends Controller
{
    public function changeSettings(Request $request)
    {
        $cv = Resume::findOrFail($request->cv_id);

        $settings = $cv->settings()->where('template_id', $request->template_id)->first();

        if(!$settings) {
            $settings = new CustomViewSetting;

            foreach($cv->template->toArray() as $key => $value) {
                if(property_exists($settings, $key) && $key != 'id') $settings[$key] = floatval($value);                
            }
        }


        $settings->resume_id = $request->cv_id;
        $settings->template_id = $request->template_id;
        $settings[$request->field] = $request->value;

        $settings->save();

        return $settings;
    }
}
