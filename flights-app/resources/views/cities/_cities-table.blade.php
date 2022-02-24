<div id="cities-table" class="table-wrapper">
    <table class="table-fixed">
        <thead>
            <tr>
                <td>Id</td>
                <td>Name</td>
                <td>Departures</td>
                <td>Arrivals</td>
                <td></td>
                <td></td>
            </tr>
        </thead>
        <tbody id="cities">
            @foreach ($cities as $city)
                @include ('cities._city-row')
            @endforeach
        </tbody>
    </table>
    {{ $cities->links() }}

    <script>
        $(document).ready(() => {
            $(".delete-city-form").submit(function(e) {
                formRequest({
                    e,
                    form: $(this),
                    success: () => {
                        updateTable();
                    },
                });
            });

            $(".edit-city").on("click", function() {
                let city = $(this).closest(".city");
                $("#edit-city-modal").trigger("activate", {
                    cityId: city.data("city-id"),
                    cityName: city.find(".city-name").html().trim(),
                });
            });
        });
    </script>
</div>
