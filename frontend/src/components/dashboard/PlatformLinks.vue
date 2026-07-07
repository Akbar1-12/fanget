<template>
  <div class="space-y-4">

    <h2 class="text-xl font-semibold text-white">
      Streaming Platforms
    </h2>

    <div
      v-for="platform in platforms"
      :key="platform.id"
      class="rounded-xl border border-zinc-700 p-4"
    >
      <label class="block mb-2 text-sm text-gray-300">
        {{ platform.name }}
      </label>

      <input
        v-model="platform.destination_url"
        type="url"
        class="w-full rounded-lg bg-zinc-900 border border-zinc-700 px-4 py-3 text-white"
        :placeholder="`Paste your ${platform.name} link`"
      >
    </div>

  </div>
</template>

<script setup>
defineProps({
    platforms: {
        type: Array,
        required: true,
    },
});
</script>