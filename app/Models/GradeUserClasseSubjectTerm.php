<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GradeUserClasseSubjectTerm extends Model
{
    protected $primaryKey = 'gradeUserClasseSubjectTermID';
    protected $fillable = ['gradeID','userID','classID','subjectID','termID','role'];
}
