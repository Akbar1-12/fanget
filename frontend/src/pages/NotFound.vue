<template>
  <div class="flex min-h-screen items-center justify-center bg-black px-6">

    <div class="text-center">

      <h1 class="text-7xl font-black text-green-500">
        404
      </h1>

      <h2 class="mt-4 text-3xl font-bold text-white">
        Page Not Found
      </h2>

      <p class="mt-3 text-gray-400">
        The page you're looking for doesn't exist.
      </p>

      <RouterLink
        to="/"
        class="mt-8 inline-flex rounded-xl bg-green-500 px-6 py-3 font-semibold text-black"
      >
        Back Home
      </RouterLink>

    </div>

  </div>
</template>

<script setup>
</script>