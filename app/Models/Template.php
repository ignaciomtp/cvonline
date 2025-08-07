<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    use HasFactory;

    public function resumes() {
        return $this->HasMany(Resume::class);
    }

    public function settings() {
        return $this->hasOne(DefaultTemplateSetting::class);
    }
}
