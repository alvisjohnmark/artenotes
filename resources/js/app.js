import "./bootstrap";
import "../css/app.css";
import 'vue3-toastify/dist/index.css';
import Vue3Toastify, { toast } from 'vue3-toastify';
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

router.afterEach((to) => {
    if (window.gtag) {
        window.gtag('config', 'G-J8KXJ8PZ52', {
            page_path: to.fullPath,
        });
    }
});


app.use(Vue3Toastify);
app.use(pinia);
app.use(router);
app.mount("#app");
