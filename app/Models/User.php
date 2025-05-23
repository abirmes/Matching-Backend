<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enums\StatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable
{
  use HasApiTokens, HasFactory, Notifiable;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'name',
    'email',
    'password',
    'date_naissance',
    'status' => StatusEnum::class,
    'merite'
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
    return $this->belongsToMany(Activity::class, 'participer')
      ->withPivot('participater_number');
  }

  /**
   * The attributes that should be hidden for serialization.
   *
   * @var array<int, string>
   */
  protected $hidden = [
    'password',
    'remember_token',
  ];

  /**
   * The attributes that should be cast.
   *
   * @var array<string, string>
   */
  protected $casts = [
    'email_verified_at' => 'datetime',
    'password' => 'hashed',
  ];
}
