<!--Home Page-->
@extends('layout.apps')

@section('title', 'Webblog')

@include('layout.style')

@section('content')
    <!--End of header; categories visibility toggle-->
    <a class="header">||<button id="expand">Expand/hide categories</button></a>
    <br><br>
    
    <form id="expandable" style="display:none">
        @foreach($categories as $category)
            <a href="{{ route('articles.index', ['category' => $category->id]) }}">|{{$category->name}}|</a>
        @endforeach
    </form>
    <!--Loop through articles, display one at a time-->
    @foreach($articles as $article)
    
    <article>        
        <!--Premium logic-->
        @if (auth()->user() && auth()->user()->hasPremium || !$article->isPremium)
            <h1><a href="/article/{{ $article->id }}">{{ $article->title }}</h1>            
        @else
            <h1>
                {{ $article->title }}
            </h1>
        @endif 
        @if ($article->isPremium)
            <a class="premium">This article is premium ||</a>
        @endif
        <a class="small">Posted on {{$article->created_at}} by 
            @if ($article->user)                    
                @if ($article->user->id == auth()->id())
                    You 
                @else
                    {{$article->user->name}}
                @endif
            @else
                Anonymous
            @endif
        </a>
        
        <!--Loops through all categories linked to article-->
        @foreach($article->categories as $category)
            <li><a href="{{ route('articles.index', ['category' => $category->id]) }}">{{$category->name}}</a></li>
        @endforeach
        <br>
        <!--Allows editing/deleting if logged in user is author-->
        @if ($article->user->id == auth()->id())
            <h3><a href="{{route('articles.edit', ['article' => $article->id])}}">Edit</a></h3>
            <form method='POST' action="{{route('articles.destroy', ['article' => $article])}}">
                @csrf
                @method('DELETE')
                <button>Delete</button>
            </form>
        @endif
        </a>       
    </article>
    @endforeach

    @if ($articles->isEmpty())
        <a class='red'>No article of this category exist yet</a>
    @elseif (session()->has('succes'))
        <div>
            <p class="flash" id="flash"> {{ session('succes') }}</p>
        </div>
    @endif
@endsection

<script>
    //listens to categories visibility toggle
    document.addEventListener('DOMContentLoaded', function() {
        var expand = document.getElementById('expand');
        var expandable = document.getElementById('expandable');

        expand.addEventListener('click', function() {
            expandable.style.display = expandable.style.display === 'none' ? 'block' : 'none';
        });
    });
    //displays flash messages
    setTimeout(function() {
        var flash = document.getElementById('flash');
        if (flash) {
            flash.style.transition = "opacity 0.5s ease";
            flash.style.opacity = 0;
            setTimeout(function() { flash.remove(); }, 500);
        }
    }, 5000);
</script>