<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Commentaire;

class CommentaireController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $commentaires = Commentaire::where('visible' , 0)->get();


            return view('Commentaires.traitement_com', compact('commentaires'));

        } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Une erreur s\'est produite.');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $commentaire = Commentaire::findOrFail($id);
            $commentaire->visible = 1;
            $commentaire->save();

            return redirect()->route('commentaire.index');
        } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Une erreur s\'est produite.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    { try{
        $commentaire = Commentaire::find($id);
        $commentaire->delete();
        return redirect()->route('commentaire.index')->with('sucess','Le commentaire a été supprimer');
        } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Une erreur s\'est produite.');
        }
    }
    public function livredor()
    {
        try{
            $commentaires = Commentaire::where('visible' , 1)->get();
            return view('Commentaires.livre_d_or', compact('commentaires'));

        } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Une erreur s\'est produite.');
        }
    }
}
