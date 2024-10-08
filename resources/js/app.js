import "./bootstrap";
import "../css/app.css";
import { createApp, markRaw } from "vue/dist/vue.esm-bundler.js";
import { createRouter, createWebHistory, useRoute } from "vue-router";
import { createPinia } from "pinia";
import { routes } from "./router";

const app = createApp({});
const pinia = createPinia();
const router = createRouter({
    history: createWebHistory(),
    routes: routes,
});

pinia.use(({ store }) => {
    store.router = markRaw(router);
    store.route = markRaw(useRoute());
});

app.use(pinia);
app.use(router);
app.mount("#app");
