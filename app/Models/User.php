<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Carbon\Carbon;
use Database\Factories\clinic\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    //protected $fillable = [
        //'name',
        //'email',
        //'password',
    //];
    
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
     
        'remember_token'
    ];
    public function scopeFilter($query , Array $filters){
        $query->when($filters['search'] ?? false, function( $query, $search){
            $query->where(fn($query) =>
            $query->where('name','like','%'.$search.'%')
                ->orWhere('email','like','%'.$search.'%')
                
            );
        });
    }
    //mutator que hashea el atributo password a lo que se le de
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }
    public function getCreatedAtAttribute($created_at)
    {
        return Carbon::parse($created_at)->diffForHumans();    
    }
    public function getUpdatedAtAttribute($updated_at)
    {
        return Carbon::parse($updated_at)->diffForHumans();    
    }
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //protected $with = ['role'];
    public function role():BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    
}
