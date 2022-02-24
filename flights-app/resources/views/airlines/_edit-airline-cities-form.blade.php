<div
    id="edit-airline-cities-modal"
    data-airline-id="1"
    class="hidden overflow-y-auto overflow-x-hidden fixed right-0 left-0 top-4 z-50 justify-center items-center h-modal md:h-full md:inset-0"
>
    <div class="relative px-4 w-full max-w-md h-full md:h-auto">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <div class="flex justify-end p-2">
                <button
                    id="edit-airline-cities-modal-close"
                    type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white"
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
            <div
                id="edit-airline-cities"
                class="px-6 pb-4 space-y-6 lg:px-8 sm:pb-6 xl:pb-8"
            >
                <h3 class="text-xl font-medium text-gray-900 dark:text-white">
                    Airline Cities
                </h3>
                <div>
                    <label
                        for="name"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                        >Cities</label
                    >
                    <select name="cities" id="cities">
                        <option value="0" disabled selected>
                            Select a City
                        </option>
                        @foreach ($cities as $city)
                        <option value="{{ $city->id }}">
                            {{ $city->name }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label
                        for="name"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                        >Airline Cities</label
                    >
                    <div id="airline-cities"></div>
                </div>

                <button
                    id="edit-airline-cities-button"
                    class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                >
                    Edit
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    $("document").ready(() => {
        $("#cities").on("change", function () {
            const cityId = $(this).val();
            if (!$(`.airline-city[data-city-id="${cityId}"]`).length) {
                $("#airline-cities").append(
                    airlineCityHtml({
                        id: cityId,
                        name: $(this).find("option:selected").text(),
                    })
                );
            }
        });

        $("#edit-airline-cities-modal").on(
            "activate",
            function (e, { airlineId, airlineName = "", airlineCities = [] }) {
                $(this).data("airline-id", airlineId);
                $("#airline-cities").html(
                    airlineCities
                        .map((city) =>
                            airlineCityHtml({
                                id: city.id,
                                name: city.name,
                            })
                        )
                        .join("")
                );
                $(this).removeClass("hidden");
            }
        );

        $("#edit-airline-cities-modal-close").on("click", () =>
            $("#edit-airline-cities-modal").addClass("hidden")
        );

        $("#edit-airline-cities-button").on("click", async () => {
            try {
                const airlineId = $("#edit-airline-cities-modal").data(
                    "airline-id"
                );
                const data = {
                    city_ids: $(".airline-city")
                        .map((i, city) => $(city).data("city-id"))
                        .toArray(),
                };
                const response = await fetch(`/airlines/${airlineId}/cities`, {
                    method: "PUT",
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                        accept: "application/json",
                        "Content-Type": "application/json",
                    },
                    body: JSON.stringify(data),
                });

                if (response.ok) {
                    const data = await response.json();
                    updateTable(() => {
                        $("#edit-airline-cities-modal").addClass("hidden");
                    });
                } else {
                    return response.json().then((error) => {
                        throw new Error(error.message);
                    });
                }
            } catch (error) {
                alert(error);
            }
        });
    });

    const airlineCityHtml = ({
        id,
        name,
    }) => `<input class="airline-city bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                        disabled data-city-id="${id}" value="${name}" />`;
</script>
