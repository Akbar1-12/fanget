import { defineStore } from "pinia";

export const useAuthStore = defineStore("auth", {
    state: () => ({
        token: null,
        admin: null,
    }),

    actions: {
        login(token, admin) {
            this.token = token;
            this.admin = admin;

            localStorage.setItem("token", token);
            localStorage.setItem("admin", JSON.stringify(admin));
        },

        hydrate() {
            this.token = localStorage.getItem("token");
            this.admin = JSON.parse(localStorage.getItem("admin"));
        },

        logout() {
            this.token = null;
            this.admin = null;

            localStorage.removeItem("token");
            localStorage.removeItem("admin");
        },
    },
});
