<!--Displays one singular article in its entirety-->
@extends('layout.apps')

@include('layout.style')

@section('content')
    <article>
        <h1>
            {{$article->title}}
        </h1>
        <!--Premium and author logic-->
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
        <p>
            <!--Loop through all linked categories-->
            @foreach ($article->categories as $category)
                <li><a href="{{ route('articles.index', ['category' => $category->id]) }}">{{$category->name}}</a></li>
            @endforeach
            <br><br>
            <!--Image logic-->
            @if($article->image_path && $article->image_path !== 'public/.gitignore')
                <img src="{{ Storage::url($article->image_path) }}" alt="Article Image" class="article-image">
            @endif
            <br><a class="article">{{$article->text}}</a><br>

            <!--Comments-->
            <h2>Comments</h2>
            <!--Show user's comment if it exists..-->
            @auth
            @php
                $hasUserComment = false;
            @endphp            
            @php
                $commentUserIds = $article->comment->pluck('user.id')->toArray();
            @endphp
            @if (in_array(auth()->id(), $commentUserIds))
                <!--Disallows new comments-->
                @php
                    $comment = $article->comment->firstWhere('user.id', auth()->id());
                    #dd($comment);
                    $hasUserComment = true;
                @endphp
                <h3>You</h3>
                <a id="no-edit" class="comment">{{$comment->body}}<br></a>
                <form id="edit" style="display: none;" action="{{ route('comments.update', $comment_id = $comment->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input
                        type="hidden"
                        id="article_id"
                        name="article_id"
                        value="{{$article->id}}">
                    <textarea  type="text" 
                        class="full-width-textarea" 
                        name="body"
                        rows="5"
                        required>{{$comment->body}}</textarea>
                    <button type="submit">Save changes</button>
                </form>
                <button id="toggle">Edit</button>
                <form class="inline-form" method='POST' action="{{route('comments.destroy', ['comment' => $comment->id])}}">
                    @csrf
                    @method('DELETE')
                    <input
                        type="hidden"
                        id="article_id"
                        name="article_id"
                        value="{{$article->id}}">
                    <button>Delete</button>
                </form>                
            @endif
            <!--..otherwise allow for creating one-->
            @if (!$hasUserComment)
                <form method="POST" action="{{route('comments.store')}}">
                    @csrf
                    <textarea  type="text" 
                        class="full-width-textarea" 
                        id="body" 
                        name="body"
                        rows="5"
                        placeholder="Create comment"
                        required></textarea>
                    <input
                        type="hidden"
                        id="article_id"
                        name="article_id"
                        value="{{$article->id}}">
                    <button type="submit">submit</button>
                </form>
            @endif
            @endauth
            <!--Show all related comments-->
            @foreach ($article->comment as $comment)
                @if (auth()->id() != $comment->user_id)
                    <br><a>--------------------------------</a><br>                    
                    <strong>{{$comment->user->name}}</strong><br>
                    <strong class="small">{{$comment->user->username}}</strong><br><br>
                    <a class="comment">{{$comment->body}}</a><br>                    
                @endif
            @endforeach
        </p>
    </article>
@endsection

<script>
    //Allow user to edit or display their own comment
    document.addEventListener('DOMContentLoaded', function() {
        var toggle = document.getElementById("toggle");
        var no_edit = document.getElementById('no-edit');
        var edit = document.getElementById('edit');

        toggle.addEventListener('click', function() {
            no_edit.style.display = no_edit.style.display === 'none' ? 'block' : 'none';
            edit.style.display = edit.style.display === 'none' ? 'block' : 'none';
        });
    });
</script>