<template>
  <div
    class="group flex w-full min-w-0 items-center justify-between rounded-2xl border border-white/10 bg-white/5 px-5 py-5 backdrop-blur-xl transition-all duration-300 hover:-translate-y-1 hover:border-green-400/30 hover:bg-white/10"
  >
    <div class="flex min-w-0 items-center gap-5">
      <img
        :src="platform.logo"
        :alt="platform.name"
        class="h-12 w-12 object-contain"
      />

      <div>
        <h3 class="text-lg font-bold text-white">
          {{ platform.name }}
        </h3>
      </div>
    </div>

    <button
      class="ml-4 flex h-10 w-28 shrink-0 items-center justify-center rounded-full bg-green-500 text-xs font-bold uppercase tracking-wide text-black transition-all duration-300 hover:scale-105 hover:bg-green-400"
      @click.stop="$emit('click', platform)"
    >
      {{ platform.action }}
    </button>
  </div>
</template>

<script setup>
defineProps({
  platform: {
    type: Object,
    required: true,
  },
});

defineEmits(["click"]);
</script>