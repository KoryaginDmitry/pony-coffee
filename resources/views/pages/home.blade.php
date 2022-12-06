@extends('layouts.main')

@section('title', "Pony-coffee")

@section('content')

@auth
    @include('templates.' . auth()->user()->role->name . '.header')    
@endauth

@guest
    <ul>
        <li><a href="{{ route("login") }}">Войти</a></li>
        <li><a href="{{ route("showFormRegister") }}">Регистрация</a></li>
    </ul>
@endguest

@auth
    @include('templates.' . auth()->user()->role->name . '.footer')    
@endauth
    
@endsection