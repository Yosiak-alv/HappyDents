<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class System extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function patients() : BelongsToMany
    {
        return $this->belongsToMany(Patient::class,'patient_systems');
    }

    public function family_backgrounds() : hasMany
    {
        return $this->hasMany(FamilyBackground::class);
    }
}
