<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'title',
        'level',
        'sch',
        'lecture_hours',
        'practical_hours',
        'clinical_hours'
    ];

    // المتطلبات السابقة
    public function prerequisites()
    {
        return $this->belongsToMany(Course::class, 'course_prerequisites', 'course_id', 'prerequisite_id');
    }

    // المتطلبات المتزامنة
    public function corequisites()
    {
        return $this->belongsToMany(Course::class, 'course_corequisites', 'course_id', 'corequisite_id');
    }

    // الحصص المرتبطة
    public function classes()
    {
        return $this->hasMany(ClassModel::class);
    }
}
