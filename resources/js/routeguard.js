import { authStore } from "./Pages/Auth/AuthStore/authClient";
import { adminStore } from "./Pages/Auth/AuthStore/authAdmin";

export function clientRouteGuard(to, from, next) {
    const clientAuth = authStore();
    if (!clientAuth.token) {
        next("/login");
    } else {
        next();
    }
}

export function adminRouteGuard(to, from, next) {
    const admin = adminStore();
    if (!admin.token) {
        next("/supersecretloginpagehehe");
    } else {
        next();
    }
}
