<?php

use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\RubriqueController;
use App\Http\Controllers\Api\AgencyController;
use App\Http\Controllers\Api\AgentController;
use App\Http\Controllers\Api\VehicleController;
use App\Http\Controllers\Api\FDRController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//Crée un lien qui permet aux clients d'utilisé les routes de l'api
//mettre les routes qui doivent etre proteger par un login dans le middleware auth:sanctum notamment les routes admins
//finir les routes pour les fdr (create update delete)

//---Agences---//

//Crée une agence
Route::post('agences/create', [AgencyController::class, 'store']);

//Editer un agence
Route::put('agences/edit/{agency}', [AgencyController::class, 'update']);

//Supprimé un agence
Route::delete('agences/delete/{agency}', [AgencyController::class, 'delete']);

//---Agent---//

//Crée un agent
Route::post('agents/create', [AgentController::class, 'store']);

//Editer un agent
Route::put('agents/edit/{agent}', [AgentController::class, 'update']);

//Supprimé un agent
Route::delete('agents/delete/{agent}', [AgentController::class, 'delete']);

//---FDR---//

//---Vehicle---//

//Crée un vehicule
Route::post('vehicules/create', [VehicleController::class, 'store']);

//Editer un vehicule
Route::put('vehicules/edit/{vehicle}', [VehicleController::class, 'update']);

//Supprimé un vehicule
Route::delete('vehicules/delete/{vehicle}', [VehicleController::class, 'delete']);

//---Posts---//

//Recupere la liste des posts
Route::get('posts', [PostController::class, 'index']);


//---Rubrique---//

//Recupere la liste des rubriques
Route::get('rubriques', [RubriqueController::class, 'index']);


//---Users---//

//Crée un utilisateur
Route::post('/register', [UserController::class, 'register']);

//Connecter un utilisateur
Route::middleware('throttle:5,1')->post('/login', [UserController::class, 'login']);


//---Protected by login---//

Route::middleware('auth:sanctum')->group(function () {

    // Rate limiting configuration
    RateLimiter::for('api', function ($request) {
        return Limit::perMinute(10)->by($request->ip());
    });

    // Apply rate limiting middleware
    Route::middleware('throttle:api')->group(function () {

        //Recupere les infos de l'utilisateur connecté
        Route::get('/user', function (Request $request) {
            return $request->user();
        });

        //---Posts---//

        //Ajouter un post
        Route::post('posts/create', [PostController::class, 'store']);

        //Editer un post
        Route::put('posts/edit/{post}', [PostController::class, 'update']);

        //Supprimé un post
        Route::delete('posts/delete/{post}', [PostController::class, 'delete']);


        //---Rubrique---//


        //Crée une rubrique
        Route::post('rubriques/create', [RubriqueController::class, 'store']);

        //Editer une rubrique
        Route::put('rubriques/edit/{rubrique}', [RubriqueController::class, 'update']);

        //Supprimé une rubrique
        Route::delete('rubriques/delete/{rubrique}', [RubriqueController::class, 'delete']);


        //---Users---//

        //Editer un l utilisateur connecter
        Route::put('/user/edit', [UserController::class, 'update']);

        //Supprimé l utilisateur connecter
        Route::delete('/user/delete', [UserController::class, 'delete']);

        //---Agent---//

        //Recupere la liste des agents
        Route::get('agents', [AgentController::class, 'index']);

        //---Vehicle---//

        //Recupere la liste des vehicules
        Route::get('vehicules', [VehicleController::class, 'index']);

        //---FDR---//

        //Recupere la liste des FDR
        Route::get('fdr', [FDRController::class, 'index']);

        //---Agences---//

        //Recupere la liste des agences
        Route::get('agences', [AgencyController::class, 'index']);
    });
});
