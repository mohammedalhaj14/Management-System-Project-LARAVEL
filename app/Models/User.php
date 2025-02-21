<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    protected $primaryKey = 'userID';
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = ['fName', 'lName', 'father', 'mother', 'address', 'phone', 'birthdate', 'role', 'genderID', 'nationalityID', 'classID', 'email', 'password'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function gender()
    {
        return $this->belongsTo(Gender::class, 'genderID');
    }
    public function nationality()
    {
        return $this->belongsTo(Nationality::class, 'nationalityID');
    }
    public function class()
    {
        return $this->belongsTo(Classe::class, 'classID');
    }
    // public function classes()
    // {
    //     return $this->belongsToMany(Classe::class, 'class_teachers', 'userID', 'classID');

    // }
    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'teacher_subjects', 'userID', 'subjectID');
    }

    public function classes(): BelongsToMany
    {
        return $this->belongsToMany(Classe::class, 'subject_teacher_classes', 'userID', 'cLassID')->withPivot('subjectID');
    }
}
