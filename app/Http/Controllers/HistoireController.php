<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Histoire;

class HistoireController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $histoires= Histoire::all();

            return view('Histoire.histoire',compact('histoires'));
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
        return view('Histoire.histoire_create');
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
        $histoire = new Histoire;
        $histoire->titre = $request->titre;
        //$histoire->intro = $request->intro;
        //$histoire->image = $request->image;
        //$histoire->audio = $request->audio;
        $histoire->save();
        return redircet()->route('histoire.index')->with('sucess', "l'histoire a été crée");
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
        $histoire = Histoire::find($id);
        return view('histoire.histoire_edite',compact('histoire'));
       } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Une erreur s\'est produite.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try{
        $histoire = Histoire::find($id);
        $histoire->titre = $request->titre;
        $histoire->save();
        return redirect()->route('histoire.index')->with('sucess',"l'histoire a bien été modifier");
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Une erreur s\'est produite.');
    }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $histoire =Histoire::find($id);
            $histoire->delete();
            return redirect()->route('histoire.index')->with('sucess', "l'histoire a été supprimé");
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Une erreur s\'est produite.');
        }
    }
}
