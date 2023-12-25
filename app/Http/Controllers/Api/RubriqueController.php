<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rubrique;
use App\Http\Requests\CreateRubriqueRequest;
use Exception;

class RubriqueController extends Controller
{
    public function index(Request $request)
    {
        /*try {
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
        }*/
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
}
