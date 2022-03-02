<template>
    <div>
       <label :for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{name}}</label>
        <input
            type="text"
            :name="name"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
            required
        />
    </div>
</template>

<script>
import { reactive, onMounted, computed, watch } from "vue";

export default {
    components: {},
    props: ["name"],
    setup(props, context) {

        return {  };
    },
};
</script>
