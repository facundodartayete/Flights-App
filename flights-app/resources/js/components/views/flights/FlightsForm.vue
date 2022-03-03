<template>
    <div>
        <FormSelect
            :name="'Airline'"
            :value="state.flight.airline"
            :options="state.airlines"
            :trackby="'name'"
            :label="'name'"
            @select="airlineSelected"
        ></FormSelect>

        <FormSelect
            :name="'Origin'"
            :value="state.flight.origin"
            :options="originCityOptions"
            :trackby="'name'"
            :label="'name'"
            @select="originSelected"
        ></FormSelect>

        <FormSelect
            :name="'Destination'"
            :value="state.flight.destination"
            :options="destinationCityOptions"
            :trackby="'name'"
            :label="'name'"
            @select="destinationSelected"
        ></FormSelect>

        <FormDatetimeRange
            :name="'Dates'"
            :start="state.flight.departure_at"
            :end="state.flight.arrival_at"
            @update="datesUpdate"
        ></FormDatetimeRange>
    </div>
</template>

<script>
import Modal from "../../Modal.vue";
import FormInput from "../../form/FormInput.vue";
import FormSelect from "../../form/FormSelect.vue";
import Form from "../../form/Form.js";
import FormDatetimeRange from "../../form/FormDatetimeRange.vue";
import { reactive, onMounted, computed, watch } from "vue";
import { useToast } from "vue-toastification";
import { getRequest, deleteRequest } from "../../../api.js";
import { airlineEndpoints } from "../../../endpoints.js";
export default {
    components: {
        Modal,
        FormInput,
        FormSelect,
        FormDatetimeRange,
    },
    props: ["flight", "url", "method"],
    setup(props, context) {
        const setFlightForm = () =>
            new Form({
                airline: null,
                airline_id: 0,
                origin: null,
                origin_city_id: 0,
                destination: null,
                destination_city_id: 0,
                departure_at: "",
                arrival_at: "",
                ...props.flight,
            });
        const toast = useToast();

        const state = reactive({
            flight: setFlightForm(),
            airlines: [],
            cities: [],
            active: false,
        });

        const fetchAirlines = () => {
            getRequest(airlineEndpoints.get() + `?all=1`)
                .then((data) => (state.airlines = data))
                .catch((error) => console.log(error));
        };

        const fetchAirlineCities = (airlineId) => {
            getRequest(airlineEndpoints.cities(airlineId))
                .then((data) => (state.cities = data))
                .catch((error) => console.log(error));
        };

        const airlineSelected = (airline) => {
            state.flight.airline_id = airline.id;
            state.flight.airline = airline;

            fetchAirlineCities(airline.id);
        };

        const originSelected = (city) => {
            state.flight.origin_city_id = city.id;
            state.flight.origin = city;
        };

        const destinationSelected = (city) => {
            state.flight.destination_city_id = city.id;
            state.flight.destination = city;
        };

        onMounted(() => {
            fetchAirlines();
        });

        const destinationCityOptions = computed(() =>
            state.cities.filter((c) => c.id != state.flight.origin_city_id)
        );
        const originCityOptions = computed(() =>
            state.cities.filter((c) => c.id != state.flight.destination_city_id)
        );

        const datesUpdate = (dates) => {
            if (!dates) return;
            const [startDate, endDate] = dates;
            state.flight.departure_at = startDate;
            state.flight.arrival_at = endDate;
        };

        const submitForm = () => {
            if (validateFlight()) {
                state.flight
                    .submit(props.method, props.url)
                    .then((data) => {
                        context.emit("success", data);
                    })
                    .catch((error) => {
                        console.log(error);
                        toast.error(error.message);
                    });
            } else {
                toast.error(state.flight.errors.first());
            }
        };

        const validateFlight = () => {
            const flight = state.flight.data();
            const errors = [];
            if (!flight.airline_id) errors.push("Select an airline first");

            if (!flight.origin_city_id || !flight.destination_city_id)
                errors.push("Select cities first");

            if (!flight.departure_at || !flight.arrival_at)
                errors.push("Select dates first");

            if (flight.destination_city_id == flight.origin_city_id)
                errors.push("Cities must be different");
            if (flight.departure_at >= flight.arrival_at)
                errors.push("Arrival must be after departure");

            state.flight.errors.record(errors);
            return !state.flight.errors.any();
        };

        watch(
            () => props.flight,
            () => {
                console.log("flighttt2");
                state.active = setFlightForm();
            }
        );

        watch(
            () => state?.airlines,
            () => {
                if (state?.flight?.airline_id)
                    state.flight.airline = state.airlines.find(
                        (airline) => airline.id == state.flight.airline_id
                    );
            }
        );

        return {
            state,
            fetchAirlines,
            fetchAirlineCities,
            airlineSelected,
            destinationCityOptions,
            originCityOptions,
            originSelected,
            destinationSelected,
            datesUpdate,
            submitForm,
        };
    },
};
</script>
