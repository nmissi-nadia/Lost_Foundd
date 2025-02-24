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
     public function index(Request $request)
     {
        $query = Annonce::with('user', 'categorie');
        if ($request->has('type') && $request->type !== 'all') {
            $query->where('type', $request->type);
        }
        if ($request->has('categorie') && $request->categorie !== 'all') {
            $query->where('categorie_id', $request->categorie);
        }
        // Recherche par titre ou description
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('titre', 'LIKE', "%{$search}%")
                  ->orWhere('description', 'LIKE', "%{$search}%")
                  ->orWhere('lieu', 'LIKE', "%{$search}%");
            });
        }

        // Tri
        $sort = $request->get('sort', 'latest');
        switch ($sort) {
            case 'oldest':
                $query->oldest();
                break;
            case 'latest':
            default:
                $query->latest();
                break;
        }

        $annonces = $query->paginate(9);
        $categories = Categorie::all();

        return view('dashboard', compact('annonces', 'categories'));
     }
 
     // Afficher une annonce
     public function show($id)
     {
         $annonce = Annonce::with('user', 'commentaires.user')->findOrFail($id);
         return view('Annonce.detailsAnnounce', compact('annonce'));
     }
 
     // Créer une annonce
     public function store(Request $request)
     
     {
        
         // Création d'une nouvelle instance d'Annonce
         $annonce = new Annonce();
         $annonce->type = $request->input('type');
         $annonce->titre = $request->input('title');
         $annonce->description = $request->input('description');
         $annonce->date_perdu_trouve = $request->input('date');
         $annonce->lieu = $request->input('location');
         $annonce->categorie_id = $request->input('categorie_id');
         $annonce->user_id = auth()->id(); // Associer l'utilisateur connecté
    
         // Vérifier si une photo a été uploadée
         if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('Annonce', 'public'); 
            $annonce->photo = $photoPath; 
        }
        
         $annonce->save();
         return redirect()->route('dashboard')->with('success', 'Annonce créée avec succès.');
     }
     
     public function destroy($id)
     {
         // Trouver l'annonce par ID et la supprimer
         $annonce = Annonce::findOrFail($id);
         $annonce->delete();
     
         // Rediriger avec un message de succès
         return redirect()->route('dashboard')->with('success', 'Annonce supprimée avec succès.');
     }
     public function update(Request $request, $id)
        {
           
            $validatedData = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'location' => 'required|string|max:255',
                'type' => 'required|in:lost,found', // Assuming you have a type field
                'image' => 'nullable|image|max:2048', // Optional image field
            ]);

            $annonce = Annonce::findOrFail($id);

            // Update the announcement details
            $annonce->titre = $validatedData['title'];
            $annonce->description = $validatedData['description'];
            $annonce->lieu = $validatedData['location'];
            $annonce->type = $validatedData['type'];

            // Handle image upload if present
            if ($request->hasFile('image')) {
                // Delete old image if necessary
                if ($annonce->photo) {
                    Storage::delete($annonce->photo);
                }
                $path = $request->file('image')->store('images', 'public');
                $annonce->photo = $path; // Save the path to the new image
            }

            $annonce->save(); // Save the updated announcement

            // Redirect back to the announcement page with a success message
            return redirect()->route('annonce.show', $annonce->id)->with('success', 'Annonce mise à jour avec succès!');
        }

     public function edit($id)
     {
         $annonce = Annonce::findOrFail($id);
         $categories = Categorie::all(); // Pour le dropdown des catégories
         return view('Annonce.edit', compact('annonce'));
     }

     public function read($id){
        
     }

}
