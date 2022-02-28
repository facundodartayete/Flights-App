<template>
    <nav
        v-if="data?.links?.length"
        role="navigation"
        aria-label="Pagination Navigation"
        class="flex items-center justify-between"
    >
        <div class="flex justify-between flex-1 sm:hidden">
            <span
                class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 rounded-md"
            >
                « Previous </span
            ><a
                href="http://localhost/cities?page=2"
                class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150"
            >
                Next »
            </a>
        </div>
        <div
            class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between"
        >
            <div>
                <p class="text-sm text-gray-700 leading-5">
                    Showing <span class="font-medium">{{ data.from }}</span> to
                    <span class="font-medium">{{ data.to }}</span> of
                    <span class="font-medium">{{ data.total }}</span> results
                </p>
            </div>
            <div>
                <span class="relative z-0 inline-flex shadow-sm rounded-md">
                    <span
                        @click="changePage(Math.max(data.current_page - 1, 1))"
                        class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-l-md leading-5 hover:text-gray-400 focus:z-10 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150"
                        aria-label="&amp;laquo; Previous"
                        ><svg
                            class="w-5 h-5"
                            fill="currentColor"
                            viewBox="0 0 20 20"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                clip-rule="evenodd"
                            ></path></svg
                    ></span>

                    <template v-for="link in data.links">
                        <span
                            v-if="!isNaN(link.label)"
                            @click="changePage(+link.label)"
                            class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 hover:text-gray-500 focus:z-10 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150"
                            :aria-label="`Go to page ${link.label}`"
                        >
                            {{ link.label }}
                        </span>
                    </template>

                    <span
                        @click="
                            changePage(
                                Math.min(data.current_page + 1, data.last_page)
                            )
                        "
                        class="relative inline-flex items-center px-2 py-2 -ml-px text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-r-md leading-5 hover:text-gray-400 focus:z-10 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150"
                        aria-label="Next &amp;raquo;"
                        ><svg
                            class="w-5 h-5"
                            fill="currentColor"
                            viewBox="0 0 20 20"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd"
                            ></path></svg></span
                ></span>
            </div>
        </div>
    </nav>
</template>

<script>
import { reactive, defineEmits } from "vue";
export default {
    props: ["data"],

    setup(props, context) {
        const changePage = (page) => {
            const { data } = props;
            if (page != data.current_page) context.emit("page-change", page);
        };

        return { changePage };
    },
};
</script>
