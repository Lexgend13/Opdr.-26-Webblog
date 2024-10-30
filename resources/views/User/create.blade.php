@extends('layout.apps')

@section('title', 'Register')

@include('layout.style')

@section('content')
<form method="POST" action="/register">
    @csrf
    <h1>Register</h1>
    <label>Name:</label>
    <input type="text"
            name="name"
            id="name"
            value="{{old('name')}}"
            required>
    @error('name')
        <a class="red">{{$message}}</a>
    @enderror
    <br>
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
    <input
        type="hidden"
        id="hasPremium"
        name="hasPremium"
        value="0">
    <label>Subscribed to premium</label>
    <input
        type="checkbox"
        name="hasPremium"
        id="hasPremium">
    <br>
    <label>Emailadress:</label>
    <input type="email"
            name="email"
            id="email"
            value="{{old('email')}}"
            required>
    @error('email')
        <a  class="red">{{$message}}</a>
    @enderror
    <br>
    <label>Password:</label>
    <input type="password"
            name="password"
            id="password"
            required>
    <input type="checkbox" onclick="ChangeVisibility()">
    <a id="hide/show">Show password</a>
    <br>
    <a class="@error('password') red @else warning @enderror">Requires at least 1 lower and upper case letter, 1 number and 1 special character</a>
    <br>
    <button type="submit">Create account</button>
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