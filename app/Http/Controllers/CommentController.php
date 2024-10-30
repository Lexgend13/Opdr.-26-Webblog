<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Http\Requests\UpdateCommentRequest;
use App\Http\Requests\StoreCommentRequest;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCommentRequest $request)
    {
        $userId = auth()->id();
        $validatedData = $request->validated();
        $validatedData['user_id'] = $userId;
        Comment::create($validatedData);
        return redirect()->route('articles.show', ['article' => $request['article_id']]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        $validatedData = $request->validated();

        $comment->update($validatedData);
        
        return redirect()->route('articles.show', ['article' => $request['article_id']]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Comment $comment)
    {
        $comment->delete();        
        return redirect()->route('articles.show', ['article' =>$request['article_id']]);
    }
}
