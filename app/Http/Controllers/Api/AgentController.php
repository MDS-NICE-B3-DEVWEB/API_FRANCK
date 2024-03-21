<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Agent;
use Exception;
use App\Http\Requests\CreateAgentRequest;
use App\Http\Requests\EditAgentRequest;

class AgentController extends Controller
{
    public function index(Request $request)
    {
        try {
            $query = Agent::query();
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
                'status_message' => 'Les agents ont été récupérés avec succès',
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

    public function store(CreateAgentRequest $request)
    {
        try {
            $agent = new Agent();
            $agent->firstname = $request->firstname;
            $agent->surname = $request->surname;
            $agent->status = '1';
            $agent->save();

            return response()->json([
                'status_code' => 200,
                'status_message' => 'Agent créé avec succès',
                'data' => $agent
            ]);
        }
        catch(Execption $e){
            return response() -> json($e);
        }
    }

    public function update(EditAgentRequest $request, Agent $agent)
    {
        try {
            $agent->firstname = $request->firstname;
            $agent->surname = $request->surname;
            $agent->status = $request->status;

            $agent->save();

            return response()->json([
                'status_code' => 200,
                'status_message' => 'Agent modifié avec succès',
                'data' => $agent
            ]);
        
        }
        catch(Exception $e)
        {
            return response()->json($e);
        }
    }

    public function delete(Agent $agent) 
    {
        try {
            $agent->delete();

            return response()->json([
                'status_code' => 200,
                'status_message' => 'Agent supprimé avec succès',
                'data' => $agent
            ]);
        }
        catch(Exception $e)
        {
            return response()->json($e);
        }
    }
}
