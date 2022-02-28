<template>
    <table class="table-auto">
        <thead>
            <tr>
                <th v-for="column in columns" :key="`$index`">
                    {{ column }}
                </th>
                <th v-if="showEdit">Edit</th>
                <th v-if="showDelete">Delete</th>
            </tr>
        </thead>
        <tbody>
            <table-row
                v-for="item in items"
                :key="`$index`"
                :item="item"
                :showEdit="showEdit"
                :showDelete="showDelete"
                @edit="editHandle"
                @delete="deleteHandle"
            ></table-row>
        </tbody>
    </table>
</template>

<script>
import { reactive } from "vue";
import TableRow from "./TableRow";

export default {
    components: {
        TableRow,
    },
    props: ["columns", "items", "showEdit", "showDelete"],
    setup(props, context) {
        const editHandle = (id) => context.emit("edit", id);
        const deleteHandle = (id) => context.emit("delete", id);
        return { editHandle, deleteHandle };
    },
};
</script>
