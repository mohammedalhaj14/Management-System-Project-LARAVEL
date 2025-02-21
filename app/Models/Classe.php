<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Classe extends Model
{
    protected $primaryKey = 'classID';
    protected $fillable = ['languageID', 'sectionID', 'certificateDepartmentID', 'roomNbr', 'nbrStud', 'maxNbrStud', 'schoolarYear'];
    public function students(): HasMany
    {
        return $this->hasMany(User::class, 'classID', 'classID');
    }
}
