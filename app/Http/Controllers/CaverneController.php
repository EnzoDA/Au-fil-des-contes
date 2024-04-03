<?php

namespace App\Http\Controllers;

use App\Models\Caverne;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

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
        try{
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
            //Validation des données entrée
        $validator = Validator::make($request->all(), [
            'titre' => 'required|min:2',
            'image' => 'required|image',
            'audio' => 'required|mimes:mp3,wav',
    ]);

    $imagePath = $request->file('image')->store('images', 's3');
    $audioPath = $request->file('audio')->store('audios', 's3');
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $newCaverne = new Caverne();
        $newCaverne->titre = $request->input('titre');
        $newCaverne->image = $request->input('image');
        $newCaverne->audio = $request->input('audio');
        $newCaverne->save();
        return redirect()->route('caverne.index')->with('succes', 'Caverne créée avec succès!');

        } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Une erreur s\'est produite.');
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
        try{
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
            //Validation des données entrée
        $validator = Validator::make($request->all(), [
            'titre' => 'required|min:2',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
            // Mettre à jour la caverne actuelle
            $edit_caverne = caverne::find($id);
            $edit_caverne->titre = $request->input('titre');
            $edit_caverne->graphique = $request->input('image');
            $edit_caverne->audio = $request->input('audio');
            $edit_caverne->save();

            return redirect()->route('caverne.index')->with('success', 'Caverne modifiée avec succès!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Une erreur s\'est produite.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
