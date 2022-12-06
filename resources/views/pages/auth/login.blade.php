@extends('layouts.main')

@section('title', 'Авторизация')

@section('content')
    <form action="{{ route("login_process") }}" method="POST">
        @csrf
        @error('phone')
            <p>{{ $message }}</p>
        @enderror
        <input type="phone" name="phone" placeholder="Введите номер телефона" value="{{ old('phone') }}">
        <input type="password" name="password" placeholder="Введите пароль">
        <input type="submit" value="Войти">
    </form>
    <a href="{{ route("home") }}">Вернуться на главную страницу</a>
    <a href="{{ route("showFormRegister") }}">Регистрация</a>
@endsection