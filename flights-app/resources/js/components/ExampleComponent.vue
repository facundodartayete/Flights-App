<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">{{ state.message }}</div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { reactive } from "vue";
export default {

    setup() {
        const state = reactive({ message: "Holaaa" });

        return {
            state,
        };
    },
};
</script>
