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

export default {
    components: {
        TableComponent,
        TableNav,
    },
    setup() {
        const state = reactive({
            flightsData: JSON.parse(
                `{"current_page":1,"data":[{"id":1,"airline_id":4,"origin_city_id":1,"destination_city_id":6,"departure_at":"2023-02-03 19:39:25","arrival_at":"2023-02-03 19:51:59","created_at":"2022-02-24T21:41:39.000000Z","updated_at":"2022-02-24T21:41:39.000000Z","deleted_at":null,"destination_city":{"id":6,"name":"ex","deleted_at":null,"created_at":"2022-02-24T21:41:38.000000Z","updated_at":"2022-02-24T21:41:38.000000Z"},"origin_city":{"id":1,"name":"sed","deleted_at":null,"created_at":"2022-02-24T21:41:38.000000Z","updated_at":"2022-02-24T21:41:38.000000Z"},"airline":{"id":4,"name":"officia","business_description":"Iste omnis nihil inventore error possimus enim cum. Adipisci eaque dignissimos consectetur officia ut consectetur non. Sed aut est aut. Perferendis impedit odio necessitatibus nihil iste quisquam.","deleted_at":null,"created_at":"2022-02-24T21:41:38.000000Z","updated_at":"2022-02-24T21:41:38.000000Z"}},{"id":2,"airline_id":29,"origin_city_id":1,"destination_city_id":1,"departure_at":"2023-02-20 16:07:57","arrival_at":"2023-02-20 23:19:43","created_at":"2022-02-24T21:41:39.000000Z","updated_at":"2022-02-24T21:41:39.000000Z","deleted_at":null,"destination_city":{"id":1,"name":"sed","deleted_at":null,"created_at":"2022-02-24T21:41:38.000000Z","updated_at":"2022-02-24T21:41:38.000000Z"},"origin_city":{"id":1,"name":"sed","deleted_at":null,"created_at":"2022-02-24T21:41:38.000000Z","updated_at":"2022-02-24T21:41:38.000000Z"},"airline":{"id":29,"name":"numquam","business_description":"Eum veniam optio velit accusamus quo soluta sunt. Iste dolores mollitia totam voluptatem incidunt alias. Nostrum veritatis nam voluptatem repellat minima voluptates eveniet.","deleted_at":null,"created_at":"2022-02-24T21:41:38.000000Z","updated_at":"2022-02-24T21:41:38.000000Z"}},{"id":3,"airline_id":34,"origin_city_id":1,"destination_city_id":13,"departure_at":"2022-10-14 17:34:45","arrival_at":"2022-10-14 18:34:47","created_at":"2022-02-24T21:41:39.000000Z","updated_at":"2022-02-24T21:41:39.000000Z","deleted_at":null,"destination_city":{"id":13,"name":"voluptatum","deleted_at":null,"created_at":"2022-02-24T21:41:38.000000Z","updated_at":"2022-02-24T21:41:38.000000Z"},"origin_city":{"id":1,"name":"sed","deleted_at":null,"created_at":"2022-02-24T21:41:38.000000Z","updated_at":"2022-02-24T21:41:38.000000Z"},"airline":{"id":34,"name":"hic","business_description":"Repellendus quasi voluptates rem non mollitia ipsa laborum. Reiciendis cumque sequi id adipisci. Odit mollitia voluptas eum illum. Repellat molestias est ut recusandae esse ab.","deleted_at":null,"created_at":"2022-02-24T21:41:38.000000Z","updated_at":"2022-02-24T21:41:38.000000Z"}},{"id":4,"airline_id":39,"origin_city_id":1,"destination_city_id":8,"departure_at":"2022-10-11 14:30:45","arrival_at":"2022-10-11 16:27:53","created_at":"2022-02-24T21:41:39.000000Z","updated_at":"2022-02-24T21:41:39.000000Z","deleted_at":null,"destination_city":{"id":8,"name":"natus","deleted_at":null,"created_at":"2022-02-24T21:41:38.000000Z","updated_at":"2022-02-24T21:41:38.000000Z"},"origin_city":{"id":1,"name":"sed","deleted_at":null,"created_at":"2022-02-24T21:41:38.000000Z","updated_at":"2022-02-24T21:41:38.000000Z"},"airline":{"id":39,"name":"commodi","business_description":"Recusandae doloribus enim molestiae. Sunt nam quam non iste. Harum nesciunt dolor minima quo. Officiis sit voluptas id.","deleted_at":null,"created_at":"2022-02-24T21:41:38.000000Z","updated_at":"2022-02-24T21:41:38.000000Z"}},{"id":5,"airline_id":28,"origin_city_id":1,"destination_city_id":15,"departure_at":"2022-12-18 05:04:09","arrival_at":"2022-12-18 16:20:45","created_at":"2022-02-24T21:41:39.000000Z","updated_at":"2022-02-24T21:41:39.000000Z","deleted_at":null,"destination_city":{"id":15,"name":"porro","deleted_at":null,"created_at":"2022-02-24T21:41:38.000000Z","updated_at":"2022-02-24T21:41:38.000000Z"},"origin_city":{"id":1,"name":"sed","deleted_at":null,"created_at":"2022-02-24T21:41:38.000000Z","updated_at":"2022-02-24T21:41:38.000000Z"},"airline":{"id":28,"name":"debitis","business_description":"Et suscipit magni dolor dolor. Voluptatibus quis consequatur nostrum debitis. Voluptatibus omnis fuga nobis deleniti officiis.","deleted_at":null,"created_at":"2022-02-24T21:41:38.000000Z","updated_at":"2022-02-24T21:41:38.000000Z"}},{"id":6,"airline_id":3,"origin_city_id":1,"destination_city_id":6,"departure_at":"2022-12-21 00:31:51","arrival_at":"2022-12-21 05:16:53","created_at":"2022-02-24T21:41:39.000000Z","updated_at":"2022-02-24T21:41:39.000000Z","deleted_at":null,"destination_city":{"id":6,"name":"ex","deleted_at":null,"created_at":"2022-02-24T21:41:38.000000Z","updated_at":"2022-02-24T21:41:38.000000Z"},"origin_city":{"id":1,"name":"sed","deleted_at":null,"created_at":"2022-02-24T21:41:38.000000Z","updated_at":"2022-02-24T21:41:38.000000Z"},"airline":{"id":3,"name":"sit","business_description":"Qui earum quis explicabo fugit quam. Minus id molestiae aliquid dolorem nemo. Odit beatae incidunt vel voluptatem quia perferendis beatae porro. Voluptates aut commodi dolorem voluptatem dolor et qui.","deleted_at":null,"created_at":"2022-02-24T21:41:38.000000Z","updated_at":"2022-02-24T21:41:38.000000Z"}},{"id":7,"airline_id":14,"origin_city_id":1,"destination_city_id":16,"departure_at":"2022-08-26 17:26:59","arrival_at":"2022-08-27 02:59:55","created_at":"2022-02-24T21:41:39.000000Z","updated_at":"2022-02-24T21:41:39.000000Z","deleted_at":null,"destination_city":{"id":16,"name":"soluta","deleted_at":null,"created_at":"2022-02-24T21:41:38.000000Z","updated_at":"2022-02-24T21:41:38.000000Z"},"origin_city":{"id":1,"name":"sed","deleted_at":null,"created_at":"2022-02-24T21:41:38.000000Z","updated_at":"2022-02-24T21:41:38.000000Z"},"airline":{"id":14,"name":"non","business_description":"Possimus adipisci eligendi iusto delectus iure nihil. Et nesciunt eum consequuntur distinctio iusto in. Amet et eveniet eos. Ut vitae accusamus natus.","deleted_at":null,"created_at":"2022-02-24T21:41:38.000000Z","updated_at":"2022-02-24T21:41:38.000000Z"}},{"id":8,"airline_id":35,"origin_city_id":2,"destination_city_id":19,"departure_at":"2023-02-18 07:19:28","arrival_at":"2023-02-18 16:46:57","created_at":"2022-02-24T21:41:39.000000Z","updated_at":"2022-02-24T21:41:39.000000Z","deleted_at":null,"destination_city":{"id":19,"name":"in","deleted_at":null,"created_at":"2022-02-24T21:41:38.000000Z","updated_at":"2022-02-24T21:41:38.000000Z"},"origin_city":{"id":2,"name":"harum","deleted_at":null,"created_at":"2022-02-24T21:41:38.000000Z","updated_at":"2022-02-24T21:41:38.000000Z"},"airline":{"id":35,"name":"enim","business_description":"Id neque porro perspiciatis ut quasi. Modi modi qui hic tenetur eveniet. Numquam iusto quia voluptas adipisci consequatur debitis et. Doloremque consequuntur omnis vel labore fugiat.","deleted_at":null,"created_at":"2022-02-24T21:41:38.000000Z","updated_at":"2022-02-24T21:41:38.000000Z"}},{"id":9,"airline_id":15,"origin_city_id":3,"destination_city_id":8,"departure_at":"2022-05-16 17:03:33","arrival_at":"2022-05-16 19:45:41","created_at":"2022-02-24T21:41:39.000000Z","updated_at":"2022-02-24T21:41:39.000000Z","deleted_at":null,"destination_city":{"id":8,"name":"natus","deleted_at":null,"created_at":"2022-02-24T21:41:38.000000Z","updated_at":"2022-02-24T21:41:38.000000Z"},"origin_city":{"id":3,"name":"officiis","deleted_at":null,"created_at":"2022-02-24T21:41:38.000000Z","updated_at":"2022-02-24T21:41:38.000000Z"},"airline":{"id":15,"name":"eos","business_description":"Aut pariatur numquam omnis. Dolores minima temporibus illum velit dolor. Numquam autem et repudiandae. Eum qui et expedita aut veniam quia ut.","deleted_at":null,"created_at":"2022-02-24T21:41:38.000000Z","updated_at":"2022-02-24T21:41:38.000000Z"}},{"id":10,"airline_id":12,"origin_city_id":4,"destination_city_id":15,"departure_at":"2022-04-15 02:59:14","arrival_at":"2022-04-15 13:24:32","created_at":"2022-02-24T21:41:39.000000Z","updated_at":"2022-02-24T21:41:39.000000Z","deleted_at":null,"destination_city":{"id":15,"name":"porro","deleted_at":null,"created_at":"2022-02-24T21:41:38.000000Z","updated_at":"2022-02-24T21:41:38.000000Z"},"origin_city":{"id":4,"name":"labore","deleted_at":null,"created_at":"2022-02-24T21:41:38.000000Z","updated_at":"2022-02-24T21:41:38.000000Z"},"airline":{"id":12,"name":"tenetur","business_description":"Sed voluptatibus in sed occaecati aspernatur officiis aliquam. Iusto itaque cum et qui rerum perferendis sint. Est quae quae dolore iure. Quibusdam voluptas voluptas nam est ratione et incidunt.","deleted_at":null,"created_at":"2022-02-24T21:41:38.000000Z","updated_at":"2022-02-24T21:41:38.000000Z"}}],"first_page_url":"http:\/\/localhost\/api\/flights?page=1","from":1,"last_page":7,"last_page_url":"http:\/\/localhost\/api\/flights?page=7","links":[{"url":null,"label":"&laquo; Previous","active":false},{"url":"http:\/\/localhost\/api\/flights?page=1","label":"1","active":true},{"url":"http:\/\/localhost\/api\/flights?page=2","label":"2","active":false},{"url":"http:\/\/localhost\/api\/flights?page=3","label":"3","active":false},{"url":"http:\/\/localhost\/api\/flights?page=4","label":"4","active":false},{"url":"http:\/\/localhost\/api\/flights?page=5","label":"5","active":false},{"url":"http:\/\/localhost\/api\/flights?page=6","label":"6","active":false},{"url":"http:\/\/localhost\/api\/flights?page=7","label":"7","active":false},{"url":"http:\/\/localhost\/api\/flights?page=2","label":"Next &raquo;","active":false}],"next_page_url":"http:\/\/localhost\/api\/flights?page=2","path":"http:\/\/localhost\/api\/flights","per_page":10,"prev_page_url":null,"to":10,"total":65}`
            ),
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
            //TODO:
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
            pageChange
        };
    },
};
</script>
