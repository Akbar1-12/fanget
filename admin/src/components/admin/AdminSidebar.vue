<template>
  <aside
    class="flex w-72 flex-col border-r border-zinc-800 bg-zinc-900"
  >
    <!-- Logo -->
    <div
      class="flex h-20 items-center justify-center border-b border-zinc-800"
    >
      <h1 class="text-2xl font-bold tracking-wider">
        FANGET
      </h1>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 space-y-2 p-5">
      <RouterLink
        :to="{ name: 'admin-dashboard' }"
        class="block rounded-xl px-4 py-3 transition hover:bg-zinc-800"
      >
        Dashboard
      </RouterLink>

      <RouterLink
        :to="{ name: 'admin-artists' }"
        class="block rounded-xl px-4 py-3 transition hover:bg-zinc-800"
      >
        Artists
      </RouterLink>

      <RouterLink
        :to="{ name: 'admin-campaigns' }"
        class="block rounded-xl px-4 py-3 transition hover:bg-zinc-800"
      >
        Campaigns
      </RouterLink>

      <RouterLink
        :to="{ name: 'admin-platforms' }"
        class="block rounded-xl px-4 py-3 transition hover:bg-zinc-800"
      >
        Platforms
      </RouterLink>

      <RouterLink
        :to="{ name: 'admin-analytics' }"
        class="block rounded-xl px-4 py-3 transition hover:bg-zinc-800"
      >
        Analytics
      </RouterLink>

      <RouterLink
        :to="{ name: 'admin-settings' }"
        class="block rounded-xl px-4 py-3 transition hover:bg-zinc-800"
      >
        Settings
      </RouterLink>
    </nav>
  </aside>
</template>

<script setup>
</script>
