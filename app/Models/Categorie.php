<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    use HasFactory;

    protected $fillable = ['categorie'];

    // Relation avec les annonces
    public function annonces()
    {
        return $this->hasMany(Annonce::class, 'categorie_id');
    }
}
