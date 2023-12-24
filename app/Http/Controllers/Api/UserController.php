<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\RegisterUser;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(RegisterUser $request) 
    {
        try {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password,['rounds' => 12]);
            $user->save();

            return response()->json([
                'status_code' => 200,
                'status_message' => 'Utilisateur créé avec succès',
                'user' => $user,
        ]);
        }
        catch(Exception $e)
        {
            return response()->json($e);
        }
    }

    public function login(Request $request)
    {
        try {
            if (auth()->attempt($request->only(['email', 'password']))) 
            {
                $user = auth()->user();
                $token = $user->createToken('auth_token')->plainTextToken;

                return response()->json([
                    'status_code' => 200,
                    'status_message' => 'Connexion réussie',
                    'user' => $user,
                    'token' => $token,
                ]);
            }
            else {
                return response()->json([
                    'status_code' => 403,
                    'status_message' => 'Information non valide',
                    //'user' => $user,
                ]);
            }
        }
        catch(Exception $e)
        {
            return response()->json($e);
        }
    }
}
