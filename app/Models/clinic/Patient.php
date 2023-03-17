<?php

namespace App\Models\clinic;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Patient extends Model
{
    use HasFactory;
    public $timestamps = false;

    //los filtros 
    public function scopeFilter($query, Array $filters){
        $query->when($filters['search'] ?? false, function( $query, $search){
            $query->where(fn($query) =>
            $query->where('name','like','%'.$search.'%')
                ->orWhere('lastname','like','%'.$search.'%')
                ->orWhere('dui','like','%'.$search.'%')

            );
        });
    }

    public function branch_office(): belongsTo
    {
        return $this->belongsTo(BranchOffice::class,'branch_office_id');
    }
    public function detentions() : BelongsToMany
    {
        return $this->belongsToMany(Detention::class,'odontograms');
    }
    public function hospitalizations() : hasMany
    {
        return $this->hasMany(Hospitalization::class);
    }
    public function diagnostics() : hasMany
    {
        return $this->hasMany(Diagnostic::class);
    }

    public function systems() : BelongsToMany
    {
        return $this->belongsToMany(System::class ,'patient_systems');
    }
    public function family_backgrounds() : hasMany
    {
        return $this->hasMany(FamilyBackground::class);
    }
    public function visits() : hasMany
    {
        return $this->hasMany(Visit::class);
    }
}
