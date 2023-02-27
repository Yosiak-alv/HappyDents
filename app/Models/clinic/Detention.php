<?php

namespace App\Models\clinic;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Detention extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function patients() : BelongsToMany
    {
        return $this->belongsToMany(Patient::class,'odontograms');
    }
}
