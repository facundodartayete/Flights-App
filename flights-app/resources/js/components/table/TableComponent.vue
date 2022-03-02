<template>
    <div class="flex flex-col">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                    <table class="min-w-full">
                        <thead class="bg-slate-100 border-b">
                            <tr>
                                <th
                                    v-for="column in columns"
                                    :key="column"
                                    scope="col"
                                    class="text-sm font-bold text-gray-900 px-6 py-4 text-left"
                                >
                                    {{ column }}
                                </th>
                                <th
                                    v-if="showEdit"
                                    scope="col"
                                    class="text-sm font-bold text-gray-900 px-6 py-4 text-left"
                                ></th>
                                <th
                                    v-if="showDelete"
                                    scope="col"
                                    class="text-sm font-bold text-gray-900 px-6 py-4 text-left"
                                ></th>
                            </tr>
                        </thead>
                        <tbody>
                            <TableRow
                                v-for="(item, index) in items"
                                :key="index"
                                :item="item"
                                :showEdit="showEdit"
                                :showDelete="showDelete"
                                @edit="editHandle"
                                @delete="deleteHandle"
                            ></TableRow>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
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
        const editHandle = (item) => context.emit("edit", item);
        const deleteHandle = (item) => context.emit("delete", item);
        return { editHandle, deleteHandle };
    },
};
</script>
