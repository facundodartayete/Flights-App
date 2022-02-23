<table class="min-w-full divide-y divide-gray-200">
    <thead>
        <tr>
            <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm font-medium">
                    <td>Id</td>
                </div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm font-medium">
                    <td>Name</td>
                </div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm font-medium">
                    <td>Departures</td>
                </div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm font-medium">
                    <td>Arrivals</td>
                </div>
            </td>
            <td></td>
            <td></td>
        </tr>
    </thead>
    <tbody id="cities" class="bg-white divide-y divide-gray-200">
        @foreach ($cities as $city)
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

            <td
                class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium"
            >
                <div class="edit-city text-blue-500 hover:text-blue-600">
                    Edit
                </div>
            </td>

            <td
                class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium"
            >
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
        @endforeach
    </tbody>
</table>
{{$cities->links()}}
