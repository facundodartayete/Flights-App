<x-layout>
    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <h2 class="font-medium leading-tight text-4xl mt-0 mb-2 text-blue-600">
                        Airlines
                    </h2>
                    @include ('airlines._add-airline-form')
                    @if ($airlines->count())
                        @include('airlines._airlines-table')
                    @else
                        <p class="text-center">No airlines yet.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @include ('airlines._edit-airline-form')

    <script>
        const updateTable = (callback = () => {}) => {
            fetch(`/api/airlines?${getQueryParams()}`)
                .then(response => response.json())
                .then(data => {
                    const htmlRows = data.data.map(
                        (airline) => `
                    <tr class="airline" data-airline-id="${airline.id}">
    <td>${airline.id}</td>

    <td class="airline-name">
        ${airline.name}
    </td>

    <td class="airline-business_description">
        ${airline.business_description}
    </td>
    <td>
        ${airline.flights_count}
    </td>
    <td>
        <div class="edit-airline text-blue-500 hover:text-blue-600">Edit</div>
    </td>
    <td>
        <form
            class="delete-airline-form"
            method="DELETE"
            action="/airlines/${airline.id}"
        >
            <button class="text-xs text-gray-400">Delete</button>
        </form>
    </td>
</tr>
`
                    );
                    $("#airlines").html(htmlRows.join(""));
                    callback(data);
                });
        };
    </script>
</x-layout>
