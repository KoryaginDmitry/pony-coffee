<header>
    <ul>
        <li><a href="{{ route('home') }}">Главная страница</a></li>
        <li><a href="{{ route("profile") }}">Профиль</a><span> Бонусы - {{ App\Models\Bonuses::countBonuses() . " " . App\Models\Bonuses::burningBonuses()}}</span></li>
        <li><a href="{{ route("showNotifications") }}">Уведомления {{ App\Models\Notifications::countNotifications() }}</a></li>
        <li><a href="{{ route("showForm") }}">Обратная связь</a></li>
        <li><a href="{{ route("logout") }}">Выход</a></li>
    </ul>
</header>