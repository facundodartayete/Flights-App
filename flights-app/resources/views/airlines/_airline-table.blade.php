<div id="airlines-table">
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
                        <td>Description</td>
                    </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm font-medium">
                        <td>Flights</td>
                    </div>
                </td>
                <td></td>
                <td></td>
            </tr>
        </thead>
        <tbody id="airlines" class="bg-white divide-y divide-gray-200">
            @foreach ($airlines as $airline) @include ('airlines._airline-row')
            @endforeach
        </tbody>
    </table>
    {{$airlines->links()}}

    <script>
        $(document).ready(() => {
            $(".delete-airline-form").submit(function (e) {
                formRequest({
                    e,
                    form: $(this),
                    success: () => {
                        $.ajax({
                            url: `/airlines/table?${getQueryParams()}`,
                            type: "GET",
                            success: (response) => {
                                $("#airlines-table").replaceWith(response);
                            },
                        });
                    },
                });
            });

            $(".edit-airline").on("click", function () {
                let airline = $(this).closest(".airline");
                $("#edit-airline-modal").trigger("activate", {
                    airlineId: airline.data("airline-id"),
                    airlineName: airline.find(".airline-name").html().trim(),
                    airlineBusinessDescription: airline.find(".airline-business-description").html().trim(),
                });
            });
        });
    </script>
</div>
