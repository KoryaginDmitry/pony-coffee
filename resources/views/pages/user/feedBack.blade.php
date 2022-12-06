@extends('layouts.main')

@section('title', 'Обратная связь')

@section('content')

@include('templates.user.header')

    <form action="{{ route('addFeedback') }}" method="POST">
        @csrf
        @error('coffeePot')
            <p>{{ $message }}</p>
        @enderror
        <select name="coffeePot">
            <option value="0">Укажите адрес кофеточки</option>
            @foreach ($coffeePots as $coffeePot)
                <option value="{{ $coffeePot->id }}" {{ old('coffeePot') == $coffeePot->id ? "selected" : '' }}>{{ $coffeePot->address }}</option>
            @endforeach
        </select>

        @error('grade')
            <p>{{ $message }}</p>
        @enderror
        <input type="radio" value="1" name="grade" {{ old('grade') == "1" ? 'checked' : '' }}>
        <input type="radio" value="2" name="grade" {{ old('grade') == "1" ? 'checked' : '' }}>
        <input type="radio" value="3" name="grade" {{ old('grade') == "1" ? 'checked' : '' }}>
        <input type="radio" value="4" name="grade" {{ old('grade') == "1" ? 'checked' : '' }}>
        <input type="radio" value="5" name="grade" {{ old('grade') == "1" ? 'checked' : '' }}>

        @error('text')
            <p>{{ $message }}</p>
        @enderror
        <textarea name="text" cols="30" rows="10">{{ old('text') }}</textarea>
        
        <input type="submit" value="Отправить">
    </form>

    <div class="feedback">
        @foreach ($feedbacks as $feedback)
            <p> 
                @if ($feedback->grade)
                <span>Оценка - {{ $feedback->grade }}</span>    
                @endif
                
                <span>Адрес - {{ $feedback->coffeePot->address }}</span><br>
                <span>{{ $feedback->text }}</span>
                @foreach ($feedback->responses as $response)
                    <p>
                        <span>{{ Carbon\Carbon::create($response->created_at)->format("d-m-Y") }}</span><br>
                        <span>{{ $response->text }}</span>
                    </p>
                @endforeach
            </p>
        @endforeach
    </div>

@include('templates.user.footer')

@endsection

