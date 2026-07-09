import { createRouter, createWebHistory } from "vue-router";
import { useAuthStore } from "@/stores/auth";

/*
|--------------------------------------------------------------------------
| Public Pages
|--------------------------------------------------------------------------
*/

import Home from "@/pages/Home.vue";
import CampaignPage from "@/pages/public/CampaignPage.vue";

import Login from "@/pages/auth/Login.vue";
import Register from "@/pages/auth/Register.vue";
import AwaitApproval from "@/pages/auth/AwaitApproval.vue";
import ForgotPassword from "@/pages/auth/ForgotPassword.vue";
import ResetPassword from "@/pages/auth/ResetPassword.vue";
import VerifyEmail from "@/pages/auth/VerifyEmail.vue";

/*
|--------------------------------------------------------------------------
| Dashboard
|--------------------------------------------------------------------------
*/

import DashboardLayout from "@/layouts/DashboardLayout.vue";

import Overview from "@/pages/dashboard/Overview.vue";
import Campaigns from "@/pages/dashboard/Campaigns.vue";
import CampaignBuilder from "@/pages/dashboard/CampaignBuilder.vue";
import Subscribers from "@/pages/dashboard/Subscribers.vue";
import Analytics from "@/pages/dashboard/Analytics.vue";
import Settings from "@/pages/dashboard/Settings.vue";
import CampaignSuccess from "@/pages/dashboard/CampaignSuccess.vue";

/*
|--------------------------------------------------------------------------
| Misc
|--------------------------------------------------------------------------
*/

import NotFound from "@/pages/NotFound.vue";

const routes = [
    /*
    |--------------------------------------------------------------------------
    | Public Website
    |--------------------------------------------------------------------------
    */

    {
        path: "/",
        name: "home",
        component: Home,
    },

    {
        path: "/campaign/:slug",
        name: "campaign",
        component: CampaignPage,
        props: true,
    },

    /*
    |--------------------------------------------------------------------------
    | Authentication
    |--------------------------------------------------------------------------
    */

    {
        path: "/login",
        name: "login",
        component: Login,
        meta: {
            guest: true,
        },
    },

    {
        path: "/register",
        name: "register",
        component: Register,
        meta: {
            guest: true,
        },
    },

    {
        path: "/await-approval",
        name: "await-approval",
        component: AwaitApproval,
    },

    {
        path: "/verify-email",
        name: "verify-email",
        component: VerifyEmail,
    },

    /*
    |--------------------------------------------------------------------------
    | Password Reset
    |--------------------------------------------------------------------------
    */

    {
        path: "/forgot-password",
        name: "forgot-password",
        component: ForgotPassword,
        meta: {
            guest: true,
        },
    },

    {
        path: "/reset-password",
        name: "reset-password",
        component: ResetPassword,
        meta: {
            guest: true,
        },
    },

    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */

    {
        path: "/dashboard",
        component: DashboardLayout,
        meta: {
            requiresAuth: true,
        },

        children: [
            {
                path: "",
                name: "dashboard",
                component: Overview,
            },

            {
                path: "campaigns",
                name: "campaigns",
                component: Campaigns,
            },

            {
                path: "campaigns/create",
                name: "campaign-create",
                component: CampaignBuilder,
            },

            {
                path: "campaigns/:id/edit",
                name: "campaign-edit",
                component: CampaignBuilder,
                props: true,
            },

            {
                path: "subscribers",
                name: "subscribers",
                component: Subscribers,
            },

            {
                path: "analytics",
                name: "analytics",
                component: Analytics,
            },

            {
                path: "settings",
                name: "settings",
                component: Settings,
            },

            {
                path: "campaign-success",
                name: "campaign-success",
                component: CampaignSuccess,
            },
        ],
    },

    /*
    |--------------------------------------------------------------------------
    | 404
    |--------------------------------------------------------------------------
    */

    {
        path: "/:pathMatch(.*)*",
        component: NotFound,
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach(async (to) => {
    const auth = useAuthStore();

    // Restore auth from localStorage if page refreshed
    if (!auth.user && localStorage.getItem("token")) {
        try {
            await auth.fetchUser();
        } catch (e) {
            auth.logout();
        }
    }

    // Guest pages
    if (to.meta.guest && auth.authenticated) {
        return "/dashboard";
    }

    // Protected pages
    if (to.meta.requiresAuth && !auth.authenticated) {
        return "/login";
    }

    return true;
});

export default router;