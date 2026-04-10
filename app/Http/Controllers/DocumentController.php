<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;
use App\Models\Matiere;
use App\Models\Niveau;

class DocumentController extends Controller
{
  public function index() {
        $documents = Document::where('idUtilisateur', auth()->id())->with('matiere','niveau')->get();
        $matieres  = Matiere::all();
        $niveaux   = Niveau::all();
        return view('user.dashboard', compact('documents', 'matieres', 'niveaux'));
    }

    public function store(Request $request) {
        $request->validate([
            'titre'      => 'required|string|max:255',
            'idMatiere'  => 'required|exists:matieres,idMatiere',
            'idNiveau'   => 'required|exists:niveaux,idNiveau',
        ]);
        Document::create([
            'idUtilisateur' => auth()->id(),
            'idMatiere'     => $request->idMatiere,
            'idNiveau'      => $request->idNiveau,
            'titre'         => $request->titre,
            'description'   => $request->description,
        ]);

        return back()->with('success', 'Tâche ajoutée !');
    }

    public function toggleTermine(Document $document) {
        if ($document->idUtilisateur !== auth()->id()) abort(403);
        $document->update(['termine' => !$document->termine]);
        return back();
    }  
    public function destroy(Document $document) {
        if ($document->idUtilisateur !== auth()->id()) abort(403);
        $document->delete();
        return back()->with('success', 'Tâche supprimée.');
    }
}
