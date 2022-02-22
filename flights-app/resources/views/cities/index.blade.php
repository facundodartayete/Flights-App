<x-layout>
    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <div class="index-header border border-gray-200 p-6 rounded-xl">
                        <h2>Cities</h2>
                        <button href="/cities/create" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button" data-modal-toggle="create-city-modal">Create City</button>
                    </div>
                    @if ($cities->count())
                        <table class="min-w-full divide-y divide-gray-200">
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($cities as $city)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="text-sm font-medium text-gray-900">
                                        <td>{{ $city->name }}</td>
                </div>
            </div>
            </td>

            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                <a href="/cities/{{ $city->id }}/edit" class="text-blue-500 hover:text-blue-600">Edit</a>
            </td>

            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                <form method="POST" action="/cities/city/{{ $city->id }}">
                    @csrf
                    @method('DELETE')

                    <button class="text-xs text-gray-400">Delete</button>
                </form>
            </td>
            </tr>
            @endforeach
            </tbody>
            </table>
        @else
            <p class="text-center">No cities yet.</p>
            @endif
        </div>
    </div>
    </div>
    </div>
@include ('cities._add-city-form')

</x-layout>
