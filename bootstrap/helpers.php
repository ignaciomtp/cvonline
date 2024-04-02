<?php


use App\Models\Resume;
use App\Models\Experience;
use App\Models\Formation;
use App\Models\Skill;

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
