@extends('layouts.main')

@section('title', 'Бонусы')

@section('content')

@include('templates.coffeePot.header')

@include('components.coffeePot.bonuses.searchForm')

<table>
    <thead>
        <tr>
            <td>Номер телефона</td>
            <td>Кол-во бонусов</td>
            <td>Действие</td>
        </tr>
    </thead>
    <tbody id="usersTableBody">
        @include('components.coffeePot.bonuses.table', $users)
    </tbody>
</table>

@include('templates.coffeePot.footer')

@endsection