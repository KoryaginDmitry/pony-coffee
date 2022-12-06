@extends('layouts.main')

@section('title', 'Профиль')

@section('content')

@include('templates.user.header')

    <div class="information">
        <div>
            <h4>Ваш уникальный идентификатор - {{ $user->id }}</h4>
        </div>
        <div>
            <h4>Ваш qr-код
                {!! QrCode::generate($user->id); !!}
            </h4>
        </div>
    </div>

    <form action="{{ route("profile.update") }}" method="POST">
        @csrf
        
        @error('name')
            <p>{{ $message }}</p>
        @enderror
        <input type="text" name="name" value="{{ $user->name }}" placeholder="Введите ваше имя">

        @error('last_name')
            <p>{{ $message }}</p>
        @enderror
        <input type="text" name="last_name" value="{{ $user->last_name }}" placeholder="Введите фамилию">
        
        @error('phone')
            <p>{{ $message }}</p>
        @enderror
        <input type="phone" name="phone" value="{{ $user->phone }}" placeholder="Введите ваш номер телефона">
        
        @if (!$user->phone_verified_at)
            <button class="confirmation">Подтвердить</button>
        @else
            <p>Телефон подтвержден</p>
        @endif

        @error('email')
            <p>{{ $message }}</p>
        @enderror
        <input type="email" name="email" placeholder="Введите вашу почту" value="{{ $user->email }}">
        @if ($user->email && !$user->email_verified_at)
            <button class="confirmation">Подтвердить</button>
        @elseif($user->email)
            <p>Почта подтверждена</p>
        @endif

        <input type="submit" value="Изменить">
    </form>

@include('templates.user.footer')

@endsection

