@extends('layout.apps')

@section('title', 'Premium')

@include('layout.style')

@section('content')
    <br><br>
    <table>
        <tr>
            <th>Premium</th>
        </tr>
        <tr>
            <th>Weekly</th>
            <th>Monthly</th>
            <th>Yearly</th>
        </tr>
        <tr>
            <td>€0,01</td>
            <td>€0,04</td>
            <td>€0,52</td>
        </tr>
    </table>
    <button>Nu betalen</button>
    <a class="small">← does absolutely nothing</a>
    <br><br>
    <form method="post" action="{{route( 'users.edit' )}}">
        @csrf
        @method('PUT')
        <a>Premium toggle:</a>
        <input
            type="hidden"
            id="hasPremium"
            name="hasPremium"
            value="0">
        <input
            type="checkbox"
            id="hasPremium"
            name="hasPremium"            
            value="1"
            {{ old('hasPremium', auth()->user()->hasPremium) ? 'checked' : '' }}>        
        <br>
        <button type="submit">Save change</button>
    </form>
@endsection