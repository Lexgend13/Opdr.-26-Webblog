@extends('layout.apps')

@section('title', 'Publications')

@include('layout.style')

@section('content')
<a class="header">||</a><button id="expand">Expand/hide categories</button>
    <br><br>
    <form id="expandable" style="display:none">
        @foreach($categories as $category)
            <a href="{{ route('articles.index', ['category' => $category->id]) }}">|{{$category->name}}|</a>
        @endforeach
    </form>
    
    @foreach($articles as $article)
    <article>
        <h1><a href="/article/{{ $article->id }}">
            {{ $article->title }}
        </h1>
        @if ($article->isPremium)
            <a class="premium">This article is premium</a>
        @endif        
        <a class="small">Posted on {{$article->created_at}} by You</a>
        @foreach($article->categories as $category)
            <li><a href="{{ route('articles.index', ['category' => $category->id]) }}">{{$category->name}}</a></li>
        @endforeach
        <br>
        <h3><a href="{{route('articles.edit', ['article' => $article->id])}}">Edit</a></h3>
        <form method='POST' action="{{route('articles.destroy', ['article' => $article])}}">
            @csrf
            @method('DELETE')
            <button>Delete</button>
        </form>
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
    document.addEventListener('DOMContentLoaded', function() {
        var expand = document.getElementById('expand');
        var expandable = document.getElementById('expandable');

        expand.addEventListener('click', function() {
            expandable.style.display = expandable.style.display === 'none' ? 'block' : 'none';
        });
    });
</script>