<tr
    class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100 city"
    data-city-id="{{$city->id}}"
>
    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
        {{ $city->id }}
    </td>
    <td
        class="city-name text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap"
    >
        {{ $city->name }}
    </td>
    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
        {{ $city->flights_departing_count }}
    </td>
    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
        {{ $city->flights_arriving_count }}
    </td>

    <td
        class="edit-city text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap text-indigo-600 font-bold cursor-pointer"
    >
        Edit
    </td>

    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap text-red-600 font-bold cursor-pointer">
        <form
            class="delete-city-form"
            method="DELETE"
            action="/cities/{{ $city->id }}"
        >
            @csrf @method('DELETE')
            <button class="text-xs ">Delete</button>
        </form>
    </td>
</tr>
