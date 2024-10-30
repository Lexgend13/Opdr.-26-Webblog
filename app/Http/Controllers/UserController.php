<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Models\Category;
use App\Models\Article;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Category $category, Article $article)
    {
        $userId = auth()->id();

        $categories = $category->all();
        
        $articles = $article->where('author_id', $userId)->get();
        
        return view('User.publications',compact('categories', 'articles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('User.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['username'] = ucwords($validatedData['username']);
        $validatedData['hasPremium'] = (int) boolval($validatedData['hasPremium'] == "on");

        $user = User::create($validatedData);
        auth()->login($user);

        session()->flash('succes', 'Your account has been created! You have been logged in automatically');
               
        return redirect('/home');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        return view('user.login');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $validatedData = $request->validate([
            'hasPremium' => 'required',
        ]);
        $userId = auth()->id();
        User::find($userId)->update($validatedData);
        return redirect('/home');
    }

    public function premium ()
    {
        return view('user.premium');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update() //actually a log in function
    {
        $validatedData = request()->validate([
            'username' => 'required|exists:users,username',
            'password' => 'required'
        ]);
        if ($validatedData['username'] == 'Anonymous') {
            return back()->withErrors(['username' => 'Username or password is incorrect.']);
        }

        if (auth()->attempt($validatedData)) {
            session()->flash('succes', 'Welcome back!');
            return redirect('/home');
        } else {
            return back()->withErrors(['username' => 'Username or password is incorrect.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        auth()->logout();
        session()->flash('succes', 'You have logged out.');
        return redirect('/home');
    }
}
