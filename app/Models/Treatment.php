<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Treatment extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function visits():HasMany{
        return $this->hasMany(Visit::class);
    }
}
