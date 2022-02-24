<tr class="airline" data-airline-id="{{$airline->id}}">
    <td>{{ $airline->id }}</td>

    <td class="airline-name">
        {{ $airline->name }}
    </td>

    <td class="airline-business_description">
        {{ $airline->business_description }}
    </td>
    <td>
        {{ $airline->flights_count }}
    </td>
    <td>
        <div class="edit-airline text-blue-500 hover:text-blue-600">Edit</div>
    </td>
    <td>
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
