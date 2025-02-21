<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassTeacher extends Model
{
    protected $primaryKey = 'classTeacherID';
    protected $fillable = ['classID', 'userID'];
}
