<header>
    <ul>
        <li><a href="{{ route('home') }}">Главная страница</a></li>
        <li><a href="{{ route("admin.showCoffeePotStatistic") }}">Статистика кофеточек</a></li>
        <li><a href="{{ route("admin.showUserStatistic") }}">Статистика пользователей</a></li>
        <li><a href="{{ route("admin.showFeedback") }}">Обратная связь</a></li>
        <li><a href="{{ route("admin.showFormSending") }}">Рассылка</a></li>
        <li><a href="{{ route("admin.coffeePot.show") }}">Кофеточки</a></li>
        <li><a href="{{ route("admin.barista.show") }}">Баристы</a></li>
        <li><a href="{{ route("logout") }}">Выход</a></li>
    </ul>
</header>