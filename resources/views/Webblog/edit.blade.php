@extends('layout.apps')

@section('title', 'Edit Article')

@include('layout.style')

@section('content')
    <form id="main_form" method="POST" enctype="multipart/form-data" action="{{route('articles.update', $article->id)}}">
        @csrf
        @method('PUT')
        <p>Edit article: 
            <textarea  type="text" 
                    class="full-width-textarea" 
                    id="title" 
                    name="title"
                    value="{{old('title')}}"
                    required>{{ old('title', $article->title) }}</textarea>
        </p>
        Category
        <br>           
        @foreach ($categories as $category)
        <input 
            type="checkbox" 
            name="categories[]" 
            id="category_{{ $category->id }}" 
            value="{{ $category->id }}" 
            {{ $article->categories->contains($category) ? 'checked' : '' }}>
        <label for="category_{{ $category->id }}">{{ $category->name }}</label>
        @endforeach
    </form>
    <input form="category_form" type="hidden" name="articleId" value="{{$article->id}}">
    @include('Category.create')
    @if ($article->image_path && $article->image_path !== 'public/.gitignore')
        <a>Current image:</a><br>
        <img src="{{ Storage::url($article->image_path) }}" alt="Article Image" class="article-image"><Br>
        <a>Delete image</a>
        <input type="hidden"
            name="deleteImage"
            id="deleteImage"
            form="main_form"
            value="0">
        <input type="checkbox"
            name="deleteImage"
            id="deleteImage"
            form="main_form"
            value="1">
        <br><br>
    @endif
    <br>
    <label for="text">Text</label>
    <textarea
        form="main_form"
        name="text" 
        id="text" 
        class="form-control full-width-textarea" 
        rows="10" 
        required>{{ old('text', $article->text) }}</textarea>
    @error('text')
        <p>{{$message}}</p>
    @enderror
    <input
            type="hidden"
            name="isPremium"
            id="isPremium"
            form="main_form"
            value="0">
        @auth
            <label>Premium Article:</label>
            <input 
                type="checkbox"
                name="isPremium"
                id="isPremium"                
                form="main_form"
                value="1" {{ old('isPremium', $article->isPremium ?? false) ? 'checked' : '' }}>
            <br><br> <!--value="{{ old('isPremium') ? 'checked' : '' }}"  //old() doesnt work yet -->
            
        @endauth
    <button form="main_form" type="submit">Update Article</button>
    <br>    
@endsection

{{-- @section('suggestiontoggler')
    @include('layouts.suggestiontoggler')
@endsection --}}