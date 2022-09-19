<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;

class PostController extends Controller
{
    //Index Post
    public function index()
    {
        //busca todos
        $post = Post::all();

        //$comment = Comment::find($post->id);

        return response()->json([
            'msg' => 'Sucesso!',
            'posts' => $post,

        ], 200);
    }

    //Store Post
    public function store(Request $request)
    {
        $post = new Post;
        $post->usuario = $request->usuario;
        $post->titulo = $request->titulo;
        $post->descricao = $request->descricao;
        $post->save();

        return  response()->json([
            'msg' => 'Post Criado com Sucesso!',
            'status' => 201
        ], 201);
    }

    //Show Post
    public function show(Request $request)
    {
        $post = Post::find($request->id);

        return  response()->json($post, 200);
    }

    //Edit Post
    public function edit(Request $request)
    {
        $post = new Post;

        $new_post =  $post->find($request->id);

        $new_post->descricao = $request->descricao;
        $new_post->titulo = $request->titulo;
        $new_post->save();

        return  response()->json(['msg' => 'Menssagem Atualizada!'], 201);
    }

    //Delete Post
    public function destroy(Request $request, $id){
        if(Post::where('id', $id)->exists()) {

            $post = Post::find($id);
            $post->delete();

            return response()->json([
                "message" => "Post Deletado com Sucesso!"
            ], 202);
        }else{
            return response()->json([
                "message" => "Post Não Encontrado"
            ], 404);
        }
    }

}
