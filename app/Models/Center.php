<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Center extends Model
{
    use HasFactory;

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }

    public function adresse()
    {
        return $this->belongsTo(Adresse::class);
    }
}
