<?php

namespace App\Http\Controllers;

use App\Enums\CentreSpecialite;
use App\Models\Activity;
use App\Models\Adresse;
use App\Models\Categorie;
use App\Models\Centre;
use App\Models\Participer;
use App\Models\Type;
use App\Repositories\Interfaces\ActivityRepositoryInterface;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    protected $activityRepository;

    public function __construct(ActivityRepositoryInterface $activityRepository)
    {
        $this->activityRepository = $activityRepository;
    }
    public function index(Request $request)
    {
        $activities = [];

        if ($request->has('categorie_name') && $request->categorie_name) {
            $categorie = Categorie::where('name', $request['categorie_name'])->first();
            $activities = Activity::where('categorie_id', $categorie->id)->where('date_debut', '>=',  Carbon::now())->get();
        } else {
            $activities = Activity::where('date_debut', '>=',  Carbon::now())->get();
        }

        $categories = Categorie::all();

        return view('home', [
            'activities' => $activities,
            'categories' => $categories
        ]);
    }

    public function GetSameCityActivities()
    {
        $user = auth()->user();
        return $user;
    }

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
        try {
            $fields = $request->validate([
                'name' => 'required|string|max:255',
                'date_debut' => 'required|date|before:date_fin',
                'date_fin' => 'required|date|after:date_debut',
                'min_participants' => 'required|integer|min:1',
                'max_participants' => 'required|integer|min:1',
                'type_id' => 'required',
                'categorie_id' => 'required',
                'country' => 'required|string|max:255',
                'city' => 'required|string|max:255',
                'boulevard' => 'required|string|max:255',
                'centre_id' => 'required',
                'image' => 'nullable',
            ]);
        } catch (Exception $e) {
            return redirect()->back()->with('error' , $e->getMessage());
        }




        $adresse = Adresse::where('country', $fields['country'])
            ->where('city', $fields['city'])
            ->where('boulevard', $fields['boulevard'])
            ->first();

        if(!$adresse){
            return redirect()->back()->with('error' , 'There is no centers on this adresse, please chose an existing adresse');
        }

        try {
            $centre = Centre::where('id', $fields['centre_id'])
                ->where('adresse_id', $adresse->id)
                ->first();
        } catch (Exception $e) {
            return $e->getMessage();
        }
        try {
            $activity = new Activity();
            $activity->name = $fields['name'];
            $activity->image = $fields['image'];
            $activity->date_debut = $fields['date_debut'];
            $activity->date_fin = $fields['date_fin'];
            $activity->participants = 0;
            $activity->max_participants = $fields['max_participants'];
            $activity->min_participants = $fields['min_participants'];
            $type = Type::find($fields['type_id']);
            $categorie = Categorie::find($fields['categorie_id']);
            $activity->type()->associate($type->id);
            $activity->categorie()->associate($categorie->id);
            $activity->centre()->associate($centre->id);
            $activity->save();
        } catch (Exception $e) {
            return $e->getMessage();
        }
        return redirect()->route('activities.index');
    }




    public function show($id)
    {
        $activity = Activity::findOrFail($id);
        return view('/activityDetails', compact('activity'));
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
        return  CentreSpecialite::cases();
    }

    public function delete($id)
    {




        $user = auth()->user()->id;
        $activity = Activity::find($id);
        $date_debut = Carbon::parse($activity->date_debut);
        $now = Carbon::now();
        if ($now->diffInHours($date_debut) < 24) {
            return redirect()->route('userActivities')->with('error', 'the activity is about to begin , can not leave it');
        }
        $activity->users()->detach($user);
        $activity->participants--;
        $activity->save();
        return redirect()->route('userActivities')->with('success', 'you left that activity');
    }
}
