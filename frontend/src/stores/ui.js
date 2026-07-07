import { defineStore } from "pinia";

export const useUIStore = defineStore("ui", {
    state: () => ({
        sidebarOpen: false,
    }),

    actions: {
        openSidebar() {
            this.sidebarOpen = true;
            document.body.style.overflow = "hidden";
        },

        closeSidebar() {
            this.sidebarOpen = false;
            document.body.style.overflow = "";
        },

        toggleSidebar() {
            this.sidebarOpen
                ? this.closeSidebar()
                : this.openSidebar();
        },
    },
});