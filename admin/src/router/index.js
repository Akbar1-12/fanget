import { createRouter, createWebHistory } from "vue-router";

import LoginPage from "@/pages/auth/LoginPage.vue";
import DashboardPage from "@/pages/dashboard/DashboardPage.vue";

import { useAuthStore } from "@/stores/auth";

const Placeholder = {
    template: "<div style='color:white;padding:20px'>Coming Soon Page</div>",
};

const router = createRouter({
    history: createWebHistory(),

    routes: [
        {
            path: "/",
            name: "login",
            component: LoginPage,
            meta: { guest: true },
        },

        {
            path: "/dashboard",
            name: "dashboard",
            component: DashboardPage,
            meta: { requiresAuth: true },
        },

        // existing pages
        { path: "/artist", component: Placeholder, meta: { requiresAuth: true } },
        { path: "/platforms", component: Placeholder, meta: { requiresAuth: true } },
        { path: "/messages", component: Placeholder, meta: { requiresAuth: true } },

        // 🔥 NEW MISSING ROUTES (FIX YOUR ERROR)
        { path: "/video", component: Placeholder, meta: { requiresAuth: true } },
        { path: "/subscribers", component: Placeholder, meta: { requiresAuth: true } },
        { path: "/analytics", component: Placeholder, meta: { requiresAuth: true } },
        { path: "/settings", component: Placeholder, meta: { requiresAuth: true } },
    ],
});

router.beforeEach((to) => {
    const auth = useAuthStore();
    const isLoggedIn = !!auth.token;

    if (to.meta.requiresAuth && !isLoggedIn) {
        return "/";
    }

    if (to.meta.guest && isLoggedIn) {
        return "/dashboard";
    }
});

export default router;
