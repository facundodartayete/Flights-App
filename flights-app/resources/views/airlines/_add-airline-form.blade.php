<form id="create-airline-form" class="px-6 pb-4 space-y-6 lg:px-8 sm:pb-6 xl:pb-8 flex flex-row" method="POST"
    action="/airlines">
    @csrf
    <div>
        <input type="text" name="name" id="name"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
            placeholder="New Airline Name" required />
    </div>
    <div>
        <input type="text" name="business_description" id="business_description"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
            placeholder="Business description" required />
    </div>
    <button type="submit"
        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
        Add Airline
    </button>
</form>

<script>
    $(document).ready(() => {
        $("#create-airline-form").submit(async function(e) {
            fetchFormRequest({
                    e,
                    form: $(this),
                })
                .then((data) => {
                    updateTable(() => {
                        $("#create-airline-form").trigger("reset");
                        alert("airline created successfully");
                    });
                })
                .catch((error) => {
                    alert(error);
                });
        });
    });
</script>
