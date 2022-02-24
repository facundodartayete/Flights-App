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
            @foreach ($airlines as $airline)
                @include ('airlines._airline-row')
            @endforeach
        </tbody>
    </table>
    {{ $airlines->links() }}

    <script>
        $(document).ready(() => {
            $(document).on('submit', ".delete-airline-form", function(e) {
                fetchFormRequest({
                    e,
                    form: $(this),
                }).then(res => res.json()).then((data) => {
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
