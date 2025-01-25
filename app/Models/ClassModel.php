<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassModel extends Model
{
    protected $table = 'classes';

    protected $fillable = [
        'course_id',
        'instructor_id',
        'room_id',
        'group_id',
        'period_id',
        'day',
        'type',
        'department_id',
        'semester_id',
    ];

    protected $casts = [
        'day' => 'string',
        'type' => 'string'
    ];

    // العلاقات
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function instructor()
    {
        return $this->belongsTo(Instructor::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function period()
    {
        return $this->belongsTo(Period::class);
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
