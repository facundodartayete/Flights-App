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
            <VueMultiselect
                v-model="value"
                :track-by="trackby"
                :label="label"
                :options="options"
                :searchable="false"
                :allow-empty="false"
                @select="valueSelected"
                placeholder="Select one"
            >
            </VueMultiselect>
        </div>
    </div>
</template>

<script>
import VueMultiselect from "vue-multiselect";
import { computed} from "vue";

export default {
    components: { VueMultiselect },
    props: ["name", "value", "options", "trackby", "label"],
    setup(props, context) {
        const valueSelected = (value) => context.emit("select", value);

        return { valueSelected };
    },
};
</script>

<style src="vue-multiselect/dist/vue-multiselect.css"></style>
