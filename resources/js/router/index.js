import { createRouter, createWebHistory } from "vue-router";
import Home from "../pages/Home.vue";

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes: [
        {
            path: "/",
            name: "Home",
            component: Home,
        },

        {
            path: "/register",
            name: "Register",
            component: () => import("../pages/Register.vue"),
            meta: {
                requiresAuth: false,
            },
        },
        {
            path: "/login",
            name: "Login",
            component: () => import("../pages/Login.vue"),
            meta: {
                requiresAuth: false,
            },
        },

        {
            path: "/dashboard",
            name: "Dashboard",
            component: () => import("../pages/Dashboard.vue"),
            meta: {
                requiresAuth: true,
            },
        },

        {
            path: "/task/create",
            name: "CreateTask",
            component: () => import("../pages/CreateTask.vue"),
            meta: {
                requiresAuth: true,
            },
        },
        {
            path: "/task/:id/edit",
            name: "EditTask",
            component: () => import("../pages/EditTask.vue"),
            props: true,
            meta: {
                requiresAuth: true,
            },
        },
    ],
});
router.beforeEach((to, from) => {
    if (to.meta.requiresAuth && !localStorage.getItem("token")) {
        return { name: "Login" };
    }
    if (to.meta.requiresAuth == false && localStorage.getItem("token")) {
        return { name: "Dashboard" };
    }
});

export default router;
