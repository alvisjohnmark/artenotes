import LandingPage from "./Pages/LandingPage.vue";
import About from "./Pages/About.vue";
import Products from "./Pages/Products.vue";
import Services from "./Pages/Services.vue";
import Register from "./Pages/Auth/Register.vue";
import Login from "./Pages/Auth/Login.vue";
import Cart from "./Pages/Cart.vue";
export const routes = [
    {
        path: "/",
        component: LandingPage,
        name: "Landing Page",
    },
    {
        path: "/about",
        component: About,
        name: "About",
    },
    {
        path: "/products",
        component: Products,
        name: "Products",
    },
    {
        path: "/services",
        component: Services,
        name: "Services",
    },
    {
        path: "/register",
        component: Register,
        name: "Register",
    },
    {
        path: "/login",
        component: Login,
        name: "Login",
    },
    {
        path: "/cart",
        component: Cart,
        name: "Cart",
    }
];
