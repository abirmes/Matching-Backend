<?php

namespace App\Http\Controllers;

use App\Models\Center;
use Illuminate\Http\Request;

class CenterController extends Controller
{
    public function index() {
        $centers = Center::all();
        return view('centers' , ['centers' => $centers]);
    }

    public function store(Request $request)
    {
        $fields = $request->validate([

            'category' => 'required',
            'city' => 'required|string|max:255',
            'boulevard' => 'required|string|max:255',
            'country' => 'required|string|max:255',
        ]);
        $center = Center::create($fields);
        return redirect()->route('activityCreate');
    }


    public function edit($id)
    {
        $center = Center::find($id);
        return view('/center/update', ['center' => $center]);
    }

    public function update(Request $request)
    {
        $center = Center::find($request->id);
        $center->name = $request->name;
        $center->speciality = $request->speciality;
        $center->save();


        return redirect()->route('center.index');
    }

    public function delete(int $id)
    {
        $center = Center::find($id);
        $center->delete();
        return redirect()->back();
    }
}
