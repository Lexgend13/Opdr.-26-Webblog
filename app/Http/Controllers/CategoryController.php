<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;


class CategoryController extends Controller
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
    public function store(Request $request)
    {
        // TODO :: naart een request class   
        $validatedData = $request->validate([
            'name' => 'required|unique:categories',
        ]);
        
        $validatedData['name'] = ucwords($validatedData['name']);
        
        Category::create($validatedData);
        
        $ref = $request->input('ref');
        
        $articleId = $request->input('articleId');

        if ($ref === 'create') {
            return redirect()->route('articles.create')->withInput();
        } else {
            return redirect()->route('articles.edit', ['article' => $articleId]);
        }
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
