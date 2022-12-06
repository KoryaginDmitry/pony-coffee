@extends('layouts.main')

@section('title', 'Уведомления')

@section('content')

@include('templates.user.header')

    <div>
        @foreach ($notifications as $notification)
            <p>
                <span>{{ $notification->text }}</span>
                <form action="{{ route('readNotification', $notification->id) }}" method="POST">
                    @csrf
                    <input type="submit" value="Убрать">
                </form>
            </p>
        @endforeach
    </div>

@include('templates.user.footer')

@endsection

