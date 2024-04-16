<?php

namespace App\Http\Controllers;

use App\Models\Caverne;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class CaverneController extends Controller
{

    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        try {
            $cavernes = Caverne::all();
            return view('caverne.caverne', compact('cavernes'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Une erreur s\'est produite.');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            return view('caverne.creer-caverne');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Une erreur s\'est produite.');
        }
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        try{
        // Validation des données entrées
        $validator = Validator::make($request->all(), [
            'titre' => 'required|min:2',
            'image' => 'required|image|max:2048', // Taille maximale de 2 Mo
            'audio' => 'required|mimes:mp3,wav|max:20480',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        // Traitement de l'image
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagename = $request->titre . uniqid() . '.' . $image->getClientOriginalExtension();
            $imagepath = storage_path('/app/public/images');
            $image->move($imagepath, $imagename);
        }

        // Traitement de l'audio
        if ($request->hasFile('audio')) {
            $audio = $request->file('audio');
            $audioname = $request->titre . uniqid() . '.' . $audio->getClientOriginalExtension();
            $audiopath = storage_path('/app/public/audios');
            $audio->move($audiopath, $audioname);
        }

        // Créer une nouvelle instance de Caverne avec les données
        $caverne = new Caverne();
        $caverne->titre = $request->titre;
        $caverne->image = $imagename;
        $caverne->audio = $audioname;
        $caverne->save();

        return redirect()->route('caverne.index')->with('success', 'Caverne crée avec succès!');
        }
        catch (\Exception $e) {
            return redirect()->back()->with('error', 'Une errer s\'est produite.');
        }
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $caverne = Caverne::find($id);
            return view('caverne.modifier-caverne', compact('caverne'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Une erreur s\'est produite.');
        }


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            // Validation des données entrées
            $validator = Validator::make($request->all(), [
                'titre' => 'required|min:2',
                'image' => 'image|max:2048', // Taille maximale de 2 Mo
                'audio' => 'mimes:mp3,wav|max:20480',
            ]);
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }

            // Récupérer la caverne à mettre à jour
            $caverne = Caverne::findOrFail($id);

            // Traitement de l'image s'il y a un fichier envoyé
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imagename = $request->titre . uniqid() . '.' . $image->getClientOriginalExtension();
                $imagepath = storage_path('/app/public/images');
                $image->move($imagepath, $imagename);

                // Supprimer l'ancienne image si elle existe
                if ($caverne->image) {
                    Storage::disk('public')->delete('images/' . $caverne->image);
                }

                $caverne->image = $imagename;
            }

            // Traitement de l'audio s'il y a un fichier envoyé
            if ($request->hasFile('audio')) {
                $audio = $request->file('audio');
                $audioname = $request->titre . uniqid() . '.' . $audio->getClientOriginalExtension();
                $audiopath = storage_path('/app/public/audios');
                $audio->move($audiopath, $audioname);

                // Supprimer l'ancien audio s'il existe
                if ($caverne->audio) {
                    Storage::disk('public')->delete('audios/' . $caverne->audio);
                }

                $caverne->audio = $audioname;
            }

            // Mettre à jour les autres champs
            $caverne->titre = $request->titre;
            $caverne->save();
            return redirect()->route('caverne.index')->with('success', 'Caverne mise à jour avec succès.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Une erreur s\'est produite.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
         try {
            // Récupérer la caverne à supprimer
            $caverne = Caverne::findOrFail($id);
            // Supprimer l'image associée s'il y en a une
            Storage::disk('public')->delete('images/' . $caverne->image);
            Storage::disk('public')->delete('audios/' . $caverne->audio);
            $histoires = $caverne->histoires();
            foreach($histoires as $histoire)
            {
                Storage::disk('public')->delete('images/' . $histoire->image);
                Storage::disk('public')->delete('audios/' . $histoire->audio);
                Storage::disk('public')->delete('audios/' . $histoire->intro);
                // Supprimer l'histoire de la base de données
                $histoire->delete();
            }
            $caverne->delete();
            return redirect()->route('caverne.index')->with('success', 'Caverne supprimée avec succès!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Une erreur s\'est produite.');
        }
    }
}
