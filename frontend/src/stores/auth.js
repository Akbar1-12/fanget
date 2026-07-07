import { defineStore } from "pinia";
import authService from "@/services/authService";

export const useAuthStore = defineStore("auth", {
  state: () => ({
    user: null,
    token: localStorage.getItem("token"),
    loading: false,
  }),

  getters: {
    authenticated: (state) => !!state.token,
    approved: (state) => state.user?.is_approved ?? false,
  },

  actions: {
    async login(credentials) {
      this.loading = true;
      try {
        const { data } = await authService.login(credentials);
        this.token = data.token;
        localStorage.setItem("token", data.token);
        await this.me();
        return data;
      } catch (error) {
        if (error.response) {
          return Promise.reject(error.response);
        }
        return Promise.reject(error);
      } finally {
        this.loading = false;
      }
    },

    async register(payload) {
      return await authService.register(payload);
    },

    async me() {
      const { data } = await authService.me();
      this.user = data.user;
    },

    async logout() {
      try {
        await authService.logout();
      } catch (e) {
        // ignore logout errors
      }
      this.user = null;
      this.token = null;
      localStorage.removeItem("token");
    },
  },
});