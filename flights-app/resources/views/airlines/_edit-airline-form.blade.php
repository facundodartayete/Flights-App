<div id="edit-airline-modal"
    class="hidden overflow-y-auto overflow-x-hidden fixed right-0 left-0 top-4 z-50 justify-center items-center h-modal md:h-full md:inset-0">
    <div class="relative px-4 w-full max-w-md h-full md:h-auto">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <div class="flex justify-end p-2">
                <button id="edit-airline-modal-close" type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white"
                    data-modal-toggle="edit-airline-modal">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
            <form id="edit-airline-form" class="px-6 pb-4 space-y-6 lg:px-8 sm:pb-6 xl:pb-8" method="PUT">
                @csrf
                <h3 class="text-xl font-medium text-gray-900 dark:text-white">
                    Edit Airline
                </h3>
                <div>
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Airline
                        Name</label>
                    <input id="airline-edit-name" type="name" name="name"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                        placeholder="Montevideo" required />
                </div>
                <div>
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Airline
                        Business Description</label>
                    <input id="airline-edit-business-description" type="name" name="business_description"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                        placeholder="Montevideo" required />
                </div>
                <button type="submit"
                    class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Edit
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    $("document").ready(() => {
        $("#edit-airline-modal").on(
            "activate",
            function(
                e, {
                    airlineId,
                    airlineName,
                    airlineBusinessDescription
                }
            ) {
                $(this).data("airline-id", airlineId);
                $("#airline-edit-name").val(airlineName);
                $("#airline-edit-business-description").val(
                    airlineBusinessDescription
                );
                $(this).removeClass("hidden");
                $("#airline-edit-name").focus();
            }
        );

        $("#edit-airline-modal-close").on("click", () =>
            $("#edit-airline-modal").addClass("hidden")
        );

        $("#edit-airline-form").submit(function(e) {
            const airlineId = $("#edit-airline-modal").data("airline-id");
            fetchFormRequest({
                e,
                form: $(this),
                url: `/airlines/${airlineId}`,
            }).then(res => res.json()).then((data) => {
                updateTable();
                $("#edit-airline-form").trigger("reset");
                $("#edit-airline-modal").addClass("hidden");
            }).catch((error) => {
                alert(error);
            });
        });
    });
</script>
