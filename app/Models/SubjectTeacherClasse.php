<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubjectTeacherClasse extends Model
{
    protected $primaryKey = 'subjectTeacherClassID';
    protected $fillable = ['subjectID', 'userID', 'classID'];
}
