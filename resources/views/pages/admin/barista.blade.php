@extends('layouts.main')

@section('title', 'Баристы')

@section('content')

@include('templates.admin.header')
    
    <table>
        <thead>
            <th>Имя</th>
            <th>Фамилия</th>
            <th>Номер телефона</th>
            <th>Место работы</th>
            <th>Изменить</th>
            <th>Удалить</th>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <form action="{{ route('admin.barista.update', $user->id) }}" method="POST">
                        @csrf
                        <td><input type="text" name="name" placeholder="Имя" value="{{ $user->name }}"></td>
                        <td><input type="text" name="last_name" placeholder="Фамилия" value="{{ $user->last_name }}"></td>
                        <td><input type="phone" name="phone" placeholder="Номер телефона" value="{{ $user->phone }}"></td>
                        <td><select name="coffeePot">
                            <option value="0" {{ !$user->userCoffeePot ? 'selected' : '' }}>Место работы не назначенно</option>
                            @foreach ($coffeePots as $coffeePot)
                                <option value="{{ $coffeePot->id }}" {{ !$user->userCoffeePot ? '' : ($coffeePot->id == $user->userCoffeePot->coffeePot->id ? 'selected' : '') }}>{{ $coffeePot->address }}</option>
                            @endforeach
                        </select></td>
                        <td><input type="submit" value="Изменить"></td>
                    </form>
                    <td><form action="{{ route('admin.barista.delete', $user->id) }}" method="POST">
                            @csrf
                            <input type="submit" value="удалить">
                        </form></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <hr>
    <form action="{{ route('admin.barista.add') }}" method="POST">
        @csrf

        @error('name')
            <p>{{ $message }}</p>
        @enderror
        <input type="text" name="name" placeholder="Имя" value="{{ old('name') }}">

        @error('last_name')
            <p>{{ $message }}</p>
        @enderror
        <input type="text" name="last_name" placeholder="Фамилия" value="{{ old('last_name') }}">

        @error('phone')
            <p>{{ $message }}</p>
        @enderror
        <input type="phone" name="phone" placeholder="Номер телефона" value="{{ old('phone') }}">

        @error('password')
            <p>{{ $message }}</p>
        @enderror
        <input type="text" name="password" placeholder="пароль" value="{{ old('password') }}">

        @error('coffeePot')
            <p>{{ $message }}</p>
        @enderror
        <select name="coffeePot">
            <option value="0">выберите место работы</option>
            @foreach ($coffeePots as $coffeePot)
                <option value="{{ $coffeePot->id }}" {{ old('coffeePot') == $coffeePot->id ? 'selected' : '' }}>{{ $coffeePot->address }}</option>
            @endforeach
        </select>
        <input type="submit" value="Добавить">
    </form>
@include('templates.admin.footer')

@endsection