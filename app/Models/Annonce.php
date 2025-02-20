<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Annonce extends Model
{
    
    /**
     * Les attributs pouvant être remplis.
     */
    protected $fillable = [
        'titre',
        'description',
        'photo',
        'date_perdu_trouve',
        'lieu',
        'user_id',
        'categorie_id',
    ];

    /**
     * Les relations.
     */

    // Une annonce appartient à un utilisateur.
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Une annonce peut avoir plusieurs commentaires.
    public function commentaires()
    {
        return $this->hasMany(Commentaire::class, 'annonce_id');
    }

    // Une annonce appartient à une catégorie.
    public function categorie()
{
    return $this->belongsTo(Categorie::class, 'categorie_id');
}

}
