<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Semester extends Model
{
    use HasFactory;

    protected $fillable = [
        'year',
        'season',
        'start_date',
        'end_date',
        'semester_number'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date'
    ];

    public function groups(): BelongsToMany
    {
        return $this->belongsToMany(Group::class, 'group_semester');
    }

    public function classes(): HasMany
    {
        return $this->hasMany(ClassModel::class);
    }
}
