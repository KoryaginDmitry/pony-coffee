@extends('layouts.main')

@section('title', 'Рассылка')

@section('content')

@include('templates.admin.header')

    <form action="{{ route('admin.notifications.create') }}" method="POST">
        @csrf
        @error('email')
            <p>{{ $message }}</p>
        @enderror
        <label for="email">Email рассылка</label>
        <input type="checkbox" name="email" id="email">

        @error('sms')
            <p>{{ $message }}</p>
        @enderror
        <label for="phone">sms рассылка</label>
        <input type="checkbox" name="sms" id="phone">

        @error('site')
            <p>{{ $message }}</p>
        @enderror
        <label for="notifications">Уведомления на сайте</label>
        <input type="checkbox" name="site" id="notifications">

        @error('text')
            <p>{{ $message }}</p>
        @enderror
        <textarea name="text" cols="30" rows="10"></textarea>
        <input type="submit" value="Отправить">
    </form>

    <div>
        @foreach ($notifications as $notification)
            <p> 
                <span>Вид рассылки</span>
                <span>{{ $notification->email ? "email" : '' }}</span>
                <span>{{ $notification->sms ? "sms" : '' }}</span>
                <span>{{ $notification->site ? "Внутри сайта" : '' }}</span><br>
                <span>{{ $notification->text }}</span><br>
                <span>{{ Carbon\Carbon::create($notification->created_at)->format("d-m-Y") }}</span>
            </p>
        @endforeach
    </div>

@include('templates.admin.footer')

@endsection

