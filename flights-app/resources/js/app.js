require("./bootstrap");

import { createApp } from "vue";
import Flights from "./components/views/flights/Flights";
import Toast from "vue-toastification";
import "vue-toastification/dist/index.css";

const app = createApp({
    components: {
        Flights,
    },
});


app.use(Toast, {
    position: "top-right",
    timeout: 3000,
    closeOnClick: true,
    pauseOnFocusLoss: true,
    pauseOnHover: false,
    draggable: false,
    showCloseButtonOnHover: false,
    hideProgressBar: false,
    closeButton: "button",
    icon: true,
    rtl: false,
});

app.mount("#app");
