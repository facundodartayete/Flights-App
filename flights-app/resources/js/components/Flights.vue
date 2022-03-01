<template>
    <TableComponent
        :items="flightRows"
        :columns="state.columns"
        :showEdit="true"
        :showDelete="true"
        @edit="editFlight"
        @delete="deleteFlight"
    ></TableComponent>
    <TableNav :data="state.flightsData" @page-change="pageChange"></TableNav>
</template>

<script>
import { reactive, onMounted, computed, watch } from "vue";
import TableComponent from "./table/TableComponent.vue";
import TableNav from "./table/TableNav.vue";
import { useToast } from "vue-toastification";

export default {
    components: {
        TableComponent,
        TableNav,
    },
    setup() {
        const toast = useToast();
        const state = reactive({
            flightsData: {},
            columns: [
                "ID",
                "Airline",
                "Origin",
                "Destination",
                "Departure",
                "Arrival",
            ],
            page: 1,
        });

        const fetchData = () => {
            fetch(`/api/flights?page=${state.page}`, {
                method: "GET",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                    accept: "application/json",
                    "Content-Type": "application/json",
                },
            })
                .then((response) => response.json())
                .then((data) => (state.flightsData = data))
                .catch((error) => console.log(error));
        };

        onMounted(() => {
            fetchData();
        });

        const formatDate = (date) => {
            const dateObj = new Date(date);
            const timeStr = dateObj.toTimeString().split(" ")[0];
            return `${dateObj.toLocaleDateString()} ${timeStr}`;
        };

        const editFlight = (flightId) => {
            //TODO:
        };

        const deleteFlight = (flightId) => {
            fetch(`/api/flights/${flightId}`, {
                method: "DELETE",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                    accept: "application/json",
                    "Content-Type": "application/json",
                },
            })
                .then((response) => response.json())
                .then((data) => {
                    toast.success("Flight deleted");
                    fetchData();
                })
                .catch((error) => {
                    toast.success(error.message);
                    console.log(error);
                });
        };

        const pageChange = (page) => {
            state.page = page;
        };

        const flightRows = computed(() =>
            state.flightsData?.data?.map((flight) => {
                return {
                    id: flight.id,
                    airline: flight.airline.name,
                    origin: flight.origin_city.name,
                    destiny: flight.destination_city.name,
                    departure_at: formatDate(flight.departure_at),
                    arrival_at: formatDate(flight.arrival_at),
                };
            })
        );

        watch(
            () => state.page,
            (newValue, oldValue) => {
                if (newValue != oldValue) fetchData();
            }
        );

        return {
            state,
            flightRows,
            editFlight,
            deleteFlight,
            pageChange,
        };
    },
};
</script>
