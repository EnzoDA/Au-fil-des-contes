<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Histoire;
use App\Models\Caverne;
use Illuminate\Support\Facades\Storage;
use GuzzleHttp\Client;
use Sabre\DAV\Client as DavClient;


class HistoireController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{

            $histoires = Histoire::all();
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

        $histoire = new Histoire;
        $histoire->titre = $request->titre;
        /*if($request->hasfile( 'intro'))
        {
            $intro = $request->file('intro');
            $client = new Client();

            // Chemin complet du fichier sur OwnCloud
            $remoteFilePath = 'http://172.20.7.32/remote.php/webdav/Histoire/Intro/' . $intro->getClientOriginalName();

            // Envoyer le fichier vers OwnCloud

                $response = $client->request('PUT', $remoteFilePath, [
                    'auth' => ['Aufildescontes', 'Enzo'], // Remplacer 'username' et 'password' par vos informations de connexion OwnCloud
                    'body' => fopen($intro->getPathname(), 'r'),
                    'headers' => [
                        'Content-Type' => 'intro/' . $intro->getClientOriginalExtension(),
                    ]
                ]);

        if($request->hasfile( 'image'))
        {
            $image = $request->file('image');
            $client = new Client();

            // Chemin complet du fichier sur OwnCloud
            $remoteFilePath = '/remote.php/webdav/Histoire/Image/' . $image->getClientOriginalName();

            // Envoyer le fichier vers OwnCloud

                $response = $client->request('PUT', $remoteFilePath, [
                    'auth' => ['Aufildescontes', 'Enzo'], // Remplacer 'username' et 'password' par vos informations de connexion OwnCloud
                    'body' => fopen($image->getPathname(), 'r'),
                    'headers' => [
                        'Content-Type' => 'image/' . $image->getClientOriginalExtension(),
                    ]
                ]);
        }
        if($request->hasfile( 'audio'))
        {
            $audio = $request->file('audio');
            $client = new Client();

            // Chemin complet du fichier sur OwnCloud
            $remoteFilePath = '/remote.php/webdav/Histoire/Audio/' . $audio->getClientOriginalName();

            // Envoyer le fichier vers OwnCloud

                $response = $client->request('PUT', $remoteFilePath, [
                    'auth' => ['Aufildescontes', 'Enzo'], // Remplacer 'username' et 'password' par vos informations de connexion OwnCloud
                    'body' => fopen($audio->getPathname(), 'r'),
                    'headers' => [
                        'Content-Type' => 'audio/' . $audio->getClientOriginalExtension(),
                    ]
                ]);
        }*/
        $histoire->save();
        return redirect()->route('histoire.index')->with('success', "l'histoire a été crée");

       /* if ($response->getStatusCode() === 201) {
            // Fichier téléchargé avec succès
            return redirect()->back()->with('success', 'Image uploaded successfully to OwnCloud.');
        } else {
            // Erreur lors du téléchargement
            return redirect()->back()->with('error', 'Failed to upload image to OwnCloud.');
        }



    }*/
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
        return redirect()->route('histoire.index')->with('success',"l'histoire a bien été modifier");
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
            return redirect()->route('histoire.index')->with('success', "l'histoire a été supprimé");
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Une erreur s\'est produite.');
        }
    }
    public function hist_cav(string $id)
    {
            try{
            $caverne= Caverne::find($id);
            $histoires = $caverne->histoires;
            return view('caverne.histoire-caverne', compact('caverne','histoires'));

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Une erreur s\'est produite.');
        }
    }



}
