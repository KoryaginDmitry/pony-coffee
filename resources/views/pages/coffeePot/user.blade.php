@extends('layouts.main')

@section('title', 'Добавление гостя')

@section('content')

@include('templates.coffeePot.header')

    <form action="{{ route('coffeePot.addUser_process') }}" method="POST">
        @csrf
        @error('name')
            <p>{{ $message }}</p>
        @enderror
        <input type="text" name="name" placeholder="Введите имя" value="{{ old('name') }}">

        @error('phone')
            <p>{{ $message }}</p>
        @enderror
        <input type="phone" name="phone" placeholder="Введите номер телефона" value="{{ old('phone') ? old('phone') : '+7' }}">
        <input type="submit" value="Добавить">
    </form>

@include('templates.coffeePot.footer')

@endsection