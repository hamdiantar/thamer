<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'location'];

    public function classes()
    {
        return $this->hasMany(ClassModel::class);
    }
}
