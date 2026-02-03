<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
   protected $fillable = [
    'user_id',
    'course_id',
    'grade_value',
    'notes',
];
 public function student()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
}
