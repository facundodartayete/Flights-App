<tr class="airline" data-airline-id="{{$airline->id}}">
    <td class="px-6 py-4 whitespace-nowrap">
        <div class="text-sm font-medium">
            <td>{{ $airline->id }}</td>
        </div>
    </td>
    <td class="px-6 py-4 whitespace-nowrap">
        <div class="text-sm font-medium text-gray-900">
            <td class="airline-name">
                {{ $airline->name }}
            </td>
        </div>
    </td>
    <td class="px-6 py-4 whitespace-nowrap">
        <div class="text-sm font-medium text-gray-900">
            <td class="airline-business_description">
                {{ $airline->business_description }}
            </td>
        </div>
    </td>
    
    <td class="px-6 py-4 whitespace-nowrap">
        <div class="text-sm font-medium">
            <td>
                {{ $airline->flights_count }}
            </td>
        </div>
    </td>

    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
        <div class="edit-airline text-blue-500 hover:text-blue-600">Edit</div>
    </td>

    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
        <form
            class="delete-airline-form"
            method="DELETE"
            action="/airlines/{{ $airline->id }}"
        >
            @csrf @method('DELETE')
            <button class="text-xs text-gray-400">Delete</button>
        </form>
    </td>
</tr>
