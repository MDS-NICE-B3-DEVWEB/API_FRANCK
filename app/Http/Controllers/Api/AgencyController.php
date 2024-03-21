<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Agency;
use Exception;
use App\Http\Requests\CreateAgencyRequest;
use App\Http\Requests\EditAgencyRequest;

class AgencyController extends Controller
{
    public function index(Request $request)
    {
        try {
            $query = Agency::query();
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
                'status_message' => 'Les agences ont été récupérés avec succès',
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

    public function store(CreateAgencyRequest $request)
    {
        try {
            $agence = new Agency();
            $agence->name = $request->name;
            $agence->address = $request->address;
            $agence->status = '1';
            $agence->save();

            return response()->json([
                'status_code' => 200,
                'status_message' => 'Agence créé avec succès',
                'data' => $agence
            ]);
        }
        catch(Execption $e){
            return response() -> json($e);
        }
    }

    public function update(EditAgencyRequest $request, Agency $agency)
    {
        try {
            $agency->name = $request->name;
            $agency->address = $request->address;
            $agency->status = $request->status;

            $agency->save();

            return response()->json([
                'status_code' => 200,
                'status_message' => 'Agence modifié avec succès',
                'data' => $agency
            ]);
        
        }
        catch(Exception $e)
        {
            return response()->json($e);
        }
    }

    public function delete(Agency $agency) 
    {
        try {
            $agency->delete();

            return response()->json([
                'status_code' => 200,
                'status_message' => 'Agence supprimé avec succès',
                'data' => $agency
            ]);
        }
        catch(Exception $e)
        {
            return response()->json($e);
        }
    }
}
