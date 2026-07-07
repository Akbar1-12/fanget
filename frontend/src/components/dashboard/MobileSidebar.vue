<template>
    <Transition
        enter-active-class="transition duration-300"
        enter-from-class="opacity-0"
        enter-to-class="opacity-100"
        leave-active-class="transition duration-300"
        leave-from-class="opacity-100"
        leave-to-class="opacity-0"
    >
        <div
            v-if="ui.sidebarOpen"
            class="fixed inset-0 z-40 bg-black/70 lg:hidden"
            @click="ui.closeSidebar"
        />
    </Transition>

    <Transition
        enter-active-class="transition duration-300"
        enter-from-class="-translate-x-full"
        enter-to-class="translate-x-0"
        leave-active-class="transition duration-300"
        leave-from-class="translate-x-0"
        leave-to-class="-translate-x-full"
    >
        <aside
            v-if="ui.sidebarOpen"
            class="fixed left-0 top-0 z-50 h-screen w-72 bg-[#0E0E11] border-r border-white/10 lg:hidden"
        >
            <Sidebar :mobile="true" />
        </aside>
    </Transition>
</template>

<script setup>
import Sidebar from "./Sidebar.vue";
import { useUIStore } from "@/stores/ui";

const ui = useUIStore();
</script>