<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
    'title',
    'code',
    'description',
    'hours',
];
public function students()
{
    return $this->belongsToMany(User::class, 'enrollments')
                ->withPivot('enrolled_at');
}

public function grades()
{
    return $this->hasMany(Grade::class);
}

}
