<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $primaryKey = 'idMessage';
    protected $table = 'messages';

    protected $fillable = ['idUtilisateur', 'idAdmin', 'contenu', 'statut'];

    protected $casts = [
        'dateEnvoi' => 'datetime',
    ];

    public function utilisateur()
    {
        return $this->belongsTo(User::class, 'idUtilisateur', 'idUtilisateur');
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'idAdmin', 'idUtilisateur');
    }
}
