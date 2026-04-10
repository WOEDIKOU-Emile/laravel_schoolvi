<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Niveau extends Model
{
    protected $primaryKey = 'idNiveau';
    protected $table = 'niveaux';
    public $timestamps = false;

    protected $fillable = ['nomNiveau'];

    public function documents()
    {
        return $this->hasMany(Document::class, 'idNiveau', 'idNiveau');
    }
}
