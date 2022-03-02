<div id="cities-table">
    <div class="flex flex-col">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                    <table class="min-w-full">
                        <thead class="bg-slate-100 border-b">
                            <tr>
                                <th
                                    scope="col"
                                    class="text-sm font-bold text-gray-900 px-6 py-4 text-left"
                                >
                                    Id
                                </th>
                                <th
                                    scope="col"
                                    class="text-sm font-bold text-gray-900 px-6 py-4 text-left"
                                >
                                    Name
                                </th>
                                <th
                                    scope="col"
                                    class="text-sm font-bold text-gray-900 px-6 py-4 text-left"
                                >
                                    Departures
                                </th>
                                <th
                                    scope="col"
                                    class="text-sm font-bold text-gray-900 px-6 py-4 text-left"
                                >
                                    Arrivals
                                </th>
                                <th
                                    scope="col"
                                    class="text-sm font-bold text-gray-900 px-6 py-4 text-left"
                                ></th>
                                <th
                                    scope="col"
                                    class="text-sm font-bold text-gray-900 px-6 py-4 text-left"
                                ></th>
                            </tr>
                        </thead>
                        <tbody id="cities">
                            @foreach ($cities as $city) @include ('cities._city-row')
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{ $cities->links() }}

    <script>
        $(document).ready(() => {
            $(".delete-city-form").submit(function (e) {
                formRequest({
                    e,
                    form: $(this),
                    success: () => {
                        updateTable();
                    },
                });
            });

            $(".edit-city").on("click", function () {
                let city = $(this).closest(".city");
                $("#edit-city-modal").trigger("activate", {
                    cityId: city.data("city-id"),
                    cityName: city.find(".city-name").html().trim(),
                });
            });
        });
    </script>
</div>
