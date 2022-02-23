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
        @foreach ($cities as $city) @include ('cities._city-row')
        @endforeach
    </tbody>
</table>
{{$cities->links()}}
