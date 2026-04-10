<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['nom', 'prenom', 'email', 'password', 'isAdmin'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    use HasFactory;

    protected $primaryKey = 'idUtilisateur';
    protected $fillable = [
        'nom', 'prenom', 'email', 'password', 'isAdmin'
    ];

    protected $hidden = ['password', 'remember_token'];

    public function getAuthPassword() : string
    {
        return $this->password;
    }
    protected $casts = [
        'dateCreation' => 'datetime',
        'isAdmin'      => 'boolean',
    ];

    public function documents() 
    {
        return $this->hasMany(Document::class, 'idUtilisateur', 'idUtilisateur');
    }

    public function messages() 
    {
        return $this->hasMany(Message::class, 'idUtilisateur', 'idUtilisateur');
    }

    public function isAdmin(): bool 
    {
        return $this->isAdmin === true;
    }
}
