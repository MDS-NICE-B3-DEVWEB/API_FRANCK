<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\RegisterUser;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\EditUserRequest;
use Exception;

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

    public function update(EditUserRequest $request, User $user)
    {
        try {
            $user = auth()->user();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = $request->password;
            $user->save();

            return response()->json([
                'status_code' => 200,
                'status_message' => 'Utilisateur modifié avec succès',
                'data' => $user
            ]);
            
            
            return response()->json([
                'status_code' => 422,
                'status_message' => 'Vous n\'avez pas le droit de modifier cet utilisateur',
            ]);
        }
        catch(Exception $e)
        {
            return response()->json($e);
        }
    }

    public function delete(User $user)
    {
        try {
            $user = auth()->user();

            $user->delete();

            return response()->json([
                'status_code' => 200,
                'status_message' => 'Utilisateur supprimé avec succès',
                'user' => $user,
            ]);
        }
        catch(Exception $e)
        {
            return response()->json($e);
        }
    }
}
