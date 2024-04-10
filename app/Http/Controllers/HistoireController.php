<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Histoire;
use App\Models\Caverne;
use Illuminate\Support\Facades\Storage;
use GuzzleHttp\Client;
use Sabre\DAV\Client as DavClient;
use Intervention\Image\Facades\Image;


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

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

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
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ]);
                $numero=Histoire::latest('id')->first(); //je recupére l'id de la derniere categorie qui à été créer et la stock dans une variable $numero
                $histoire=Histoire::find($id);
                $histoire->titre = $request->titre; //recupére le titre

                if($request->hasFile('image')) //je vérifie si dans le request c'est bien un fichier
                {
                $image=$request->file('image'); //recupere ce qui à été enregistrer dans le requeste 'image' et la stock dans la variable $îmage
                $imageName = $numero->id.'_.'.$image->getClientOriginalExtension(); //je créer un nom a mon image qui comporte la variable $numero qui a en paramètre id, je lui met pour chaque nom '_.' et récupere l'estension du fichier

                $destinationPath= Storage::disk('public')->putFileAs('images', $image, $imageName); //je créer une variable qui stock le chemin d'acces au dossier 'images' dans public
                Storage::disk('public')->delete('images/' . $histoire->image);


                $resizeImage = Image::make(Storage::disk('public')->path($destinationPath))->resize(50, 50); //je créer une varaiable qui créer une instance de l'objet image dans le dossier 'images' avec sont nom, puis j'utilise la methode resize pour redimensionner l'image pour ensuite l'enregistrer dans la BDD
                $thumbnail = Storage::disk('public')->putFileAs('images/thumbnail', $image, $imageName);
                Storage::disk('public')->delete('images/thumbnail/' . $histoire->image);
                $resizeImage->save(Storage::disk('public')->path($thumbnail));//j'enregistre l'image dans le dossier

                $histoire->image=$imageName;
               }


            if($request->hasFile('intro')){
                $intro=$request->file('intro');
                $introName = $numero->id.'_.'.$intro->getClientOriginalExtension();
                $size=$request->file('intro')->getSize();
                $destinationPath= Storage::disk('public')->putFileAs('audios/intro', $intro, $introName);
                Storage::disk('public')->delete('audios/intro/' . $histoire->intro);
                $histoire->intro = $introName;
                }
            if($request->hasFile('audio')){
                $audio=$request->file('audio');
                $audioName = $numero->id.'_.'.$audio->getClientOriginalExtension();
                $size=$request->file('audio')->getSize();
                $destinationPath= Storage::disk('public')->putFileAs('audios', $audio, $audioName);
                Storage::disk('public')->delete('audios/' . $histoire->audio);
                $histoire->audio = $audioName;
                }
                $histoire->save();

            return redirect()->route('histoire.index')->with('sucess', ' Vous avez créer une histoire');

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
            $caverne = $histoire->caverne->id;

            Storage::disk('public')->delete('images/' . $histoire->image);
            Storage::disk('public')->delete('images/thumbnail/' . $histoire->image);
            Storage::disk('public')->delete('audios/' . $histoire->audio);
            Storage::disk('public')->delete('audios/intro/' . $histoire->intro);
            $histoire->delete();

            return redirect()->route('histoirecaverne', $caverne->id)->with('success', "l'histoire a été supprimé");
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

    public function create_histoire(string $id)
    {
        try{
            $caverne = Caverne::find($id);
            return view('Histoire.histoire_create', compact('caverne'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Une erreur s\'est produite.');
        }
    }

    public function store_hist(Request $request ,string $id){
        try{
        $caverne=Caverne::find($id);
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $numero=Histoire::latest('id')->first(); //je recupére l'id de la derniere categorie qui à été créer et la stock dans une variable $numero
            $histoire= new Histoire; // créer un enouvelle categorie
            $histoire->titre = $request->titre; //recupére de libelle
            if($request->hasFile('image')) //je vérifie si dans le request c'est bien un fichier
            {
            $image=$request->file('image'); //recupere ce qui à été enregistrer dans le requeste 'image' et la stock dans la variable $îmage
            $imageName = $numero->id.'_.'.$image->getClientOriginalExtension(); //je créer un nom a mon image qui comporte la variable $numero qui a en paramètre id, je lui met pour chaque nom '_.' et récupere l'estension du fichier

            $destinationPath= Storage::disk('public')->putFileAs('images', $image, $imageName); //je créer une variable qui stock le chemin d'acces au dossier 'images' dans public


            $resizeImage = Image::make(Storage::disk('public')->path($destinationPath))->resize(50, 50); //je créer une varaiable qui créer une instance de l'objet image dans le dossier 'images' avec sont nom, puis j'utilise la methode resize pour redimensionner l'image pour ensuite l'enregistrer dans la BDD
            $thumbnail = Storage::disk('public')->putFileAs('images/thumbnail', $image, $imageName);
            $resizeImage->save(Storage::disk('public')->path($thumbnail));//j'enregistre l'image dans le dossier

            $histoire->image=$imageName;
           }


        if($request->hasFile('intro')){
            $intro=$request->file('intro');
            $introName = $numero->id.'_.'.$intro->getClientOriginalExtension();
            $size=$request->file('intro')->getSize();
            $destinationPath= Storage::disk('public')->putFileAs('audios/intro', $intro, $introName);
            $histoire->intro = $introName;
            }
        if($request->hasFile('audio')){
            $audio=$request->file('audio');
            $audioName = $numero->id.'_.'.$audio->getClientOriginalExtension();
            $size=$request->file('audio')->getSize();
            $destinationPath= Storage::disk('public')->putFileAs('audios', $audio, $audioName);
            $histoire->audio = $audioName;
            }
            $histoire->caverne()->associate($caverne);
            $histoire->save();

        return redirect()->route('histoirecaverne', $caverne->id)->with('sucess', ' Vous avez créer une histoire');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Une erreur s\'est produite.');
    }
    }
}
