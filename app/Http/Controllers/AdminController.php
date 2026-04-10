<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Document;

class AdminController extends Controller
{
    public function dashboard() {
        $users     = User::where('isAdmin', false)->withCount('documents')->get();
        $documents = Document::with('utilisateur','matiere','niveau')->latest()->get();
        return view('admin.dashboard', compact('users', 'documents'));
    }

    public function destroyUser(User $user) {
        $user->delete();
        return back()->with('success', 'Utilisateur supprimé.');
    }
}
