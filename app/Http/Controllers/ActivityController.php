<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Repositories\Interfaces\ActivityRepositoryInterface;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    protected $activityRepository;

    public function __construct(ActivityRepositoryInterface $activityRepository)
    {
        $this->activityRepository = $activityRepository;
    }
    public function index() {}

    public function create()
    {
        $data = [
            'countries'   => $this->getCountries(),
            'cities'      => $this->getCities(), 
            'centers'     => $this->getCenters(),
            'types'       => $this->getTypes(),
            'categories'  => $this->getCategories(),
            'boulevards'  => $this->getBoulevards(),
            'specialities' => $this->getSpecialities()
        ];

        return view('activityCreate', ['data' => $data]);
    }

    public function store(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|string|max:255',
            'date_debut' => 'required|date|before:date_fin',
            'date_fin' => 'required|date|after:date_debut',
            'min_participants' => 'required|integer|min:1',
            'max_participants' => 'required|integer|min:1',
            'type_id' => 'required',
            'image' => 'nullable|url|max:2048',
        ]);
    }




    public function show($id)
    {
        $activity = Activity::findOrFail($id);
        return view('activities.show', compact('activity'));
    }


    public function getCountries()
    {
        return $this->activityRepository->getAllCountries();
    }

    public function getCities()
    {
        return $this->activityRepository->getAllCities();
    }

    public function getCenters()
    {
        return $this->activityRepository->getAllCenters();
    }

    public function getTypes()
    {
        return $this->activityRepository->getAllTypes();
    }

    public function getCategories()
    {
        return $this->activityRepository->getAllCategories();
    }

    public function getBoulevards()
    {
        return $this->activityRepository->getAllBoulevards();
    }
    
    public function getSpecialities()
    {
        return $this->activityRepository->getAllspecialities();
    }
}
