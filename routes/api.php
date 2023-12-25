<?php

use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\RubriqueController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::post('/login', [UserController::class, 'login']);


//---Protected by login---//

Route::middleware('auth:sanctum')->group(function () {
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


    //---Users---//

    //Editer un l utilisateur connecter
    Route::put('/user/edit', [UserController::class, 'update']);

    //Supprimé l utilisateur connecter
    Route::delete('/user/delete', [UserController::class, 'delete']);
});
