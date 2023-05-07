<?php

namespace App\Models\clinic;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Visit extends Model
{
    use HasFactory, SoftDeletes;
    public $timestamps = false;

    public function patient():BelongsTo{
        return $this->belongsTo(Patient::class);
    }
    public function treatment():BelongsTo{
        return $this->belongsTo(Treatment::class);
    }

}
