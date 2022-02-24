<tr class="city" data-city-id="{{$city->id}}">
    <td>{{ $city->id }}</td>
    <td class="city-name">
        {{ $city->name }}
    </td>
    <td>
        {{ $city->flights_departing_count }}
    </td>
    <td>
        {{ $city->flights_arriving_count }}
    </td>

    <td>
        <div class="edit-city text-blue-500 hover:text-blue-600">Edit</div>
    </td>

    <td>
        <form
            class="delete-city-form"
            method="DELETE"
            action="/cities/{{ $city->id }}"
        >
            @csrf @method('DELETE')
            <button class="text-xs text-gray-400">Delete</button>
        </form>
    </td>
</tr>
