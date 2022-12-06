@extends('layouts.main')

@section('title', 'Регистрация')

@section('content')
    <form action="{{ route("register_process") }}" method="POST">
        @csrf
        @error('name')
            <p>{{ $message }}</p>
        @enderror
        <input type="text" name="name" placeholder="введите имя" value="{{ old('name') }}">
        @error('phone')
            <p>{{ $message }}</p>
        @enderror
        <input type="phone" name="phone" placeholder="Введите номер телефона" value="{{ old("phone") }}">
        @error('password')
            <p>{{ $message }}</p>
        @enderror
        <input type="password" name="password" placeholder="Введите пароль">
        <input type="password" name="password_confirmation" placeholder="Введите пароль еще раз" value="{{ old('password_confirmation') }}">
        @error('agreement')
            <p>{{ $message }}</p>
        @enderror
        <label for="agreement">Согласен на обработку персональных данных</label>
        <input type="checkbox" id="agreement" name="agreement">
        <input type="submit" value="регистрация">
    </form>
    <a href="{{ route("home") }}">Вернуться на главную страницу</a>
    <a href="{{ route("login") }}">Войти</a>
@endsection