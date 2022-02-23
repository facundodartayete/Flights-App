<tr class="city" data-city-id="{{$city->id}}">
    <td class="px-6 py-4 whitespace-nowrap">
        <div class="text-sm font-medium">
            <td>{{ $city->id }}</td>
        </div>
    </td>
    <td class="px-6 py-4 whitespace-nowrap">
        <div class="text-sm font-medium text-gray-900">
            <td class="city-name">
                {{ $city->name }}
            </td>
        </div>
    </td>
    <td class="px-6 py-4 whitespace-nowrap">
        <div class="text-sm font-medium">
            <td>
                {{ $city->flights_departing_count }}
            </td>
        </div>
    </td>
    <td class="px-6 py-4 whitespace-nowrap">
        <div class="text-sm font-medium">
            <td>
                {{ $city->flights_arriving_count }}
            </td>
        </div>
    </td>

    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
        <div class="edit-city text-blue-500 hover:text-blue-600">Edit</div>
    </td>

    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
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
