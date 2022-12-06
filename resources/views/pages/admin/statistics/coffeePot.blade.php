@extends('layouts.main')

@section('title', 'Статистика кофеточек')

@section('content')

@include('templates.admin.header')
    
    <div class="table">
        <div class="head">
            <h4>
                <span>Имя</span>
                <span>Телефон</span>
                <span>Начислил</span>
                <span>Списал</span>
            </h4>
        </div>
        <div class="tableBody">
            
            @foreach ($users as $user)
                <div class="line">
                    <span>{{ $user->name }} <span class="view">&#8595</span></span>|
                    <span>{{ $user->phone }}</span>|
                    <span>{{ $user->bonusesCreate->count() }}</span>|
                    <span>{{ $user->bonusesWrote->count() }}</span>
                </div><br>

                <div class="tableNested" style="display:none">
                    <div class="head">
                        <h4>
                            <span>Дата</span>
                            <span>Начисленно</span>
                            <span>Списано</span>
                        </h4>
                    </div>
                    <div class="tableBody">
                        
                        @foreach ($user->bonusesCreate->groupBy('date') as $date => $bonuses)
                            <div class="line">
                                <span>{{ $date }} <span class="view">&#8595</span></span>|
                                <span>{{ $bonuses->count() }}</span>|
                                <span>{{ $user->bonusesWrote->where('date', $date)->count() }}</span>
                            </div>
                            <br>

                            <div class="tableNested" style="display:none">
                                <div class="head">
                                    <h4>
                                        <span>Пользователь</span>
                                        <span>Начисленно</span>
                                        <span>Списано</span>
                                    </h4>
                                </div>
                                <div class="tableBody">
                                    
                                    @foreach ($bonuses->groupBy('user_id') as $user_id => $bonuses)
                                        <div class="line">
                                            <span>{{ $user_id }}</span>|
                                            <span>{{ $bonuses->count() }} <span class="view" data-toggle="created">&#8595</span></span>|
                                            <span>{{ $user->bonusesWrote->where('date', $date)->where("user_id", $user_id)->count() }} <span class="view" data-toggle="wrote">&#8595</span></span>
                                        </div>    
                                        <br>

                                        <div class="tableNested" style="display:none" id="created">
                                            <div class="head">
                                                <h4>
                                                    <span>Время начисления</span>
                                                </h4>
                                            </div>
                                            <div class="tableBody">

                                                @foreach ($bonuses as $bonus)
                                                    <div class="line">
                                                        <span>{{ Carbon\Carbon::create($bonus->created_at)->format("H:i:s") }}</span>
                                                    </div>
                                                    <br>
                                                @endforeach

                                            </div>
                                        </div>
                                        <div class="tableNested" style="display:none" id="wrote">
                                            <div class="head">
                                                <h4>
                                                    <span>Время списания</span>
                                                </h4>
                                            </div>
                                            <div class="tableBody">

                                                @foreach ($user->bonusesWrote->where('date', $date)->where('user_id', $user_id)->all() as $bonus)
                                                    <div class="line">
                                                        <span>{{ Carbon\Carbon::create($bonus->updated_at)->format("H:i:s") }}</span>
                                                    </div>
                                                    <br>
                                                @endforeach

                                            </div>
                                        </div>
                                    @endforeach
                                
                                </div>
                            </div>
                        @endforeach
                    
                    </div>
                </div>
            @endforeach
        
        </div>
    </div>

@include('templates.admin.footer')

@endsection