<?php

namespace App\Http\Controllers;

use App\Models\Caverne;
use App\Models\Histoire;
use Illuminate\Http\Request;

class APIController extends Controller
{
    public function cavernes()
    {
        // Récupérer les données sur les cavernes depuis le modèle
        $cavernes = Caverne::all();
        // Retourner les données au format JSON
        return response()->json($cavernes);
    }

    public function contes()
    {
        // Récupérer les données sur les cavernes depuis le modèle
        $contes = Histoire::all();
        // Retourner les données au format JSON
        return response()->json($contes);
    }

    public function evaluerConte(Request $request, $id)
    {
        // Validez les données de la requête
        $request->validate([
            'note' => 'required|numeric|min:1|max:5' // Par exemple, une note entre 1 et 5
        ]);

        // Recherchez le conte par son identifiant
        $conte = Histoire::find($id);
        if (!$conte) {
            return response()->json(['message' => 'Conte non trouvé'], 404);
        }

        // Mettez à jour les données du conte avec la nouvelle évaluation
        $conte->nombre_note_conte++;
        $conte->note_conte = ($conte->note_conte + $request->note) / $conte->nombre_note_conte;
        $conte->save();

        // Retournez les données mises à jour
        return response()->json([
            'nombre_note_conte' => $conte->nombre_note_conte,
            'note_conte' => $conte->note_conte
        ]);
    }
}
