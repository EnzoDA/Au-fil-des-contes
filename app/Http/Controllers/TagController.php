<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;
use App\Models\Histoire;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
        $tags = Tag::orderBy('tag_nom')->paginate(10);
        return view('tag.tag', compact('tags'));
        }
        catch(\Exception $e)
        {
            redirect()->back()->with('error', 'Une erreur s\'est produite.' );
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try{
        $histoires = Histoire::all()->sortBy('titre');
        return view('tag.creer-tag', compact('histoires'));
        }
        catch(\Exception $e)
        {
            redirect()->back()->with('error', 'Une erreur s\'est produite.' );
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Validation des données entrées
            $validator = Validator::make($request->all(), [
                'tag_nom' => 'required|min:2',
            ]);
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }
            $newTag = new Tag();
            $newTag->tag_nom = $request->tag_nom;
            $newTag->save();
            return redirect()->route('tag.index')->with('success', 'Mot-clé ajouté avec succès');
        } catch (\Exception $e) {
            redirect()->back()->with('error', 'Une erreur s\'est produite.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        try{
        $tag = Tag::find($id);
        $histoires = Histoire::all()->sortBy('titre');
        return view('tag.modifier-tag', compact('tag', 'histoires'));
        }
        catch(\Exception $e)
        {
            redirect()->back()->with('error', 'Une erreur s\'est produite.' );
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'tag_nom' => 'required|min:2',
            ]);
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }

            $editTag = Tag::find($id);

            $editTag->tag_nom = $request->get('tag_nom');
            $editTag->save();

            return redirect()->route('tag.index')->with('success', 'Mot-clé modifié avec succès');

        } catch (\Exception $e) {
            redirect()->back()->with('error', 'Une erreur s\'est produite.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {

            $tag = Tag::find($id);
            $tag->delete();
            return redirect()->route('tag.index')->with('success', 'Mot-clé supprimé avec succès');

        } catch (\Exception $e) {
            redirect()->back()->with('error', 'Une erreur s\'est produite.');
        }
    }
}
