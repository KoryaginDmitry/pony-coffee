@if ($users)
    @foreach ($users as $user)
        <tr id="{{ $user->id }}">
            <td>{{ $user->phone }}</td>
            <td class="count">{{ $user->bonuses->count() }}</td>
            <td>
                <form action="{{ route('coffeePot.addBonuses', $user->id) }}" method="POST" class="formSubmit">
                    @csrf
                    <input type="submit" value="+">
                </form>
                <form action="{{ route('coffeePot.useBonuses', $user->id) }}" method="POST" class="formSubmit">
                    @csrf
                    <input type="submit" value="Использовать">
                </form>
            </td>
        </tr>    
    @endforeach   
@endif

