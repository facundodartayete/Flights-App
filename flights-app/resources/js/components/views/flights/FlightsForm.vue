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
            :start="new Date(state.flight.departure_at)"
            :end="new Date(state.flight.arrival_at)"
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
        const getAirlineObj = () => {
            if (state?.flight?.airline_id)
                return state.airlines.find(
                    (airline) => airline.id == state.flight.airline_id
                );

            return null;
        };

        const getCityObj = (id) => {
            return state?.cities?.find((city) => city.id == id) || null;
        };

        const getOriginObj = () =>
            getCityObj(state?.flight?.origin_city_id || 0);
        const getDestinationObj = () =>
            getCityObj(state?.flight?.destination_city_id || 0);

        const setFlightForm = () =>
            new Form({
                airline: getAirlineObj(),
                airline_id: 0,
                origin: getOriginObj(),
                origin_city_id: 0,
                destination: getDestinationObj(),
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
            state.flight = new Form({
                ...state.flight,
                airline_id: airline.id,
                airline: airline,
                destination: null,
                origin: null,
            });
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

            if (!flight.origin?.id || !flight.destination?.id)
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
            () => state?.flight?.airline,
            (newValue) => {
                if (newValue?.id) fetchAirlineCities(newValue.id);
            }
        );
        watch(
            () => state?.airlines,
            () => {
                state.flight.airline = getAirlineObj();
            }
        );

        watch(
            () => state?.cities,
            () => {
                state.flight = new Form({
                    ...state.flight,
                    origin: getOriginObj(),
                    destination: getDestinationObj(),
                });
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
