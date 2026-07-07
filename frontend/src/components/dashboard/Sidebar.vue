<template>
  <aside
    :class="[
      'w-72 flex-col border-r border-white/10 bg-[#09090B]',
      props.mobile ? 'flex h-screen' : 'hidden lg:flex'
    ]"
  >
    <div class="border-b border-white/10 p-8">
      <h1 class="text-3xl font-black text-green-400">
        Fanget
      </h1>
      <p class="mt-2 text-sm text-white/40">
        Artist Portal
      </p>
    </div>

    <RouterLink
      to="/dashboard/campaigns/create"
      class="mb-5 block rounded-xl bg-green-500 px-5 py-3 text-center font-semibold text-black transition hover:bg-green-400"
      @click="ui.closeSidebar"
    >
      + Create Campaign
    </RouterLink>

    <nav class="flex-1 space-y-2 p-5">
      <RouterLink
        to="/dashboard"
        class="block rounded-xl px-4 py-3 text-white/70 transition hover:bg-white/5 hover:text-white"
        @click="ui.closeSidebar"
      >
        Overview
      </RouterLink>

      <RouterLink
        to="/dashboard/campaigns"
        class="block rounded-xl px-4 py-3 text-white/70 transition hover:bg-white/5 hover:text-white"
        @click="ui.closeSidebar"
      >
        Campaigns
      </RouterLink>

      <RouterLink
        to="/dashboard/subscribers"
        class="block rounded-xl px-4 py-3 text-white/70 transition hover:bg-white/5 hover:text-white"
        @click="ui.closeSidebar"
      >
        Subscribers
      </RouterLink>

      <RouterLink
        to="/dashboard/analytics"
        class="block rounded-xl px-4 py-3 text-white/70 transition hover:bg-white/5 hover:text-white"
        @click="ui.closeSidebar"
      >
        Analytics
      </RouterLink>

      <RouterLink
        to="/dashboard/settings"
        class="block rounded-xl px-4 py-3 text-white/70 transition hover:bg-white/5 hover:text-white"
        @click="ui.closeSidebar"
      >
        Settings
      </RouterLink>
    </nav>

    <div class="border-t border-white/10 p-5">
      <button
        class="w-full rounded-xl bg-red-500 py-3 font-semibold transition hover:bg-red-600"
        @click="logout"
      >
        Logout
      </button>
    </div>
  </aside>
</template>

<script setup>
import { useRouter } from "vue-router";
import { useAuthStore } from "@/stores/auth";
import { useUIStore } from "@/stores/ui";

const router = useRouter();
const auth = useAuthStore();
const ui = useUIStore();

const props = defineProps({
  mobile: {
    type: Boolean,
    default: false,
  },
});

async function logout() {
  await auth.logout();
  ui.closeSidebar();
  router.push("/login");
}
</script>