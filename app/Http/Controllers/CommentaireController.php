<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommentaireController extends Controller
{
    // Ajouter un commentaire
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'contenu' => 'required|string',
            'annonce_id' => 'required|exists:annonces,id',
        ]);

        // Enregistrer le commentaire
        $commentaire = new Commentaire($validatedData);
        $commentaire->user_id = auth()->id(); // Associer l'utilisateur connecté
        $commentaire->save();

        return redirect()->back()->with('success', 'Commentaire ajouté avec succès.');
    }
}
