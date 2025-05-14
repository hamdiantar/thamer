<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'title',
        'level_id',
        'sch',
        'lecture_hours',
        'practical_hours',
        'clinical_hours'
    ];

    public function level(): BelongsTo
    {
        return $this->belongsTo(Level::class);
    }

    public function prerequisites(): BelongsToMany
    {
        return $this->belongsToMany(Course::class, 'course_prerequisites', 'course_id', 'prerequisite_id');
    }

    public function corequisites(): BelongsToMany
    {
        return $this->belongsToMany(Course::class, 'course_corequisites', 'course_id', 'corequisite_id');
    }

    public function classes(): HasMany
    {
        return $this->hasMany(ClassModel::class);
    }
}
