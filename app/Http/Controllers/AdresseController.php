<?php

namespace App\Http\Controllers;

use App\Models\Adresse;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use function PHPUnit\Framework\isEmpty;

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
            ->with('success', 'Adresse created with success!');
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
            ->with('success', 'Adresse updated successfully!');
    }

    public function destroy($id)
    {        // Check if category has contents

        // return $request->all();
        $adresse = Adresse::find($id);
        // return $adresse->users;
        // if($adresse->users->isNotEmpty())
        // { return 'true';}
        // else{
        //     return $adresse->users;
        // }
        if ($adresse->centre != null ) {

            return back()
                ->with('error', 'deleting is impossible, Adresse has centers in it.');
        }

        if ( $adresse->users->isNotEmpty()) {

            return back()
                ->with('error', 'deleting is impossible, Adresse has users in it.');
        }

        $adresse->delete();


        return back()
            ->with('success', 'Adress deleted successfully!');
    }



}
