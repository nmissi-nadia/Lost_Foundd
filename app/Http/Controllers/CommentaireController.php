<?php

namespace App\Http\Controllers;
use App\Models\Commentaire;
use Illuminate\Http\Request;

class CommentaireController extends Controller
{
    // Ajouter un commentaire
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'contenu' => 'required|string|max:1000',
            'annonce_id' => 'required|exists:annonces,id',
        ]);

        // Create a new comment
        $commentaire = new Commentaire();
        $commentaire->contenu = $request->contenu;
        $commentaire->annonce_id = $request->annonce_id;
        $commentaire->user_id = auth()->id(); // Assuming user is authenticated

        $commentaire->save();

        // Redirect back to the announcement page with a success message
        return redirect()->route('annonce.show', $request->annonce_id)->with('success', 'Commentaire ajouté avec succès!');
    }
    // Afficher les commentaire
}
