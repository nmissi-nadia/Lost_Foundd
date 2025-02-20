<?php

namespace App\Http\Controllers;
use App\Models\Categorie;
use App\Models\Annonce;
use Illuminate\Http\Request;

class AnnonceController extends Controller
{
        public function create()
    {
        $categories = Categorie::all();
        return view('Annonce.publierAnnounce', compact('categories'));
    }

     // Liste des annonces
     public function index()
     {
         $annonces = Annonce::with('user', 'categorie')->latest()->get();
         return view('dashboard', compact('annonces'));
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
        dd($request);
         // Création d'une nouvelle instance d'Annonce
         $annonce = new Annonce();
         $annonce->titre = $request->input('title');
         $annonce->description = $request->input('description');
         $annonce->date_perdu_trouve = $request->input('date');
         $annonce->lieu = $request->input('location');
         $annonce->categorie_id = $request->input('category');
         $annonce->user_id = auth()->id(); // Associer l'utilisateur connecté
     
         // Vérifier si une photo a été uploadée
         if ($request->hasFile('photo')) {
             $photoPath = $request->file('photo')->store('Annonce/photos', 'public'); // Stocker la photo
             $annonce->photo = $photoPath; // Enregistrer le chemin de la photo
         }
     
         // Sauvegarder l'annonce dans la base de données
         $annonce->save();
     
         // Rediriger avec un message de succès
         return redirect()->route('dashboard')->with('success', 'Annonce créée avec succès.');
     }
     


}
