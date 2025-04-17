<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    public function role()
    {
      return $this->belongsTo(Role::class);
    }

    public function adresse()
    {
      return $this->belongsTo(Adresse::class);
    }

    public function teams()
    {
      return $this->belongsToMany(Team::class);
    }
    
    public function activities()
    {
      return $this->belongsToMany(Activity::class);
    }
    
    protected $hidden = [
        'password',
        'remember_token',
    ];

    
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    public function getJWTIdentifier()
    {
      return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
      return [
        'email'=>$this->email,
        'name'=>$this->name
      ];
    }

}
