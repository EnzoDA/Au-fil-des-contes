<?php

namespace App\Http\Controllers;

use App\Models\AppSettings;
use App\Models\Caverne;
use App\Models\Histoire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class APIController extends Controller
{
    public function cavernes(Request $request)
    {
        // Vérification de la présence du token de connexion dans la requête
        if (!$request->has('token')) {
            return response()->json([
                'success' => false,
                'code' => 401,
                'message' => 'Token de connexion manquant'
            ]);
        }

        // Récupération du token de connexion depuis la requête
        $token = $request->input('token');

        // Recherche du token dans la base de données
        $appSettings = AppSettings::first(); // Supposons que votre modèle soit AppSetting

    // Vérification si le token est présent en base de données
    if (!$appSettings || !Hash::check($appSettings->app_token, $token )) {
        return response()->json([
            'success' => false,
            'code' => 401,
            'message' => 'Token de connexion invalide'
        ]);
    }
        // Récupérer les données sur les cavernes depuis le modèle
        $cavernes = Caverne::all();
    
        // Vérifier si des données ont été récupérées
        if ($cavernes->isEmpty()) {
            return response()->json([
                'success' => false,
                'code' => 404,
                'message' => 'Aucune caverne trouvée'
            ]);
        }
    
        $data = [];

        // Itérer sur chaque conte pour récupérer ses attributs
        foreach ($cavernes as $caverne) {
            $data[] = [
                'id' => $caverne->id,
                'titre' => $caverne->titre,
                'url_intro' => $caverne->intro,
                'url_image' => $caverne->image,
            ];
        }
    
        // Retourner les données au format JSON
        return response()->json([
            'success' => true,
            'code' => 200,
            'data' => $data
        ]);
    }    

    public function contes(Request $request)
    {
        // Vérification de la présence du token de connexion dans la requête
        if (!$request->has('token')) {
            return response()->json([
                'success' => false,
                'code' => 401,
                'message' => 'Token de connexion manquant'
            ]);
        }

        // Récupération du token de connexion depuis la requête
        $token = $request->input('token');

        // Recherche du token dans la base de données
        $appSettings = AppSettings::first(); // Supposons que votre modèle soit AppSetting

    // Vérification si le token est présent en base de données
    if (!$appSettings || !Hash::check($appSettings->app_token, $token )) {
        return response()->json([
            'success' => false,
            'code' => 401,
            'message' => 'Token de connexion invalide'
        ]);
    }
        // Récupérer les données sur les contes depuis le modèle
        $contes = Histoire::all();
        // Vérifier si des données ont été récupérées
        if ($contes->isEmpty()) {
            return response()->json([
                'success' => false,
                'code' => 404,
                'message' => 'Aucun conte trouvé'
            ]);
        }
    
        //  Tableau pour stocker les données de chaque conte
    $data = [];

    // Itérer sur chaque conte pour récupérer ses attributs
    foreach ($contes as $conte) {
        $tags = $conte->tags->pluck('tag_nom')->toArray();
        $data[] = [
            'id' => $conte->id,
            'id_caverne' => $conte->caverne_id,
            'titre' => $conte->titre,
            'url_intro' => $conte->intro,
            'url_image' => $conte->image,
            'url_audio' => $conte->audio,
            'nombre_lecture' => $conte->nb_vue,
            'nombre_note' => $conte->nb_notes,
            'note'  => $conte->note,
            'mots_cle' => $tags
        ];
    }

    // Retourner les données au format JSON
    return response()->json([
        'success' => true,
        'code' => 200,
        'data' => $data
    ]);
    }
    public function evaluerConte(Request $request, $id)
    {
        // Vérification de la présence du token de connexion dans la requête
        if (!$request->has('token')) {
            return response()->json([
                'success' => false,
                'code' => 401,
                'message' => 'Token de connexion manquant'
            ]);
        }

        // Récupération du token de connexion depuis la requête
        $token = $request->input('token');

        // Recherche du token dans la base de données
        $appSettings = AppSettings::first(); // Supposons que votre modèle soit AppSetting

    // Vérification si le token est présent en base de données
    if (!$appSettings || !Hash::check($appSettings->app_token, $token )) {
        return response()->json([
            'success' => false,
            'code' => 401,
            'message' => 'Token de connexion invalide'
        ]);
    }
    // Validez les données de la requête
    $request->validate([
        'note' => 'required' 
    ]);

    // Recherchez le conte par son identifiant
    $conte = Histoire::find($id);
    if (!$conte) {
        return response()->json([
            'success' => false,
            'code' => 404,
            'message' => 'Conte non trouvé'
        ]);
    }
    $nouvelleNote = $request->note;
    $nbNotesActuel = $conte->nb_notes;
    $noteActuelle = $conte->note;
    
    // Calcul de la nouvelle note moyenne
    $nouvelleNoteMoyenne = (($noteActuelle * $nbNotesActuel) + $nouvelleNote) / ($nbNotesActuel + 1);

    // Mettez à jour les données du conte avec la nouvelle évaluation
    $conte->nb_notes++;
    $conte->note = $nouvelleNoteMoyenne;
    $conte->save();

    // Retournez les données mises à jour
    return response()->json([
        'success' => true,
        'code' => 200,
        'data' => [
            'nombre_note_conte' => $conte->nb_notes,
            'note_conte' => $conte->note
        ]
    ]);
    }
    public function getAppConfig(Request $request)
    {
        // Vérification de la présence du token de connexion dans la requête
        if (!$request->has('token')) {
            return response()->json([
                'success' => false,
                'code' => 401,
                'message' => 'Token de connexion manquant'
            ]);
        }

        // Récupération du token de connexion depuis la requête
        $token = $request->input('token');

        // Recherche du token dans la base de données
        $appSettings = AppSettings::first(); // Supposons que votre modèle soit AppSetting

    // Vérification si le token est présent en base de données
    if (!$appSettings || !Hash::check($appSettings->app_token, $token )) {
        return response()->json([
            'success' => false,
            'code' => 401,
            'message' => 'Token de connexion invalide'
        ]);
    }
        $appconf = AppSettings::first();
        $version = $appconf->app_version;
        return response()->json(['version' => $version]);
    }

    // Méthode pour mettre à jour la version de l'application dans la base de données
    public function updateAppVersion(Request $request)
    {
        // Vérification de la présence du token de connexion dans la requête
        if (!$request->has('token')) {
            return response()->json([
                'success' => false,
                'code' => 401,
                'message' => 'Token de connexion manquant'
            ]);
        }

        // Récupération du token de connexion depuis la requête
        $token = $request->input('token');

        // Recherche du token dans la base de données
        $appSettings = AppSettings::first(); // Supposons que votre modèle soit AppSetting

    // Vérification si le token est présent en base de données
    if (!$appSettings || !Hash::check($appSettings->deploy_token, $token )) {
        return response()->json([
            'success' => false,
            'code' => 401,
            'message' => 'Token de connexion invalide'
        ]);
    }
        // Votre logique pour mettre à jour la version de l'application dans la base de données
        $appconf = AppSettings::first();
        $appconf->app_version = $request->input('version');
        $appconf->save();
        return response()->json(['message' => 'Version mise à jour avec succès']);
    }

    public function eordrelease(Request $request)
    {
        // Vérification de la présence du token de connexion dans la requête
        if (!$request->has('token')) {
            return response()->json([
                'success' => false,
                'code' => 401,
                'message' => 'Token de connexion manquant'
            ]);
        }

        // Récupération du token de connexion depuis la requête
        $token = $request->input('token');

        // Recherche du token dans la base de données
        $appSettings = AppSettings::first(); // Supposons que votre modèle soit AppSetting

    // Vérification si le token est présent en base de données
    if (!$appSettings || !Hash::check($appSettings->app_token, $token )) {
        return response()->json([
            'success' => false,
            'code' => 401,
            'message' => 'Token de connexion invalide'
        ]);
    }
        $appconf = AppSettings::first();
        // Récupération de l'objet $appconf
        $appconf = AppSettings::first();
        // Inversion de la valeur de la propriété "deploy"
        if ($appconf->deploy == true) {
            $appconf->deploy = false;
        } else {
            $appconf->deploy = true;
        }

// Sauvegarde des modifications
$appconf->save();

        return response()->json(['message' => '']);
    }

}
