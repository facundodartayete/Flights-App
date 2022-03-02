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
import { computed, ref, onMounted } from "vue";

export default {
    components: { Datepicker },
    props: ["name", "start", "end", "options"],
    setup(props, context) {
        const { start, end } = props;
        const date = ref();

        onMounted(() => {
            const startDate = start || "";
            const endDate = end || "";
            date.value = ["", ""];
        });

        const valueUpdated = (newDate) => {
            context.emit("update", newDate);
        };

        return {
            date,
            valueUpdated,
        };
    },
};
</script>
