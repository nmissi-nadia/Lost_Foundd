<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnnonceController extends Controller
{
    public function create()
{
    $categories = Categorie::all();
    return view('annonces.create', compact('categories'));
}

     // Liste des annonces
     public function index()
     {
         $annonces = Annonce::with('user', 'categorie')->latest()->get();
         return view('annonces.index', compact('annonces'));
     }
 
     // Afficher une annonce
     public function show($id)
     {
         $annonce = Annonce::with('user', 'commentaires.user')->findOrFail($id);
         return view('annonces.show', compact('annonce'));
     }
 
     // Créer une annonce
     public function store(Request $request)
     {
         $validatedData = $request->validate([
             'titre' => 'required|string|max:255',
             'description' => 'required|string',
             'photo' => 'nullable|image',
             'date_perdu_trouve' => 'required|date',
             'lieu' => 'required|string',
             'categorie_id' => 'required|exists:categories,id',
         ]);
 
         // Enregistrer l'annonce
         $annonce = new Annonce($validatedData);
         $annonce->user_id = auth()->id(); // Associer l'utilisateur connecté
         $annonce->save();
 
         return redirect()->route('annonces.index')->with('success', 'Annonce créée avec succès.');
     }

}
