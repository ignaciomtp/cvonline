<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Resume extends Model
{
    use HasFactory, HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'user_id',
        'description',
        'offer',
        'visible_sections',
        'color_1',
        'color_2',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function experiences() {
        return $this->belongsToMany(Experience::class);
    }

    public function formations() {
        return $this->belongsToMany(Formation::class);
    }

    public function skills() {
        return $this->belongsToMany(Skill::class);
    }

    public function languages() {
        return $this->belongsToMany(Language::class);
    }

    public function categories() {
        return $this->belongsToMany(CustomCategory::class);
    }

    public function toggleVisibleSection($section) {
        $visibleSections = json_decode($this->visible_sections);

        $k = array_search($section, $visibleSections);

        if($k === false) {
            array_push($visibleSections, $section);
        } else {
            array_splice($visibleSections, $k, 1);
        }


        $this->visible_sections = json_encode($visibleSections);

    }

    public function template() {
        return $this->belongsTo(Template::class);
    }


    public function settings() {
        return $this->hasMany(CustomViewSetting::class);
    }
}
