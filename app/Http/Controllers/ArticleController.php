<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use App\Models\Comment;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Article $article, Category $category, Request $request)
    {
        $articles = $article->with(['user', 'categories'])->get();
        $categories = $category->all();
        if ($request->has('category')) {
            $categoryId = $request->input('category');
            $articles = $articles->filter(fn($article) => $article->categories->contains('id', $categoryId));
        }        
        
        return view('webblog.index', compact('articles', 'categories'));
    }

    public function show(Article $article, Comment $comment) {
        $article->load(['comment.user']);
        return view('webblog.article', compact('article'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('webblog.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreArticleRequest $request)
    {
        $validatedData = $request->validated();
        if ($validatedData['isPremium'] == []) {
            $validatedData['isPremium'] = 0;
        }

        $userId = auth()->id();
        if ($userId == null) {
            $userId = 1;
        }
        
        $path = "";

        if ($request->hasFile('fileToUpload')) {
            $path = $request->file('fileToUpload')->store("public");
        } 

        $validatedData['image_path'] = $path;
        $validatedData['author_id'] = $userId;

        $article = Article::create($validatedData);

        $article->categories()->attach($validatedData['categories']);
        return redirect('/home');
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        $categories = Category::all();
        return view('webblog.edit', compact('article' , 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateArticleRequest $request, Article $article)
    {
        $validatedData = $request->validated();
        $userId = auth()->id();
        if ($userId == null) {
            $userId = 1;
        }
        $validatedData['author_id'] = $userId;

        if ($request['deleteImage'] == '1') {
            $path = "public/.gitignore";
        }
        if ($request->hasFile('fileToUpload')) {
            $path = $request->file('fileToUpload')->store("public");
            $validatedData['image_path'] = $path;
        }
        if ($request['deleteImage']) {
            $validatedData['image_path'] = "public/.gitignore";
        }

        $article->categories()->sync($request->input('categories', []));
        unset($validatedData['categories'], $validatedData['fileToUpload']);
        
        
        $article->update($validatedData);
        
        return redirect('/home');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        $article->delete();
        return redirect()->route('articles.index');
    }
}