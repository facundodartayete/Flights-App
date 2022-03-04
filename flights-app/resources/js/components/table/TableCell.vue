<template>
    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
        <slot>{{ text }}</slot>
    </td>
</template>

<script>
import { reactive, onMounted } from "vue";
export default {
    props: {
        text: {
            default: "",
        },
    },

    setup() {
        return {};
    },
};
</script>
