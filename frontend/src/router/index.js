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
  },

  {
    path: "/register",
    name: "register",
    component: Register,
  },

  {
    path: "/await-approval",
    name: "await-approval",
    component: AwaitApproval,
  },

  /*
  |--------------------------------------------------------------------------
  | Dashboard
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

    const protectedRoutes = [

        "dashboard",
        "campaigns",
        "campaign-create",
        "campaign-edit",
        "subscribers",
        "analytics",
        "settings",

    ];

    if (
        protectedRoutes.includes(to.name) &&
        !auth.authenticated
    ) {

        return "/login";

    }

});

export default router;