<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instructor extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'name'];

    public function departments()
    {
        return $this->belongsToMany(Department::class, 'department_instructor');
    }

    public function classes()
    {
        return $this->hasMany(ClassModel::class);
    }
}
