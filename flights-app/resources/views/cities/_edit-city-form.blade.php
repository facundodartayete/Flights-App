<div
    id="edit-city-modal"
    class="hidden overflow-y-auto overflow-x-hidden fixed right-0 left-0 top-4 z-50 justify-center items-center h-modal md:h-full md:inset-0"
>
    <div class="relative px-4 w-full max-w-md h-full md:h-auto">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <div class="flex justify-end p-2">
                <button
                    id="edit-city-modal-close"
                    type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white"
                    data-modal-toggle="edit-city-modal"
                >
                    <svg
                        class="w-5 h-5"
                        fill="currentColor"
                        viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"
                        ></path>
                    </svg>
                </button>
            </div>
            <form
                id="edit-city-form"
                class="px-6 pb-4 space-y-6 lg:px-8 sm:pb-6 xl:pb-8"
                method="PUT"
            >
                @csrf
                <h3 class="text-xl font-medium text-gray-900 dark:text-white">
                    Edit City
                </h3>
                <div>
                    <label
                        for="name"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                        >City Name</label
                    >
                    <input
                        id="city-edit-name"
                        type="name"
                        name="name"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                        placeholder="Montevideo"
                        required
                    />
                </div>
                <button
                    type="submit"
                    class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                >
                    Edit
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    $("document").ready(() => {
        $("#edit-city-modal").on(
            "activate",
            function (e, { cityId, cityName }) {
                $(this).data("city-id", cityId);
                $("#city-edit-name").val(cityName);
                $(this).removeClass("hidden");
            }
        );

        $("#edit-city-modal-close").on("click", () =>
            $("#edit-city-modal").addClass("hidden")
        );

        $("#edit-city-form").submit(function (e) {
            const cityId = $("#edit-city-modal").data("city-id");
            formRequest({
                e,
                form: $(this),
                url: `/cities/${cityId}`,
                success: (response) => {
                    $("#edit-city-modal").addClass("hidden");
                    $(this).trigger("reset");
                    $(`.city[data-city-id="${cityId}"]`)
                        .find(".city-name")
                        .html(response.name);
                },
                error: (error) => {
                    alert(error.responseJSON.message);
                },
            });
        });
    });
</script>
