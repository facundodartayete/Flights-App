<x-layout>
    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div
                class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8"
            >
                <div
                    class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg"
                >
                    <h2
                        class="font-medium leading-tight text-4xl mt-0 mb-2 text-blue-600"
                    >
                        Airlines
                    </h2>
                    @include ('airlines._add-airline-form')
                    @include('airlines._airlines-table')
                </div>
            </div>
        </div>
    </div>
    @include ('airlines._edit-airline-form')
    @include('airlines._edit-airline-cities-form')
</x-layout>
