<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategorieController extends Controller
{

    public function index()
    {
        $categories = Categorie::all();
        return view('./admin/categories', compact('categories'));
    }

    /**
     * Show the form for creating a new category.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:categories',
            'description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $category = Categorie::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->back()
            ->with('success', 'Catégory created with success!');
    }


    public function edit(Categorie $category)
    {
        return view('categories.edit', compact('categorie'));
    }

    public function update(Request $request, $id)
    {
        // dd($request['id']);
        $category = Categorie::findOrFail($request['id']);
        // dd($category);
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255|unique:categories,name,' . $category->id . ',id',
                'description' => 'nullable|string',
            ]);
            
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        




        try {
            $category->name = $request->name;
            $category->description = $request->description;
            $category->save();

        } catch (Exception $e) {
            return $e->getMessage();
        }

        return redirect()->back()
            ->with('success', 'Catégorie mise à jour avec succès!');
    }


    public function destroy($id)
    {        // Check if category has contents

        $category = Categorie::find($id);
        //   return $category->activities;
        if ($category->activities->count() > 0) {

            return back()
                ->with('error', 'deleting is impossible, category has its own activities.');
        }

        $category->delete();


        return back()
            ->with('success', 'Catégorie supprimée avec succès!');
    }
}
