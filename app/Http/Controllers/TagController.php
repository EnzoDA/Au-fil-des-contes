<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;
use App\Models\Histoire;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags = Tag::all();
        return view('tag.tag_all',compact('tags'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $tag = Tag::find($id);
        return view('tag.tag_show', compact('tag'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $histoires = Histoire::all();
        return view('tag.tag_add', compact('histoires'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $newTag = new Tag();

        $newTag->tag_nom = $request->get('tag_nom');
        $newTag->save();

        // Récupérer les ID des histoires cochées
        $histoireIds = $request->input('histoire_id', []);

        // Associer les histoires au tag
        $newTag->histoires()->attach($histoireIds);

        return redirect()->route('tags.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $tag = Tag::find($id);
        $histoires = Histoire::all();
        return view('tag.tag_edit', compact('tag', 'histoires'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $editTag = Tag::find($id);

        $editTag->tag_nom = $request->get('tag_nom');
        $editTag->save();
        
        // Récupérer les ID des histoires cochées et décochées
        $checkedStoryIds = $request->input('histoire_id', []);
        $uncheckedStoryIds = $request->get('histoire_id_to_remove', []);
        // Détacher les histoires décochées du tag
        $editTag->histoires()->detach($uncheckedStoryIds);

        // Attacher les histoires cochées au tag
        $editTag->histoires()->attach($checkedStoryIds);

        return redirect()->route('tags.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tag = Tag::find($id);
        $tag->delete();
        return redirect()->route('tags.index');
    }
}
