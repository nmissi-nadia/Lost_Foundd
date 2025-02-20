<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Commentaire extends Model
{
    /**
     * Les attributs pouvant être remplis.
     */
    protected $fillable = [
        'contenu',
        'user_id',
        'annonce_id',
    ];

    /**
     * Les relations.
     */

    // Un commentaire appartient à une annonce.
    public function annonce()
    {
        return $this->belongsTo(Annonce::class, 'annonce_id');
    }

    // Un commentaire est écrit par un utilisateur.
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
