@extends('layouts.main')

@section('title', 'Статистика кофеточек')

@section('content')

@include('templates.admin.header')
    
    <ul>
        <li><a href="{{ route('admin.showFeedback') }}">По всем точкам</a></li>
        @foreach ($coffeePots as $coffeePot)
            <li><a href="{{ route('admin.showFeedback', $coffeePot->id) }}">{{ $coffeePot->address }}</a></li>
        @endforeach
    </ul>

    <div class="feedback">
        @foreach ($feedbacks as $feedback)
            <p> 
                <span>{{ $feedback->user->name . " " . $feedback->user->last_name . " " . $feedback->user->phone}}</span><br>
                @if ($feedback->grade)
                <span>Оценка - {{ $feedback->grade }}</span>    
                @endif
                
                <span>Адрес - {{ $feedback->coffeePot->address }}</span><br>
                <span>{{ $feedback->text }}</span>
            </p>
            @foreach ($feedback->responses as $response)
                <p>
                    <span>{{ Carbon\Carbon::create($response->created_at)->format("d-m-Y") }}</span><br>
                    <span>{{ $response->text }}</span>
                </p>
            @endforeach
            <form action="{{ route('admin.feedbackResponse', $feedback->id)}}" method="POST">
                @csrf
                @error('text')
                    <p>{{ $message }}</p>
                @enderror
                <textarea name="text" cols="40" rows="4">{{ old('text') }}</textarea>
                <input type="submit" value="Отправить">
            </form>
        @endforeach
    </div>

@include('templates.admin.footer')

@endsection