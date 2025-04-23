<?php

namespace App\Http\Controllers;

use App\Enums\CentreSpecialite;
use App\Models\Adresse;
use App\Models\Centre;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CentreController extends Controller
{
    public function index()
    {
        $centres = Centre::all();
        return view('centres', ['centres' => $centres]);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $fields = $request->validate([

                'speciality' => 'required',
                'name' => 'required',
                'city' => 'required|string|max:255',
                'boulevard' => 'required|string|max:255',
                'country' => 'required|string|max:255',
            ]);
            $adresse = new Adresse();
            $adresse->city = $fields['city'];
            $adresse->country = $fields['country'];
            $adresse->boulevard = $fields['boulevard'];
            $adresse->save();
            $centre = new Centre();
            $centre->name = $fields['name'];
            $centre->speciality = CentreSpecialite::from($fields['speciality']);
            $centre->etat = "open";
            $centre->adresse()->associate($adresse->id);
            $centre->save();
            return redirect()->back();
        } catch (Exception $e) {
            DB::rollback();
        }
    }


    public function edit($id)
    {
        $centre = Centre::find($id);
        return view('/centre/update', ['centre' => $centre]);
    }

    public function update(Request $request)
    {
        $centre = Centre::find($request->id);
        $centre->name = $request->name;
        $centre->speciality = $request->speciality;
        $centre->save();


        return redirect()->route('centre.index');
    }

    public function delete(int $id)
    {
        $centre = Centre::find($id);
        $centre->delete();
        return redirect()->back();
    }
}
