<?php

namespace App\Repositories;

use App\Models\Adresse;
use App\Models\Categorie;
use App\Models\Centre;
use App\Models\Type;
use App\Repositories\Interfaces\ActivityRepositoryInterface;

class ActivityRepository implements ActivityRepositoryInterface{


    public function getAllTypes(){
        return Type::all();
    }
    public function getAllCategories(){
        return Categorie::all();
    }
    public function getAllcountries(){
        $countries = Adresse::pluck('country');
        return $countries;
    }
    public function getAllCities(){
        $cities = Adresse::pluck('city');
        return $cities;
    }
    public function getAllBoulevards(){
        $boulevards = Adresse::pluck('boulevard');
        return $boulevards;
    }
        
    public function getAllcenters() {
        return Centre::all();
    }

    public function getAllspecialities()
    {
        $specialities = Centre::pluck('specialite');
        return $specialities;
    }
}