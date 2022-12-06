@extends('layouts.main')

@section('title', 'Кофеточки')

@section('content')

@include('templates.admin.header')
    <hr>
    <table>
        <thead>
            <th>Название</th>
            <th>адресс</th>
            <th>Дата добавление точки</th>
            <th>Дата последнего редактирования точки</th>
            <th>Изменить</th>
            <th>Удалить</th>
        </thead>
        <body>
            @foreach ($coffeePots as $coffeePot)
                <tr>
                    <form action="{{ route('admin.coffeePot.update', $coffeePot->id) }}" method="POST">
                        @csrf
                        <td><input type="text" name="name" placeholder="Введите название" value="{{ $coffeePot->name }}"></td>
                        <td><input type="address" name="address" placeholder="введите адресс" required value="{{ $coffeePot->address }}"></td>
                        <td>{{ $coffeePot->created_at }}</td>
                        <td>{{ $coffeePot->updated_at }}</td>
                        <td><input type="submit" value="Изменить"></td>
                    </form>
                    <td>
                        <form action="{{ route('admin.coffeePot.delete', $coffeePot->id) }}" method="POST">
                            @csrf
                            <input type="submit" value="Удалить">
                        </form>
                    </td>
                </tr>
            @endforeach
        </body>
    </table>
    <hr>    
    <form action="{{ route('admin.coffeePot.add') }}" method="POST">
        @csrf
        <input type="text" name="name" placeholder="Введите произвольное название">
        <input type="address" name="address" placeholder="Введите адрес">
        <input type="submit" value="Добавить">
    </form>

    
@include('templates.admin.footer')

@endsection