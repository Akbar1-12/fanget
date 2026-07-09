import { defineStore } from "pinia";

export const useAuthStore = defineStore("auth", {
    state: () => ({
        /*
        |--------------------------------------------------------------------------
        | Artist
        |--------------------------------------------------------------------------
        */

        token: localStorage.getItem("token") || null,

        user: JSON.parse(localStorage.getItem("user") || "null"),

        /*
        |--------------------------------------------------------------------------
        | Admin
        |--------------------------------------------------------------------------
        */

        adminToken: localStorage.getItem("adminToken") || null,

        admin: JSON.parse(localStorage.getItem("admin") || "null"),
    }),

    getters: {
        authenticated: (state) => !!state.token,

        adminAuthenticated: (state) => !!state.adminToken,
    },

    actions: {
        /*
        |--------------------------------------------------------------------------
        | Artist Login
        |--------------------------------------------------------------------------
        */

        login(token, user) {
            this.token = token;
            this.user = user;

            localStorage.setItem("token", token);
            localStorage.setItem("user", JSON.stringify(user));
        },

        logout() {
            this.token = null;
            this.user = null;

            localStorage.removeItem("token");
            localStorage.removeItem("user");
        },

        /*
        |--------------------------------------------------------------------------
        | Admin Login
        |--------------------------------------------------------------------------
        */

        adminLogin(token, admin) {
            this.adminToken = token;
            this.admin = admin;

            localStorage.setItem("adminToken", token);
            localStorage.setItem("admin", JSON.stringify(admin));
        },

        adminLogout() {
            this.adminToken = null;
            this.admin = null;

            localStorage.removeItem("adminToken");
            localStorage.removeItem("admin");
        },

        /*
        |--------------------------------------------------------------------------
        | Clear Everything
        |--------------------------------------------------------------------------
        */

        clearAll() {
            this.logout();
            this.adminLogout();
        },
    },
});
