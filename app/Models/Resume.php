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
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function experiences() {
        return $this->hasMany(Experience::class);
    }

    public function formations() {
        return $this->hasMany(Formation::class);
    }

    public function skills() {
        return $this->hasMany(Skill::class);
    }

    public function languages() {
        return $this->hasMany(Language::class);
    }

}
