<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $primaryKey = 'idDocument';
    
    protected $fillable = [
        'idUtilisateur', 'idMatiere', 'idNiveau',
        'titre', 'description', 'fichier', 'termine'
    ];

    public function utilisateur() {
        return $this->belongsTo(User::class, 'idUtilisateur', 'idUtilisateur');
    }

    public function matiere() {
        return $this->belongsTo(Matiere::class, 'idMatiere', 'idMatiere');
    }

    public function niveau() {
        return $this->belongsTo(Niveau::class, 'idNiveau', 'idNiveau');
    }
}
