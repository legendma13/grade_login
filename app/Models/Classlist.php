<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classlist extends Model
{
    use HasFactory;
    
    protected $table = 'classlist';
    
    protected $fillable = [
        'teacherID',
        'studentID',
        'subject',
        'grade',
        'status',
    ];
}
