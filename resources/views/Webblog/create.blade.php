@extends('layout.apps')

@section('title', 'New Article')

@include('layout.style')

@section('content')
    <form id="main_form" method="POST" enctype="multipart/form-data" action="{{route('articles.store')}}">
        @csrf
        <p>Create new article: 
            <div class="form-group">
            <label for="title"></label>
            <textarea  type="text" 
                    class="full-width-textarea" 
                    id="title" 
                    name="title"
                    placeholder="Title"
                    required>{{ old('title') }}</textarea>
            </div>
        </p>
        <div>
            Category
            <br>           
            @foreach ($categories as $category)
            <input 
                type="checkbox" 
                name="categories[]" 
                id="category_{{ $category->id }}" 
                value="{{ $category->id }}" >
            <label for="category_{{ $category->id }}">{{ $category->name }}</label>
            @endforeach
        </div>
        <!-- <p  form="main_form">
            Select image to upload:
            <input type="file" name="fileToUpload" id="fileToUpload">
        </p> -->
    </form>
    <input form="category_form" type="hidden" name="ref" value="create">
    @include('Category.create')
    <div class="form-group">
        <label for="text">Text</label>
        <br>
        <textarea 
            form="main_form"
            name="text" 
            id="text" 
            class="form-control full-width-textarea" 
            rows="10" 
            placeholder="Main body"
            required>{{ old('text') }}</textarea>
        <input
            type="hidden"
            name="isPremium"
            id="isPremium"
            form="main_form"
            value="0">
        @guest
            <a class='warning'>Articles cannot be edited after saving if you are not logged in</a>
        @endguest
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
    </div>
    @error('text')
        <p>{{$message}}</p>
    @enderror

    <button type="submit" form="main_form">Save and submit new Article</button>    
@endsection