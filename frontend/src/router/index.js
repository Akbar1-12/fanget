import { createRouter, createWebHistory } from "vue-router";

import Home from "../pages/Home.vue";

import CampaignPage from "../pages/public/CampaignPage.vue";

import Register from "../pages/auth/Register.vue";
import Login from "../pages/auth/Login.vue";
import AwaitApproval from "../pages/auth/AwaitApproval.vue";

import Dashboard from "../pages/dashboard/Dashboard.vue";
import Campaigns from "../pages/dashboard/Campaigns.vue";
import CreateCampaign from "../pages/dashboard/CreateCampaign.vue";
import Subscribers from "../pages/dashboard/Subscribers.vue";
import Settings from "../pages/dashboard/Settings.vue";

const router = createRouter({
    history: createWebHistory(),

    routes: [

        {
            path: "/",
            name: "home",
            component: Home,
        },

        {
            path: "/register",
            component: Register,
        },

        {
            path: "/login",
            component: Login,
        },

        {
            path: "/await-approval",
            component: AwaitApproval,
        },

        {
            path: "/dashboard",
            component: Dashboard,
        },

        {
            path: "/dashboard/campaigns",
            component: Campaigns,
        },

        {
            path: "/dashboard/create",
            component: CreateCampaign,
        },

        {
            path: "/dashboard/subscribers",
            component: Subscribers,
        },

        {
            path: "/dashboard/settings",
            component: Settings,
        },

        // MUST STAY LAST
        {
            path: "/:slug",
            name: "campaign",
            component: CampaignPage,
            props: true,
        },

        {
            path: "/:pathMatch(.*)*",
            redirect: "/",
        },

    ],
});

export default router;