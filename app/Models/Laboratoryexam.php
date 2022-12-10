<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Laboratoryexam extends Model
{
    use HasFactory;

    protected $fillable = [
        'exam',
        'description',
        'material',
        'method',
        'use',
        'bibliography',
    ];

    public function exams(): BelongsToMany
    {
        return $this->belongsToMany(Exam::class)->withPivot('value');
    }

    public function referencevalues(): HasMany
    {
        return $this->hasMany(Referencevalue::class);
    }
}
