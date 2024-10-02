import "./bootstrap";

import { createApp } from "vue";
import router from "./router";
import { library } from "@fortawesome/fontawesome-svg-core";
import { fas } from "@fortawesome/free-solid-svg-icons";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";

import VueSweetalert2 from "vue-sweetalert2";
import "sweetalert2/dist/sweetalert2.min.css";

library.add(fas);

import App from "./components/app.vue";

const app = createApp(App);

app.use(router);
app.use(VueSweetalert2);
app.component("fa", FontAwesomeIcon);
// app.component('pagination', Pagination)
app.mount("#app");
