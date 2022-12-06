<form action="{{ route('coffeePot.searchUser') }}" method="POST" id="searchForm">
    @csrf
    <input type="text" name="value" id="search" placeholder="Введите id/phone">
</form>