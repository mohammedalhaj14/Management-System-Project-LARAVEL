<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeacherSubject extends Model
{
    protected $primaryKey = 'teacherSubjectID';
    protected $fillable = ['subjectID', 'userID'];
}
