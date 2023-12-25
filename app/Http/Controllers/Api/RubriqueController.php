<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rubrique;
use App\Http\Requests\CreateRubriqueRequest;
use App\Http\Requests\EditRubriqueRequest;
use Exception;

class RubriqueController extends Controller
{
    public function index(Request $request)
    {
        try {
            $query = Rubrique::query();
            $perPage = 10;
            $page = $request->input('page', 1);
            $search = $request->input('search');

            if ($search) {
                $query->whereRaw("titre LIKE '%" . $search . "%'");
            }

            $total = $query->count();

            $results = $query->offset(($page - 1) * $perPage)
                ->limit($perPage)
                ->get();

            return response()->json([
                'status_code' => 200,
                'status_message' => 'Les rubriques ont été récupérés avec succès',
                'current_page' => $page,
                'last_page' => ceil($total / $perPage),
                'items' => $results,
            ]);
        }
        
        catch(Exception $e)
        {
            return response()->json($e);
        }
    }

    public function store(CreateRubriqueRequest $request)
    {
        try {
            $rubrique = new Rubrique();
            $rubrique->titre = $request->titre;
            $rubrique->image = $request->image;
            $rubrique->theme = $request->theme;
            $rubrique->description = $request->description;
            $rubrique->user_id = auth()->user()->id;
            $rubrique->save();

            return response()->json([
                'status_code' => 200,
                'status_message' => 'Rubrique créé avec succès',
                'data' => $rubrique
            ]);
        }
        catch(Execption $e){
            return response() -> json($e);
        }
    }

    public function update(EditRubriqueRequest $request, Rubrique $rubrique)
    {
        try {
            $rubrique->titre = $request->titre;
            $rubrique->image = $request->image;
            $rubrique->theme = $request->theme;
            $rubrique->description = $request->description;
            if ($rubrique->user_id == auth()->user()->id) {
                $rubrique->save();

                return response()->json([
                    'status_code' => 200,
                    'status_message' => 'Article modifié avec succès',
                    'data' => $rubrique
                ]);
            }
            else {
                return response()->json([
                    'status_code' => 422,
                    'status_message' => 'Vous n\'avez pas le droit de modifier cet article',
                ]);
            }
        }
        catch(Exception $e)
        {
            return response()->json($e);
        }
    }

    public function delete(Rubrique $rubrique) 
    {
        try {
            if ($rubrique->user_id == auth()->user()->id) {

                $rubrique->delete();

                return response()->json([
                    'status_code' => 200,
                    'status_message' => 'Rubrique supprimé avec succès',
                    'data' => $rubrique
                ]);
            }
            else {
                return response()->json([
                    'status_code' => 422,
                    'status_message' => 'Vous n\'avez pas le droit de supprimer cette rubrique',
                ]);
            }
        }
        catch(Exception $e)
        {
            return response()->json($e);
        }
    }
}
