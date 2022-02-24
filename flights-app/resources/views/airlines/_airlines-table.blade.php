<div id="airlines-table" class="table-wrapper">
    <table class="table-auto">
        <thead>
            <tr>
                <td>Id</td>
                <td>Name</td>
                <td>Description</td>
                <td>Flights</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </thead>
        <tbody id="airlines"></tbody>
    </table>
    <nav
        role="navigation"
        aria-label="Pagination Navigation"
        class="flex items-center justify-between"
    >
        <div
            class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between"
        >
            <div>
                <p class="text-sm text-gray-700 leading-5">
                    Showing
                    <span id="table-from" class="font-medium"></span>
                    to
                    <span id="table-to" class="font-medium"></span>
                    of
                    <span id="table-total" class="font-medium"></span>
                    results
                </p>
            </div>

            <div>
                <span class="relative z-0 inline-flex shadow-sm rounded-md">
                    <span
                        aria-label="&amp;laquo; Previous"
                        id="table-previous"
                        class="table-nav-button"
                    >
                        <span
                            class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default rounded-l-md leading-5"
                            aria-hidden="true"
                        >
                            <svg
                                class="w-5 h-5"
                                fill="currentColor"
                                viewBox="0 0 20 20"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                    clip-rule="evenodd"
                                ></path>
                            </svg>
                        </span>
                    </span>
                    <span id="page-buttons"></span>
                    <span
                        rel="next"
                        id="table-next"
                        class="cursor pointer table-nav-button relative inline-flex items-center px-2 py-2 -ml-px text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-r-md leading-5 hover:text-gray-400 focus:z-10 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150"
                        aria-label="Next &amp;raquo;"
                    >
                        <svg
                            class="w-5 h-5"
                            fill="currentColor"
                            viewBox="0 0 20 20"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd"
                            ></path>
                        </svg>
                    </span>
                </span>
            </div>
        </div>
    </nav>

    <script>
        $(document).ready(() => {
            updateTable();
            $(document).on("click", ".table-nav-button", function () {
                var url = new URL(window.location);

                const currentPage = url.searchParams.get("page") || 1;
                if (currentPage != $(this).data("page")) {
                    url.searchParams.set("page", $(this).data("page"));
                    window.history.pushState("", "", url.href);
                    updateTable();
                }
            });
            $(document).on("submit", ".delete-airline-form", function (e) {
                fetchFormRequest({
                    e,
                    form: $(this),
                })
                    .then((data) => {
                        updateTable();
                    })
                    .catch((error) => {
                        alert(error);
                    });
            });

            $(document).on("click", ".edit-airline-cities", function () {
                let airline = $(this).closest(".airline");
                $("#edit-airline-cities-modal").trigger("activate", {
                    airlineId: airline.data("airline-id"),
                    airlineCities: JSON.parse(
                        decodeURIComponent(airline.data("cities"))
                    ),
                });
            });

            $(document).on("click", ".edit-airline", function () {
                let airline = $(this).closest(".airline");
                $("#edit-airline-modal").trigger("activate", {
                    airlineId: airline.data("airline-id"),
                    airlineName: airline.find(".airline-name").html().trim(),
                    airlineBusinessDescription: airline.find(".airline-business-description").html().trim(),
                });
            });
        });

        const updateTable = (callback = () => {}) => {
            fetch(`/api/airlines?${getQueryParams()}`)
                .then((response) => response.json())
                .then((data) => {
                    $("#airlines").html(getRowsHTML(data.data));

                    updatePaginationData(data);

                    callback(data);
                });
        };

        const getRowsHTML = (rows) => {
            const htmlRows = rows.map(
                (airline) => `
                    <tr class="airline" data-airline-id="${
                        airline.id
                    }" data-cities="${encodeURIComponent(
                    JSON.stringify(airline.cities)
                )}">
    <td>${airline.id}</td>
    <td class="airline-name"> ${airline.name}</td>
    <td class="airline-business-description">${
        airline.business_description
    }</td>
    <td>${airline.flights_count}</td>
    <td><div class="edit-airline-cities text-blue-500 hover:text-blue-600">Edit Cities</div></td>
    <td>
        <td><div class="edit-airline text-blue-500 hover:text-blue-600">Edit</div></td>
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
            const currentPage = searchParams.get("page") || 1;

            const linksHTML = data.links
                .slice(1, -1)
                .map((link) => {
                    return {
                        label: link.label,
                        page: link?.url?.split("page=")[1] ?? "",
                    };
                })
                .map(
                    (link) =>
                        `<span aria-current="page" data-page="${link.page}" class="table-nav-button">
                            <span
                                class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-pointer leading-5">${link.label}</span>
                        </span>`,
                    ""
                )
                .join("");
            $("#page-buttons").html(linksHTML);
            $("#table-from").html(data.from);
            $("#table-to").html(data.to);
            $("#table-total").html(data.total);

            $("#table-previous").data("page", Math.max(1, +currentPage - 1));
            $("#table-next").data(
                "page",
                Math.min(data.last_page, +currentPage + 1)
            );
        };
    </script>
</div>
