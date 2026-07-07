<template>
  <div
    class="group flex w-full items-center justify-between rounded-2xl border border-white/10 bg-white/5 px-4 py-4 backdrop-blur-xl transition-all duration-300 hover:-translate-y-1 hover:border-green-400/30 hover:bg-white/10 sm:px-5 sm:py-5"
  >
    <div class="flex min-w-0 items-center gap-4 sm:gap-5">
      <img
        v-if="platform.logo"
        :src="platform.logo"
        :alt="platform.name"
        class="h-12 w-12 shrink-0 object-contain"
      />

      <div class="min-w-0">
        <h3 class="truncate text-base font-bold text-white sm:text-lg">
          {{ platform.name }}
        </h3>
      </div>
    </div>

    <button
      class="ml-4 flex h-10 w-28 shrink-0 items-center justify-center rounded-full bg-green-500 text-center text-xs font-bold uppercase tracking-wide text-black transition-all duration-300 hover:scale-105 hover:bg-green-400 sm:w-32"
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