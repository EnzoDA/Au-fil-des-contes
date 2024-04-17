<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Caverne;
use App\Models\Histoire;
use App\Models\Tag;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;


class HistoireController extends Controller
{
    public function index($id)
    {
        try {
            $caverne = Caverne::find($id);
            $histoires = $caverne->histoires()->paginate(5);
            return view('caverne.histoire.histoire', compact('caverne', 'histoires'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Une erreur s\'est produite.');
        }
    }

    public function create($id)
    {
        try {
            $tags = Tag::all();
            return view('caverne.histoire.creer-histoire', compact('tags', 'id'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Une erreur s\'est produite.');
        }
    }

    public function store(Request $request, $id)
    {
      try{
            // Validation des données entrées
            $validator = Validator::make($request->all(), [
                'titre' => 'required|min:2',
                'image' => 'required|image|max:2048', // Taille maximale de 2 Mo
                'audio' => 'required|mimes:mp3,wav|max:8096',
                'intro' => 'required|mimes:mp3,wav|max:2048',
            ]);
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }
            // Traitement de l'image
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imagename = uniqid() . '_' . $image->getClientOriginalName();
                $imagepath = storage_path('/app/public/images');
                $image->move($imagepath, $imagename);
            }
            
            // Traitement de l'intro
            if ($request->hasFile('intro')) {
                $intro = $request->file('intro');
                $introname = uniqid() . '_' . $intro->getClientOriginalName();
                $intropath = storage_path('/app/public/audios');
                $intro->move($intropath, $introname);
            }
            
            // Traitement de l'audio
            if ($request->hasFile('audio')) {
                $audio = $request->file('audio');
                $audioname = uniqid() . '_' . $audio->getClientOriginalName();
                $audiopath = storage_path('/app/public/audios');
                $audio->move($audiopath, $audioname);
            }

            $histoire = new Histoire();
            $histoire->titre = $request->titre;
            $histoire->image = $imagename;
            $histoire->audio = $audioname;
            $histoire->intro = $introname;
            $histoire->nb_vue = 0;
            $histoire->note = 0;
            $histoire->nb_notes = 0;
            $histoire->caverne_id =$id;
            $histoire->save();
            // Associer les tags sélectionnées si il y en a 
            if ($request->has('tags')) {
                $tags = $request->tags;
                foreach ($tags as $tag) {
                    $histoire->tags()->attach($tag);
                }
            }
            return redirect()->route('histoire.index', $id)->with('success', 'Histoire ajoutée avec succès');
        }
        catch(\Exception $e)
        {
            return redirect()->back()->with('error', 'Une erreur s\'est produite');
        }
    }


    public function destroy($id, Request $request)
    {
        try {
            // Récupérer l'histoire à supprimer
            $histoire = Histoire::findOrFail($request->iddestroy);
            // Supprimer l'image associée s'il y en a une
            Storage::disk('public')->delete('images/' . $histoire->image);
            Storage::disk('public')->delete('audios/' . $histoire->audio);
            Storage::disk('public')->delete('audios/' . $histoire->intro);
            // Supprimer l'histoire de la base de données
            $histoire->delete();
            return redirect()->route('histoire.index', $id)->with('success', 'Histoire supprimée avec succès!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Une erreur s\'est produite.');
        }

    }

    public function edit($id, Request $request)
    {
        try {
            $histoire = Histoire::find($request->idupdate);
            return view('caverne.histoire.modifier-histoire', compact('histoire', 'id'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Une erreur s\'est produite.');
        }
    }

    public function update(Request $request, $id)
    { 
        try {
            // Validation des données entrées
            $validator = Validator::make($request->all(), [
                'titre' => 'required|min:2',
                'image' => 'image|max:2048', // Taille maximale de 2 Mo
                'audio' => 'mimes:mp3,wav|max:8096',
                'intro' => 'mimes:mp3,wav|max:2048',
            ]);
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }

            // Récupérer la caverne à mettre à jour
            $histoire = Histoire::findOrFail($request->idupdate);

            // Traitement de l'image s'il y a un fichier envoyé
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imagename = $request->titre . uniqid() . '.' . $image->getClientOriginalExtension();
                $imagepath = storage_path('/app/public/images');
                $image->move($imagepath, $imagename);

                // Supprimer l'ancienne image si elle existe
                if ($histoire->image) {
                    Storage::disk('public')->delete('images/' . $histoire->image);
                }
                $histoire->image = $imagename;
            }

            // Traitement de l'audio s'il y a un fichier envoyé
            if ($request->hasFile('audio')) {
                $audio = $request->file('audio');
                $audioname = $request->titre . uniqid() . '.' . $audio->getClientOriginalExtension();
                $audiopath = storage_path('/app/public/audios');
                $audio->move($audiopath, $audioname);

                // Supprimer l'ancien audio s'il existe
                if ($histoire->audio) {
                    Storage::disk('public')->delete('audios/' . $histoire->audio);
                }

                $histoire->audio = $audioname;
            }
            
            //Traitement de l'intro si il y'en a une
            if ($request->hasFile('intro')) {
                $intro = $request->file('intro');
                $introname = $request->titre . uniqid() . '.' . $intro->getClientOriginalExtension();
                $intropath = storage_path('/app/public/audios');
                $intro->move($intropath, $introname);

                // Supprimer l'ancienne intro s'il existe
                if ($histoire->intro) {
                    Storage::disk('public')->delete('audios/' . $histoire->intro);
                }

                $histoire->intro = $introname;
            }

            // Mettre à jour les autres champs
            if($request->titre != $histoire->titre)
            {
                $histoire->titre = $request->titre;
            }
            $histoire->save();
            return redirect()->route('histoire.index', $id)->with('success', 'Histoire mise à jour avec succès.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Une erreur s\'est produite.');
        }
    }




    // TAG CONTROLE


    public function tag_show (Request $request, $id)
    {
        try{
            $histoire = Histoire::findOrFail($request->idhistoire);
            $tags = Tag::all()->keyBy('id')->diffKeys($histoire->tags()->get()->keyBy('id'));
            return view('caverne.histoire.tag.tag', compact('tags', 'histoire', 'id'));
        }
        catch(\Exception $e)
        {
            return redirect()->back()->with('error', 'Une erreur s\'est produite.');
        }
    }

    public function tag_update(Request $request, $id)
    {
       // dd(json_decode($request->tags));
        //try{
            $histoire = Histoire::findOrFail($request->idhistoire);
            $histoire->tags()->detach();
            $tagsArray = json_decode($request->tags);
            foreach($tagsArray as $tag)
            {
                $histoire->tags()->attach($tag);
            }
            return redirect()->route('histoire.index', $id)->with('success', 'Tag(s) associé(s) à cet histoire mis à jour avec succès.');
        // }
        // catch(\Exception $e)
        // {
        //     return redirect()->back()->with('error', 'Une erreur s\'est produite.');
        // }
    }


}
