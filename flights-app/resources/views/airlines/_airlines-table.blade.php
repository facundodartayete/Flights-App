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
            </tr>
        </thead>
        <tbody id="airlines">
        </tbody>
    </table>
    <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-between">
        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
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
                    <span aria-label="&amp;laquo; Previous" id="table-previous" class="table-nav-button">
                        <span
                            class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default rounded-l-md leading-5"
                            aria-hidden="true">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </span>
                    </span>
                    <span id="page-buttons"></span>
                    <span rel="next" id="table-next"
                        class="cursor pointer table-nav-button relative inline-flex items-center px-2 py-2 -ml-px text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-r-md leading-5 hover:text-gray-400 focus:z-10 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150"
                        aria-label="Next &amp;raquo;">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </span>
                </span>
            </div>
        </div>
    </nav>

    <script>
        $(document).ready(() => {
            updateTable();
            $(document).on('click', '.table-nav-button', function() {
                var url = new URL(window.location);

                const currentPage = url.searchParams.get('page') || 1;
                if (currentPage != $(this).data('page')) {
                    url.searchParams.set('page', $(this).data('page'));
                    window.history.pushState("", "", url.href);
                    updateTable();
                }
            })
            $(document).on('submit', ".delete-airline-form", function(e) {
                fetchFormRequest({
                    e,
                    form: $(this),
                }).then((data) => {
                    updateTable();
                }).catch((error) => {
                    alert(error);
                });
            });

            $(document).on("click", ".edit-airline", function() {
                let airline = $(this).closest(".airline");
                $("#edit-airline-modal").trigger("activate", {
                    airlineId: airline.data("airline-id"),
                    airlineName: airline.find(".airline-name").html().trim(),
                    airlineBusinessDescription: airline
                        .find(".airline-business-description")
                        .html()
                        .trim(),
                });
            });
        });
    </script>
</div>
