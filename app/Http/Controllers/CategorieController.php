<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategorieController extends Controller
{
    // Liste des catégories
    public function index()
    {
        $categories = Categorie::all();
        return view('categories.index', compact('categories'));
    }

    // Ajouter une catégorie
    public function store(Request $request)
    {
        $request->validate([
            'categorie' => 'required|string|max:255|unique:categories,categorie',
        ]);

        Categorie::create(['categorie' => $request->categorie]);

        return redirect()->back()->with('success', 'Catégorie ajoutée avec succès.');
    }
}
