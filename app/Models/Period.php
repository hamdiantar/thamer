<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Period extends Model
{
    use HasFactory;

    protected $fillable = ['number', 'start_time', 'end_time'];

    public function classes()
    {
        return $this->hasMany(ClassModel::class);
    }
}
