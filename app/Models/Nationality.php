<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nationality extends Model
{
    protected $primaryKey = 'nationalityID';
    protected $fillable = ['nationalityName'];
}

