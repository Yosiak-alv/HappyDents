<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BranchOffice extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function patients() : hasMany
    {
        return $this->hasMany(Patient::class);
    }
}
