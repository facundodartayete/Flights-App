<template>
    <tr
        class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100"
    >
        <slot></slot>
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
