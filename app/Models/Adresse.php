<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adresse extends Model
{
    use HasFactory;
    protected $fillable = [
        'country',
        'city',
        'boulevard'
    ];
    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function centre()
    {
        return $this->hasOne(Centre::class);
    }
}
