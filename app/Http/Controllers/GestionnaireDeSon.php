<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;

class GestionnaireDeSon extends Controller
{
    public function index(){
        $all = musics::all;

        return Inertia::render('Dashboard', [

        ]);
    }
public function ajout()
{
    $name = auth()->user()->name; // Récupère le nom du user connecté

    return Inertia::render('Ajout', [
        'userName' => $name
    ]);
}
public function save(Request $request)
{
    // 1. Validation des données
    $validated = $request->validate([
        'auteur' => 'required|string|max:255',
        'titre' => 'required|string|max:255',
        'audio' => 'required|mimes:mp3,wav,ogg|max:10240', // 10MB
        'image' => 'nullable|image|mimes:jpg,jpeg,png|max:5120', // 5MB
    ]);

    // 2. Sauvegarder les fichiers
    $audioPath = $request->file('audio')->store('audios', 'public');
    $imagePath = $request->hasFile('image') 
        ? $request->file('image')->store('images', 'public')
        : null;

    // 3. Enregistrer en base
    musics::create([
        'auteur' => $validated['auteur'],
        'titre' => $validated['titre'],
        'fichier' => $audioPath,
        'couverture' => $imagePath,
    ]);

    // 4. Redirection avec message
    return redirect()->route('dashboard')->with('success', 'Musique ajoutée avec succès !');
}


}
