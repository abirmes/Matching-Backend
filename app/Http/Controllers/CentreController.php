<?php

namespace App\Http\Controllers;

use App\Enums\CentreSpecialite;
use App\Models\Adresse;
use App\Models\Centre;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CentreController extends Controller
{
    public function index()
    {
        $centres = Centre::all();
        $specialities =  CentreSpecialite::cases();
        return view('/admin/centres', ['centres' => $centres , 'specialities' => $specialities]);
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
            DB::commit();
            return redirect()->back();
        } catch (Exception $e) {
            DB::rollback();
            return back()->withErrors(['error' => $e->getMessage()]);

        }
    }


    public function edit($id)
    {
        $centre = Centre::find($id);
        return view('/centre/update', ['centre' => $centre]);
    }

    public function update(Request $request)
    {
        $centre = Centre::findOrFail($request->id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'spaciality' => 'nullable|string',
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $centre->name = $request->name;
        $centre->speciality = CentreSpecialite::from($request['speciality']);
        $centre->etat = $request->etat;
        $centre->save();


        return redirect()->back()->with('success' , 'center modified successfully');
    }

    public function updateCentreAdresse(Request $request)
    {
        $centre = Centre::findOrFail($request->id);

        $validator = Validator::make($request->all(), [
            'country' => 'required|string|max:255',
            'city' => 'string',
            'boulevard' => 'string',
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $centre->adresse->country = $request->country;
        $centre->adresse->city = $request->city;
        $centre->adresse->boulevard = $request->boulevard;
        $centre->adresse->save();
        $centre->save();
        return redirect()->back()
            ->with('success', 'Adresse mise à jour avec succès!');
    }

    public function delete(int $id)
    {
        $centre = Centre::find($id);
        $centre->delete();
        return redirect()->back()->with('success' , 'Center deleted with success');
    }
}
