<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Requests\CommentRequest;
use Illuminate\Support\Facades\DB;


class CommentsController extends Controller
{
    public function store(CommentRequest $request)

    {
        $params = $request->validated();

        $post = Post::findOrFail($params['post_id']);


        $post->comments()->create($params);

        return redirect()->route('board.show',['id' => $post->id]);
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        // $commentId = Post::with('comments')->find(1);

        DB::transaction(function () use ($post){
            $post->comments()->delete();
        });
        return redirect()->route('board.show',['id' => $post->id]);

    }
}
