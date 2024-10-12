import { authStore } from "./Pages/Auth/AuthStore/authClient";


export function clientRouteGuard(to, from, next) {
    const clientAuth = authStore();
    if (!clientAuth.token) {
        next("/login");
    } else {
        next();
    }
}
