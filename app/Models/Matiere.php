<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Matiere extends Model
{
    protected $primaryKey = 'idMatiere';
    protected $table = 'matieres';
    public $timestamps = false;

    protected $fillable = ['nomMatiere'];

    public function documents()
    {
        return $this->hasMany(Document::class, 'idMatiere', 'idMatiere');
    }
}
