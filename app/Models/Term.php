<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
    protected $primaryKey = 'termID';
    protected $fillable = ['termName','active'];
    use HasFactory;
}
