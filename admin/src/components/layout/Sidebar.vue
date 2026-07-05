<template>
  <aside class="flex h-screen w-64 flex-col border-r border-slate-800 bg-slate-900">

    <!-- Logo -->
    <div class="border-b border-slate-800 p-6">
      <h1 class="text-2xl font-bold text-emerald-400">
        Fanget
      </h1>

      <p class="text-sm text-slate-400">
        Admin Dashboard
      </p>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 space-y-2 p-4">

      <RouterLink
        to="/dashboard"
        class="block rounded-lg px-4 py-3 text-slate-300 transition hover:bg-slate-800 hover:text-white"
      >
        Dashboard
      </RouterLink>

      <RouterLink
        to="/artist"
        class="block rounded-lg px-4 py-3 text-slate-300 transition hover:bg-slate-800 hover:text-white"
      >
        Artist Profile
      </RouterLink>

      <RouterLink
        to="/platforms"
        class="block rounded-lg px-4 py-3 text-slate-300 transition hover:bg-slate-800 hover:text-white"
      >
        Music Platforms
      </RouterLink>

      <RouterLink
        to="/video"
        class="block rounded-lg px-4 py-3 text-slate-300 transition hover:bg-slate-800 hover:text-white"
      >
        Hero Video
      </RouterLink>

      <RouterLink
        to="/subscribers"
        class="block rounded-lg px-4 py-3 text-slate-300 transition hover:bg-slate-800 hover:text-white"
      >
        Subscribers
      </RouterLink>

      <RouterLink
        to="/messages"
        class="block rounded-lg px-4 py-3 text-slate-300 transition hover:bg-slate-800 hover:text-white"
      >
        Messages
      </RouterLink>

      <RouterLink
        to="/analytics"
        class="block rounded-lg px-4 py-3 text-slate-300 transition hover:bg-slate-800 hover:text-white"
      >
        Analytics
      </RouterLink>

      <RouterLink
        to="/settings"
        class="block rounded-lg px-4 py-3 text-slate-300 transition hover:bg-slate-800 hover:text-white"
      >
        Settings
      </RouterLink>

    </nav>

  </aside>
</template>

<script>
export default {
  name: 'AppSidebar',
}
</script>
