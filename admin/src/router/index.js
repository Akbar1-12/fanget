import { createRouter, createWebHistory } from "vue-router";
import { useAuthStore } from "@/stores/auth";

/*
|--------------------------------------------------------------------------
| Public Pages
|--------------------------------------------------------------------------
*/

import Home from "@/pages/Home.vue";
import CampaignPage from "@/pages/public/CampaignPage.vue";

/*
|--------------------------------------------------------------------------
| Artist Authentication
|--------------------------------------------------------------------------
*/

import Login from "@/pages/auth/Login.vue";
import Register from "@/pages/auth/Register.vue";
import AwaitApproval from "@/pages/auth/AwaitApproval.vue";
import ForgotPassword from "@/pages/auth/ForgotPassword.vue";
import ResetPassword from "@/pages/auth/ResetPassword.vue";
import VerifyEmail from "@/pages/auth/VerifyEmail.vue";

/*
|--------------------------------------------------------------------------
| Artist Dashboard
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
| Admin
|--------------------------------------------------------------------------
*/

import AdminLayout from "@/layouts/AdminLayout.vue";
import AdminDashboard from "@/pages/admin/AdminDashboard.vue";
import AdminArtists from "@/pages/admin/AdminArtists.vue";
import AdminCampaigns from "@/pages/admin/AdminCampaigns.vue";
import AdminPlatforms from "@/pages/admin/AdminPlatforms.vue";
import AdminAnalytics from "@/pages/admin/AdminAnalytics.vue";
import AdminSettings from "@/pages/admin/AdminSettings.vue";
import AdminLogin from "@/pages/admin/AdminLogin.vue";

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
    | Artist Authentication
    |--------------------------------------------------------------------------
    */

    {
        path: "/login",
        name: "login",
        component: Login,
    },

    {
        path: "/register",
        name: "register",
        component: Register,
    },

    {
        path: "/verify-email",
        name: "verify-email",
        component: VerifyEmail,
    },

    {
        path: "/await-approval",
        name: "await-approval",
        component: AwaitApproval,
    },

    {
        path: "/forgot-password",
        name: "forgot-password",
        component: ForgotPassword,
    },

    {
        path: "/reset-password",
        name: "reset-password",
        component: ResetPassword,
    },

    /*
    |--------------------------------------------------------------------------
    | Admin Login (public)
    |--------------------------------------------------------------------------
    */

    {
        path: "/admin/login",
        name: "admin-login",
        component: AdminLogin,
    },

    /*
    |--------------------------------------------------------------------------
    | Artist Dashboard
    |--------------------------------------------------------------------------
    */

    {
        path: "/dashboard",
        component: DashboardLayout,

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
    | Admin
    |--------------------------------------------------------------------------
    */

    {
        path: "/admin",
        component: AdminLayout,

        children: [
            {
                path: "",
                redirect: "/admin/dashboard",
            },

            {
                path: "dashboard",
                name: "admin-dashboard",
                component: AdminDashboard,
            },

            {
                path: "artists",
                name: "admin-artists",
                component: AdminArtists,
            },

            {
                path: "campaigns",
                name: "admin-campaigns",
                component: AdminCampaigns,
            },

            {
                path: "platforms",
                name: "admin-platforms",
                component: AdminPlatforms,
            },

            {
                path: "analytics",
                name: "admin-analytics",
                component: AdminAnalytics,
            },

            {
                path: "settings",
                name: "admin-settings",
                component: AdminSettings,
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

router.beforeEach((to) => {
    const auth = useAuthStore();

    const artistRoutes = [
        "dashboard",
        "campaigns",
        "campaign-create",
        "campaign-edit",
        "subscribers",
        "analytics",
        "settings",
        "campaign-success",
    ];

    const adminRoutes = [
        "admin-dashboard",
        "admin-artists",
        "admin-campaigns",
        "admin-platforms",
        "admin-analytics",
        "admin-settings",
    ];

    if (artistRoutes.includes(to.name) && !auth.authenticated) {
        return "/login";
    }

    if (adminRoutes.includes(to.name) && !auth.adminAuthenticated) {
        return { name: "admin-login" };
    }

    if (to.name === "admin-login" && auth.adminAuthenticated) {
        return { name: "admin-dashboard" };
    }
});

export default router;
