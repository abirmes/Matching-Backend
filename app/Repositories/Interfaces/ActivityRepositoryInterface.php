<?php

namespace App\Repositories\Interfaces;


interface ActivityRepositoryInterface {
    public function getAllTypes();
    public function getAllCategories();
    public function getAllcountries();
    public function getAllCities();
    public function getAllcenters();
    public function getAllBoulevards();
    public function getAllspecialities();

}