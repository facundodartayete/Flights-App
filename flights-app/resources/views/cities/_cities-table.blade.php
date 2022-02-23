<div id="cities-table">
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

    <script>
        $(document).ready(() => {
            $(".delete-city-form").submit(function (e) {
                formRequest({
                    e,
                    form: $(this),
                    success: () => {
                        $.ajax({
                            url: `/cities/table?${getQueryParams()}`,
                            type: "GET",
                            success: (response) => {
                                $("#cities-table").replaceWith(response);
                            },
                        });
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
