<template>
    <div>
        <label
            :for="name"
            class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300"
            >{{ name }}</label
        >
        <div
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
        >
            <Datepicker
                v-model="date"
                range
                @update:modelValue="valueUpdated"
            />
        </div>
    </div>
</template>

<script>
import Datepicker from "vue3-date-time-picker";
import "vue3-date-time-picker/dist/main.css";
import { computed, ref, onMounted, watch } from "vue";

export default {
    components: { Datepicker },
    props: ["name", "start", "end", "options"],
    setup(props, context) {
        const { start, end } = props;
        const date = ref();

        onMounted(() => {
            const startDate = start || "";
            const endDate = end || "";
            date.value = [startDate, endDate];
        });

        watch(
            () => props.start,
            (newValue) => date.value = [props.start, props.end]
        );
         watch(
            () => props.end,
            (newValue) => date.value = [props.start, props.end]
        );

        const valueUpdated = (newDate) => {
            let [start, end] = newDate;
            start = moment(start).format("YYYY-MM-DD hh:mm:ss");
            end = moment(end).format("YYYY-MM-DD hh:mm:ss");
            context.emit("update", [start, end]);
        };

        return {
            date,
            valueUpdated,
        };
    },
};
</script>
