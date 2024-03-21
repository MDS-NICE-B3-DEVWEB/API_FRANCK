<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Exception;
use App\Http\Requests\CreateVehicleRequest;
use App\Http\Requests\EditVehicleRequest;

class VehicleController extends Controller
{
    public function index(Request $request)
    {
        try {
            $query = Vehicle::query();
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
                'status_message' => 'Les vehicules ont été récupérés avec succès',
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

    public function store(CreateVehicleRequest $request)
    {
        try {
            $vehicle = new Vehicle();
            $vehicle->name = $request->name;
            $vehicle->registration = $request->registration;
            $vehicle->status = '1';
            $vehicle->save();

            return response()->json([
                'status_code' => 200,
                'status_message' => 'Vehicule créé avec succès',
                'data' => $vehicle
            ]);
        }
        catch(Execption $e){
            return response() -> json($e);
        }
    }

    public function update(EditVehicleRequest $request, Vehicle $vehicle)
    {
        try {
            $vehicle->name = $request->name;
            $vehicle->registration = $request->registration;
            $vehicle->status = $request->status;

            $vehicle->save();

            return response()->json([
                'status_code' => 200,
                'status_message' => 'Vehicule modifié avec succès',
                'data' => $vehicle
            ]);
        
        }
        catch(Exception $e)
        {
            return response()->json($e);
        }
    }

    public function delete(Vehicle $vehicle) 
    {
        try {
            $vehicle->delete();

            return response()->json([
                'status_code' => 200,
                'status_message' => 'Vehicule supprimé avec succès',
                'data' => $vehicle
            ]);
        }
        catch(Exception $e)
        {
            return response()->json($e);
        }
    }
}
