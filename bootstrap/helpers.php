<?php


use App\Models\Resume;
use App\Models\Experience;
use App\Models\Formation;
use App\Models\Skill;
use App\Models\DefaultTemplateSetting;
use Knp\Snappy\Pdf;

if (! function_exists('getAllExperiences')) {
    function getAllExperiences(Resume $cv) {
        $experiencesCv = $cv->experiences()->get()->all();

        $experiencesUser = auth()->user()->experiences()->get()->all();

        $experiences = [];

        foreach($experiencesUser as $exp) {
            $var = new \stdClass();

            $var = clone $exp;
            $var->inCv = false;

            foreach($experiencesCv as $ecv) {
                if($ecv->id == $exp->id) {
                    $var->inCv = true;
                    break;
                }
            }

            array_push($experiences, $var);
        }

        return $experiences;
    }
}

if (! function_exists('getAllFormations')) {
    function getAllFormations(Resume $cv) {
        
        $formationsCv = $cv->formations()->where('type', 'académica')->get()->all();

        $formationsUser = auth()->user()->formations()->where('type', 'académica')->get()->all();

        $formations = [];

        foreach($formationsUser as $exp) {
            $var = new \stdClass();

            $var = clone $exp;
            $var->inCv = false;

            foreach($formationsCv as $ecv) {
                if($ecv->id == $exp->id) {
                    $var->inCv = true;
                    break;
                }
            }

            array_push($formations, $var);
        }

        return $formations;
    }
}

if (! function_exists('getAllComplementaryFormations')) {
    function getAllComplementaryFormations(Resume $cv) {
        
        $formationsCv = $cv->formations()->where('type', 'complementaria')->get()->all();

        $formationsUser = auth()->user()->formations()->where('type', 'complementaria')->get()->all();

        $formations = [];

        foreach($formationsUser as $exp) {
            $var = new \stdClass();

            $var = clone $exp;
            $var->inCv = false;

            foreach($formationsCv as $ecv) {
                if($ecv->id == $exp->id) {
                    $var->inCv = true;
                    break;
                }
            }

            array_push($formations, $var);
        }

        return $formations;
    }
}

if (! function_exists('getAllSkills')) {
    function getAllSkills(Resume $cv) {
        $skillsCv = $cv->skills()->get()->all();

        $skillsUser = auth()->user()->skills()->get()->all();

        $skills = [];

        foreach($skillsUser as $exp) {
            $var = new \stdClass();

            $var = clone $exp;
            $var->inCv = false;

            foreach($skillsCv as $ecv) {
                if($ecv->id == $exp->id) {
                    $var->inCv = true;
                    break;
                }
            }

            array_push($skills, $var);
        }

        return $skills;
    }
}

if (! function_exists('getAllLanguages')) {
    function getAllLanguages(Resume $cv) {
        $languagesCv = $cv->languages()->get()->all();

        $languagesUser = auth()->user()->languages()->get()->all();

        $languages = [];

        foreach($languagesUser as $exp) {
            $var = new \stdClass();

            $var = clone $exp;
            $var->inCv = false;

            foreach($languagesCv as $ecv) {
                if($ecv->id == $exp->id) {
                    $var->inCv = true;
                    break;
                }
            }

            array_push($languages, $var);
        }

        return $languages;
    }
}

if (! function_exists('generateCV')) {
    function generateCV($user, $cv) {
        if($cv->description == null) $cv->description = auth()->user()->profile;

        $visibleSections = json_decode($cv->visible_sections);

        $experiences = $cv->experiences()->get()->all();

        foreach($experiences as $exp) {
            // Limpiar el HTML de job_description
            $exp->job_description = strip_tags($exp->job_description, '<ul><li>'); // Permitir solo ul y li
            $exp->job_description = preg_replace('/\s+/', ' ', $exp->job_description); // Eliminar espacios extra

            $formattedStart = date('m/Y', strtotime($exp->date_start));


            if($exp->date_finish) {
                $formattedFinish = date('m/Y', strtotime($exp->date_finish));
            } else {
                $formattedFinish = "Actualidad";
            }

            $exp->date_start = $formattedStart;
            $exp->date_finish = $formattedFinish;
        }

        $formations = $cv->formations()->where('type', 'académica')->get()->all();

        foreach($formations as $for) {
            $formattedFinish = date('Y', strtotime($for->date_finish));
            $for->date_finish = $formattedFinish;
        }

        $complementary_formations = $cv->formations()->where('type', 'complementaria')->get()->all();

        $skills = $cv->skills()->get()->all();
        $languages = $cv->languages()->get()->all();
        $profile = $cv->description; 
        $color = $cv->color_1;
        $colorIcons = $cv->color_2;
        $offer = $cv->offer;
        //$colorIcons = config("colors.".$cv->color_2);

        // coger los estilos por defecto de la plantilla
        /*$template = $cv->template;
        $settings = $template->settings ? $template->settings->toArray() : []; */

        if($cv->settings) {
            $settings = $cv->settings->toArray();
        } else {
            $template = $cv->template;
            $settings = $template->settings->toArray();
        }


        $data = [
            'user' => $user,
            'experiences' => $experiences,
            'formations' => $formations,
            'complementary_formations' => $complementary_formations,
            'skills' => $skills,
            'languages' => $languages,
            'visibleSections' => $visibleSections,
            'profile' => $profile,
            'color' => $color,
            'colorIcons' => $colorIcons,
            'offer' => $offer,
            'settings' => $settings,
        ];

/*
        return view('cv.'.$cv->template->view.$pdf, compact('user', 'experiences', 'formations', 'complementary_formations', 'skills', 'languages', 'visibleSections', 'profile', 'color', 'colorIcons', 'offer', 'settings'));  

*/

        return $data;

    }
}
