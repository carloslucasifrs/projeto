<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Referencevalue extends Model
{
    use HasFactory;

    protected $fillable = [
        'rule',
        'biologic_sex',
        'age_min',
        'age_max',
        'value_min',
        'value_max',
        'laboratoryexam_id',
    ];

    public function laboratoryexam(): BelongsTo
    {
        return $this->belongsTo(Laboratoryexam::class);
    }
}
