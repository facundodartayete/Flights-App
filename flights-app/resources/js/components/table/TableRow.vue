<template>
    <tr
        class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100"
    >
        <td
            v-for="(cell, index) in item"
            :key="index"
            class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap"
        >
            {{ cell }}
        </td>
        <td
            v-if="showEdit"
            @click="$emit('edit', item)"
            class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap text-indigo-600 font-bold cursor-pointer"
        >
            Edit
        </td>
        <td
            v-if="showDelete"
            @click="$emit('delete', item)"
            class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap text-red-600 font-bold cursor-pointer"
        >
            Delete
        </td>
    </tr>
</template>

<script>
import { reactive, onMounted } from "vue";
export default {
    props: ["item", "showEdit", "showDelete"],

    setup() {
        return {};
    },
};
</script>
