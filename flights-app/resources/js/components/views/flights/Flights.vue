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
                :url="flightEndpoints.create()"
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
    >
        <TableRow
            v-for="(flight, index) in state.flightsData?.data"
            :key="index"
        >
            <TableCell :text="flight.id"> </TableCell>
            <TableCell :text="flight.airline?.name"> </TableCell>
            <TableCell :text="flight.origin_city?.name"> </TableCell>
            <TableCell :text="flight.destination_city?.name"> </TableCell>
            <TableCell :text="formatDate(flight.departure_at)"> </TableCell>
            <TableCell :text="formatDate(flight.arrival_at)"> </TableCell>
            <TableCell>
                <Modal
                    :title="`Edit Flight: ${flight.id}`"
                    :active="state.editModalActive"
                    @close="state.editModalActive = false"
                    @submit="submitEditHandle(flight.id)"
                    ref="editModal"
                >
                    <template v-slot:button>
                        <div class="cursor-pointer font-bold text-indigo-600">
                            Edit
                        </div>
                    </template>
                    <template v-slot:content>
                        <FlightsForm
                            :url="flightEndpoints.update(flight.id)"
                            :method="'PUT'"
                            :flight="flight"
                            @success="editFlightSuccess"
                            :ref="
                                (el) => {
                                    editFlightFormRefs[
                                        `editFlightFormRef-${flight.id}`
                                    ].value = el;
                                }
                            "
                        >
                        </FlightsForm>
                    </template>
                </Modal>
            </TableCell>
            <TableCell>
                <div class="cursor-pointer font-bold text-red-600">Delete</div>
            </TableCell>
        </TableRow>
    </TableComponent>
    <TableNav :data="state.flightsData" @page-change="pageChange"></TableNav>
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
import TableRow from "../../table/TableRow.vue";
import TableCell from "../../table/TableCell.vue";
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
        TableCell,
        TableRow,
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
        const editFlightFormRefs = {};

        const fetchData = () => {
            getRequest(flightEndpoints.get() + `?page=${state.page}`)
                .then((data) => {
                    state.flightsData = data;
                    state.flightsData.data.forEach((flight) => {
                        editFlightFormRefs[`editFlightFormRef-${flight.id}`] =
                            ref(null);
                    });
                })
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

        const submitEditHandle = (id) => {
            // console.log(id);
            // console.log(Object.keys(editFlightFormRefs));
            console.log(editFlightFormRefs[`editFlightFormRef-${id}`]);
            console.log(editFlightFormRefs[`editFlightFormRef-${id}`]?.value);
            editFlightFormRefs[`editFlightFormRef-${id}`].value?.submitForm();
        };

        return {
            state,
            flightRows,
            deleteFlight,
            pageChange,
            editFlightSuccess,
            addFlightSuccess,
            addFlightFormRef,
            editFlightFormRef,
            submitAddHandle,
            submitEditHandle,
            addModal,
            flightEndpoints,
            editModal,
            formatDate,
            editFlightFormRefs,
        };
    },
};
</script>
