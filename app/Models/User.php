<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'surname',
        'phone',
        'job',
        'address',
        'zip',
        'city',
        'province',
        'country',
        'photo',
        'web',
        'profile',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    public function resumes() {
        return $this->hasMany(Resume::class);
    }

    public function experiences() {
        return $this->hasMany(Experience::class);
    }

    public function skills() {
        return $this->hasMany(Skill::class);
    }

    public function formations() {
        return $this->hasMany(Formation::class);
    }

    public function languages() {
        return $this->hasMany(Language::class);
    }

    public function customCategories() {
        return $this->hasMany(CustomCategory::class);
    }

    public function customItems() {
        return $this->hasMany(CustomItem::class);
    }
    
}
