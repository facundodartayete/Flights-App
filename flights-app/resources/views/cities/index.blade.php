<x-layout>
    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <h2 class="font-medium leading-tight text-4xl mt-0 mb-2 text-blue-600">
                        Cities
                    </h2>
                    @include ('cities._add-city-form') @if ($cities->count())
                    @include ('cities._cities-table') @else
                        <p class="text-center">No cities yet.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @include ('cities._edit-city-form')

    <script>
        const updateTable = (callback = () => {}) => {
            $.ajax({
                url: `/cities/table?${getQueryParams()}`,
                type: "GET",
                success: (response) => {
                    $("#cities-table").replaceWith(response);
                    callback(response);
                },
            });
        };
    </script>
</x-layout>
