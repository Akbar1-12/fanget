<template>
  <header
    class="sticky top-0 z-30 border-b border-white/10 bg-[#09090B]/80 backdrop-blur-xl"
  >
    <div class="flex items-center justify-between px-6 py-5">
      <!-- Mobile sidebar toggle -->
      <button
        class="mr-4 lg:hidden"
        @click="ui.toggleSidebar"
      >
        <Menu class="h-7 w-7 text-white" />
      </button>

      <div>
        <h2 class="text-2xl font-bold">
          Welcome Back 👋
        </h2>
        <p class="text-sm text-white/50">
          Manage your music campaigns
        </p>
      </div>

      <div
        class="flex h-11 w-11 items-center justify-center rounded-full bg-green-500 text-lg font-bold text-black"
      >
        V
      </div>
    </div>
  </header>
</template>

<script setup>
import { Menu } from "lucide-vue-next";
import { useUIStore } from "@/stores/ui";

const ui = useUIStore();
</script>