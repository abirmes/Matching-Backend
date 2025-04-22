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
        return view('types.index', compact('types'));
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
            'name' => 'required|string|max:255|unique:type',
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

        return redirect()->route('types.index')
            ->with('success', 'type created with success!');
    }

    
    public function edit(Type $type)
    {
        return view('categories.edit', compact('categorie'));
    }

    public function update(Request $request, Type $type)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:categories,name,' . $type->id,
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

        return redirect()->route('categories.index')
            ->with('success', 'Catégorie mise à jour avec succès!');
    }

    
    public function destroy(Type $category)
    {
        // Check if category has contents
        if ($category->activities()->count() > 0) {
            return redirect()->route('types.index')
                ->with('error', 'deleting is impossible, type has its own activities.');
        }

        $category->delete();

        return redirect()->route('types.index')
            ->with('success', 'Type deleted succefully!');
    }
}
