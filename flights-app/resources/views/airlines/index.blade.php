<x-layout>
    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <h2 class="font-medium leading-tight text-4xl mt-0 mb-2 text-blue-600">
                        Airlines
                    </h2>
                    @include ('airlines._add-airline-form')
                    @include('airlines._airlines-table')
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

                    $("#airlines").html(getRowsHTML(data.data));

                    updatePaginationData(data);

                    callback(data);
                });
        };


        const getRowsHTML = (rows) => {
            const htmlRows = rows.map(
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
            return htmlRows.join("");
        };

        const updatePaginationData = (data) => {
            let searchParams = new URLSearchParams(window.location.search);
            const currentPage = searchParams.get('page') || 1;

            const linksHTML = data.links.slice(1, -1).map((link) => {
                    return {
                        label: link.label,
                        page: link?.url?.split('page=')[1] ?? ''
                    }
                }).map((link) =>
                    `<span aria-current="page" data-page="${link.page}" class="table-nav-button">
                            <span
                                class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-pointer leading-5">${link.label}</span>
                        </span>`, '')
                .join('');
            $('#page-buttons').html(linksHTML);
            $('#table-from').html(data.from);
            $('#table-to').html(data.to);
            $('#table-total').html(data.total);

            $('#table-previous').data('page', Math.max(1, +currentPage - 1));
            $('#table-next').data('page', Math.min(data.last_page, +currentPage + 1));

        };
    </script>
</x-layout>
