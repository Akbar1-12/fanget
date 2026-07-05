<template>
  <div class="flex bg-slate-950">
    <Sidebar />

    <div class="flex min-h-screen flex-1 flex-col">
      <Topbar />

      <main class="flex-1 p-8">
        <slot />
      </main>

    </div>
  </div>
</template>

<script setup>
import Sidebar from "@/components/layout/Sidebar.vue"
import Topbar from "@/components/layout/Topbar.vue"
</script>
