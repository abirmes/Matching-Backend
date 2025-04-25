<?php

namespace App\Http\Controllers;

use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TypeController extends Controller
{
    public function index()
    {
        $types = Type::all();
        return view('/admin/types', compact('types'));
    }

    /**
     * Show the form for creating a new category.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('type.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:types',
            'description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $type = Type::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->back()
            ->with('success', 'type created with success!');
    }

    
    public function edit(Type $type)
    {
        return view('types.edit', compact('types'));
    }

    public function update(Request $request, $id)
    {
        $type = Type::findOrFail($request['id']);
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:types,name,' . $type->id.' ,id',
            'description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $type->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->back()
            ->with('success', 'Type mise à jour avec succès!');
    }

    
    public function destroy($id)
    {
        $type = Type::findOrFail($id);
        // Check if category has contents
        if ($type->activities()->count() > 0) {
            return redirect()->back()
                ->with('error', 'deleting is impossible, type has its own activities.');
        }

        $type->delete();

        return redirect()->back()
            ->with('success', 'Type deleted succefully!');
    }
}
