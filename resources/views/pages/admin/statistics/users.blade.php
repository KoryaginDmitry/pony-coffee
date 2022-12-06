@extends('layouts.main')

@section('title', 'Статистика гостей')

@section('content')

@include('templates.admin.header')

<table>
    <thead>
        <tr>
            <th>Имя, фамилия</th>
            <th>Телефон</th>
            <th>Email</th>
            <th>Бонусы</th>
            <th>Использовал</th>
            <th>Сгорели</th>
            <th>Бонусы за 7 дней</th>
            <th>Бонусы за 30 дней</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name . " " . $user->last_name}}</td>
                    <td>{{ $user->phone }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->bonuses->where("usage", "0")->where("burnt", "0")->count() }}</td>
                    <td>{{ $user->bonuses->where("usage", "1")->count() }}</td>
                    <td>{{ $user->bonuses->where("burnt", "1")->count() }}</td>
                    <td>{{ App\Models\User::countBonusesSevenDays($user->id) }}</td>
                    <td>{{ $user->bonuses->count() }}</td>
                </tr>    
            @endforeach
    </tbody>
</table>

@include('templates.admin.footer')

@endsection

