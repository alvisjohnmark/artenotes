import { clientRouteGuard } from "./routeguard";
import { adminRouteGuard } from "./routeguard";
//client
import LandingPage from "./Pages/LandingPage.vue";
import About from "./Pages/About.vue";
import Products from "./Pages/Products.vue";
import Services from "./Pages/Services.vue";
import Register from "./Pages/Auth/Register.vue";
import Login from "./Pages/Auth/Login.vue";
import Cart from "./Pages/Cart.vue";
import Checkout from "./Pages/Checkout.vue";
import Thankyou from "./Pages/Thankyou.vue";
import NotFound from "./Pages/NotFound.vue";
//admin
import LoginAdmin from "./Pages/Auth/LoginAdmin.vue";
import RegisterAdmin from "./Pages/Auth/RegisterAdmin.vue";
import AdminDashboard from "./Pages/AdminPage/Dashboard.vue";
import AdminServices from "./Pages/AdminPage/Services.vue";
import AdminProducts from "./Pages/AdminPage/Products.vue";
import AdminOrders from "./Pages/AdminPage/Orders.vue";

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
        path: "/:pathMatch(.*)*",
        component: NotFound,
        name: "NotFound",
    },
    {
        path: "/cart",
        component: Cart,
        beforeEnter: clientRouteGuard,
    },
    {
        path: "/checkout",
        component: Checkout,
        beforeEnter: clientRouteGuard,
    },
    {
        path: "/thankyou",
        component: Thankyou,
        beforeEnter: clientRouteGuard,
    },
    {
        path: "/supersecretloginpagehehe",
        component: LoginAdmin,
        name: "Login Admin",
    },
    {
        path: "/supersecretregisterpagehehe",
        component: RegisterAdmin,
        name: "Register Admin",
    },
    {
        path: "/admin/dashboard",
        component: AdminDashboard,
        beforeEnter: adminRouteGuard,
    },
    {
        path: "/admin/products",
        component: AdminProducts,
        beforeEnter: adminRouteGuard,
    },
    {
        path: "/admin/services",
        component: AdminServices,
        beforeEnter: adminRouteGuard,
    },
    {
        path: "/admin/orders",
        component: AdminOrders,
        beforeEnter: adminRouteGuard,
    },
];
