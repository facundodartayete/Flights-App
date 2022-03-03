<template>
    <Modal
        :title="'Create Flight'"
        :button="'Add Flight'"
        :active="state.addModalActive"
        @close="state.addModalActive = false"
        @submit="submitAddHandle"
        ref="addModal"
    >
        <template v-slot:content>
            <FlightsForm
                :url="'/api/flights'"
                :method="'POST'"
                @success="addFlightSuccess"
                ref="addFlightFormRef"
            >
            </FlightsForm>
        </template>
    </Modal>

    <TableComponent
        :items="flightRows"
        :columns="state.columns"
        :showEdit="true"
        :showDelete="true"
        @edit="editFlightHandle"
        @delete="deleteFlightHandle"
    ></TableComponent>
    <TableNav :data="state.flightsData" @page-change="pageChange"></TableNav>

    <Modal
        :title="'Edit Flight'"
        :active="state.editModalActive"
        @close="state.editModalActive = false"
        @submit="submitEditHandle"
        ref="editModal"
    >
        <template v-slot:button> <div></div></template>
        <template v-slot:content>
            <FlightsForm
                :url="`/api/flights/${state.editFlight?.id}`"
                :method="'PUT'"
                :flight="state.editFlight"
                @success="editFlightSuccess"
                ref="editFlightFormRef"
            >
            </FlightsForm>
        </template>
    </Modal>
    <Modal
        :title="'Are you sure you want to delete this flight?'"
        :active="state.deleteModalActive"
        @close="state.deleteModalActive = false"
        @submit="deleteFlight"
    >
        <template v-slot:button><div></div></template>
        <template v-slot:content></template>
    </Modal>
</template>

<script>
import { reactive, onMounted, computed, watch, ref } from "vue";
import Modal from "../../Modal.vue";
import TableComponent from "../../table/TableComponent.vue";
import TableNav from "../../table/TableNav.vue";
import FlightsForm from "./FlightsForm.vue";
import { useToast } from "vue-toastification";
import { getRequest, deleteRequest } from "../../../api.js";
import { flightEndpoints } from "../../../endpoints.js";

export default {
    components: {
        TableComponent,
        TableNav,
        FlightsForm,
        Modal,
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
            editModalActive: false,
            addModalActive: false,
            deleteModalActive: false,
            editFlight: null,
            deleteFlight: null,
        });

        const addFlightFormRef = ref(null);
        const editFlightFormRef = ref(null);
        const addModal = ref(null);
        const editModal = ref(null);

        const fetchData = () => {
            getRequest(flightEndpoints.get() + `?page=${state.page}`)
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

        const editFlightHandle = (flight) => {
            state.editModalActive = true;
            state.editFlight = state.flightsData.data.find(
                (f) => f.id == flight.id
            );
        };

        const deleteFlightHandle = (flight) => {
            state.deleteModalActive = true;
            state.deleteFlight = flight;
        };

        const deleteFlight = () => {
            deleteRequest(flightEndpoints.delete(state.deleteFlight.id))
                .then((data) => {
                    toast.success("Flight deleted");
                    state.deleteModalActive = false;
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
                    airline: flight.airline?.name,
                    origin: flight.origin_city?.name,
                    destiny: flight.destination_city?.name,
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

        const editFlightSuccess = () => {
            state.editModalActive = false;
            editModal.value?.closeModal();
            fetchData();
            toast.success("Flight Updated");
        };

        const addFlightSuccess = () => {
            state.addModalActive = false;
            toast.success("Flight Created");
            addModal.value?.closeModal();
            fetchData();
        };

        const submitAddHandle = () => {
            addFlightFormRef.value?.submitForm();
        };

        const submitEditHandle = () => {
            editFlightFormRef.value?.submitForm();
        };

        return {
            state,
            flightRows,
            editFlightHandle,
            deleteFlightHandle,
            deleteFlight,
            pageChange,
            editFlightSuccess,
            addFlightSuccess,
            addFlightFormRef,
            editFlightFormRef,
            submitAddHandle,
            submitEditHandle,
            addModal,
            editModal,
        };
    },
};
</script>
