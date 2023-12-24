<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Requests\CreatePostRequest;
use Exception;
use App\Http\Requests\EditPostRequest;

class PostController extends Controller
{
    public function index(Request $request)
    {
        try {
            $query = Post::query();
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
                'status_message' => 'Les article ont été récupérés avec succès',
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
    
    public function store(CreatePostRequest $request)
    {
        try {
            $post = new Post();
            $post->titre = $request->titre;
            $post->description = $request->description;
            $post->user_id = auth()->user()->id;
            $post->save();

            return response()->json([
                'status_code' => 200,
                'status_message' => 'Article créé avec succès',
                'data' => $post
            ]);
        }
        catch(Execption $e){
            return response() -> json($e);
        }
    }

    public function update(EditPostRequest $request, Post $post)
    {
        try {
            $post->titre = $request->titre;
            $post->description = $request->description;
            if ($post->user_id == auth()->user()->id) {
                $post->save();

                return response()->json([
                    'status_code' => 200,
                    'status_message' => 'Article modifié avec succès',
                    'data' => $post
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

    public function delete(Post $post) 
    {
        try {
            if ($post->user_id == auth()->user()->id) {

                $post->delete();

                return response()->json([
                    'status_code' => 200,
                    'status_message' => 'Article supprimé avec succès',
                    'data' => $post
                ]);
            }
            else {
                return response()->json([
                    'status_code' => 422,
                    'status_message' => 'Vous n\'avez pas le droit de supprimer cet article',
                ]);
            }
        }
        catch(Exception $e)
        {
            return response()->json($e);
        }
    }
}
