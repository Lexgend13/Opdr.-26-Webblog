@extends('layout.apps')

@section('title', 'Register')

@include('layout.style')

@section('content')
<form method="POST" action="/login">
    @csrf
    <h1>Log in</h1>
    <label>Username:</label>
    <input type="text"
            name="username"
            id="username"
            value="{{old('username')}}"
            required>
    @error('username')
        <a  class="red">{{$message}}</a>
    @enderror
    <br>
    <label>Password:</label>
    <input type="password"
            name="password"
            id="password"
            required>
    <input type="checkbox" onclick="ChangeVisibility()">
    <a id="hide/show">Show password</a><br>
    <button type="submit">Log in</button>
</form>

<script>
    function ChangeVisibility() {
        var x = document.getElementById("password");
        var y = document.getElementById("hide/show");
        if (x.type === "password") {
            x.type = "text";
            y.textContent = "hide password";
        } else {
            x.type = "password";
            y.textContent = "show password"
        }
    }
</script>
@endsection