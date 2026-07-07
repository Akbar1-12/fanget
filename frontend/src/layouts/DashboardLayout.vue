<template>
  <div class="flex min-h-screen bg-[#09090B] text-white">
    <Sidebar />
    <MobileSidebar />

    <div class="flex-1 flex flex-col lg:ml-72">
      <Topbar />

      <main class="flex-1 p-6 lg:p-10">
        <router-view />
      </main>
    </div>
  </div>
</template>

<script setup>
import Sidebar from "@/components/dashboard/Sidebar.vue";
import Topbar from "@/components/dashboard/Topbar.vue";
import MobileSidebar from "@/components/dashboard/MobileSidebar.vue";
</script>