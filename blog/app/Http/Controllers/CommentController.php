<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use Illuminate\Http\Request;
class CommentController extends Controller
{

    //Index Comentário
    public function index(Request $request)
    {
        $comment = Comment::all();

        return response()->json([
            'msg' => 'Sucesso!',
            'comentarios' => $comment,
        ], 200);
    }

    //Store Comentário
    public function store(Request $request)
    {
       $comment = new Comment;
       $comment->descricao = $request->descricao;
       $comment->usuario = $request->usuario;
       $comment->fk_postagem_id = $request->post_id;
       $comment->save();

        return  response()->json([
        'msg' => 'Comentário Criado com Sucesso!',
        'status' => 201
        ], 201);

    }

    //Show Comentário
    public function show(Request $request)
    {
        $comment = Comment::find($request->id);

        return  response()->json($comment, 200);
    }

    //Edit Comentário
    public function edit(Request $request)
    {
        $comment = new Comment;

        $new_comment =  $comment->find($request->id);

        $new_comment->descricao = $request->descricao;
        $new_comment->save();

        return  response()->json(['msg' => 'Comentario Atualizado com Sucesso!'], 201);
    }

    //Delete Comentário
    public function destroy(Request $request)
    {
        $comment = new Comment;
        $comment->find($request->id)->delete();

        return  response()->json(['msg' => 'Comentário Deletado com Sucesso!'], 200);
    }
}
