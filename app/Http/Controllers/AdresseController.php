<?php

namespace App\Http\Controllers;

use App\Models\Adresse;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdresseController extends Controller
{
    public function index()
    {
        $adresses = Adresse::all();
        return view('/admin/adresses' , ['adresses' => $adresses]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'country' => 'required',
            'city' => 'required',
            'boulevard' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $adresse = Adresse::create([
            'country' => $request->country,
            'city' => $request->city,
            'boulevard' => $request->boulevard,
        ]);

        return redirect()->back()
            ->with('success', 'Catégory created with success!');
    }

    public function update(Request $request)
    {
        // dd($request['id']);
        // dd($request->boulevard);
        $adresse = Adresse::findOrFail($request->id);
        // dd($adresse);
        // return $request;
        $validator = Validator::make($request->all(), [
            'country' => 'required',
            'city' => 'required',
            'boulevard' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

            $adresse->country = $request->country;
            $adresse->city = $request->city;
            $adresse->boulevard = $request->boulevard;
            $adresse->save();
        

        return redirect()->back()
            ->with('success', 'Catégorie mise à jour avec succès!');
    }

    public function destroy($id)
    {        // Check if category has contents

        $adresse = Adresse::find($id);
        if ($adresse->centre) {

            return back()
                ->with('error', 'deleting is impossible, Adresse has its own centers.');
        }

        $adresse->delete();


        return back()
            ->with('success', 'Adresse supprimée avec succès!');
    }



}
