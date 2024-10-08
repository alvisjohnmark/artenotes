import LandingPage from "./Pages/LandingPage.vue";
import test from "./Pages/test.vue";
export const routes = [
    {
        path: "/",
        component: LandingPage,
        name: "Landing Page",
    },
    {
        path: "/test",
        component: test,
        name: "test",
    }
];
