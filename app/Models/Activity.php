<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'date-debut',
        'date-fin',
        'max-participans',
        'min-participants',
        'participants',

    ];

    public function users()
    {
      return $this->belongsToMany(User::class);
    }

    public function centre()
    {
        return $this->belongsTo(Centre::class);
    }
    public function type()
    {
        return $this->belongsTo(Type::class);
    }
    public function parties()
    {
        return $this->hasMany(Part::class);
    }
    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }

}
