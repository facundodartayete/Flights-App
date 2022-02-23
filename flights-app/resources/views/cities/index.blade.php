<x-layout>
    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <h2 class="font-medium leading-tight text-4xl mt-0 mb-2 text-blue-600">Cities</h2>
                    @include ('cities._add-city-form')
                    @if ($cities->count())
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="cities" class="bg-white divide-y divide-gray-200">
                                @foreach ($cities as $city)
                                    <tr class="city">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div>
                                                <div class="text-sm font-medium">
                                        <td>{{ $city->id }}</td>
                </div>
            </div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
                <div>
                    <div class="text-sm font-medium text-gray-900">
            <td>{{ $city->name }}</td>
        </div>
    </div>
    </td>

    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
        <a href="/cities/{{ $city->id }}/edit" class="text-blue-500 hover:text-blue-600">Edit</a>
    </td>

    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
        <form class="delete-city-form" method="DELETE" action="/cities/{{ $city->id }}">
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

    <script>
        $('document').ready(() => {
            $(".delete-city-form").submit(function(e){
                formRequest({
                    e,
                    form: $(this),
                    success: () => {
                        alert('city deleted successfully');
                        $(this).closest('.city').remove();
                    }
                });
            });
        });
    </script>

</x-layout>
