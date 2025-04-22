<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function index()
    {
        
    }

    public function create()
    {

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
            'category' => 'required',
            'city' => 'required|string|max:255',
            'street' => 'required|string|max:255',
            'postal_code' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'image' => 'nullable|url|max:2048',
        ]);


    }
}
