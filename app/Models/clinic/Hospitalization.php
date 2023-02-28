<?php

namespace App\Models\clinic;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Hospitalization extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function patient():BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }
}
