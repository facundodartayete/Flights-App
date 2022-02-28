<template>
    <tr>
        <td v-for="cell in item" :key="`$index`">{{ cell }}</td>
        <td v-if="showEdit" @click="$emit('edit', item.id)">Edit</td>
        <td v-if="showDelete" @click="$emit('delete', item.id)">Delete</td>
    </tr>
</template>

<script>
import { reactive, onMounted } from "vue";
export default {
    props: ["item", "showEdit", "showDelete"],

    setup() {
     
        return {  };
    },
};
</script>
