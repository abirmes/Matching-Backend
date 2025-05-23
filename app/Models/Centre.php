<?php

namespace App\Models;

use App\Enums\CentreSpecialite;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Centre extends Model
{
    use HasFactory;
    protected $fillable = [
        'etat',
        'name',
        'specialite' => CentreSpecialite::class,
    ];

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }

    public function adresse()
    {
        return $this->belongsTo(Adresse::class);
    }
}
