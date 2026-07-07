<template>
  <Transition name="fade">
    <div
      v-if="show"
      class="fixed inset-0 z-50 flex items-center justify-center bg-black/90 backdrop-blur-lg"
    >
      <div class="w-full max-w-sm px-8 text-center">

        <img
          v-if="platform?.icon"
          :src="platform.icon"
          :alt="platform.name"
          class="mx-auto h-24 w-24 animate-bounce object-contain"
        />

        <!-- Fallback Spinner -->
        <div
          v-else
          class="mx-auto h-16 w-16 animate-spin rounded-full border-4 border-green-500 border-t-transparent"
        ></div>

        <h2 class="mt-8 text-2xl font-bold text-white">
          Connecting to {{ platform?.name }}
        </h2>

        <p class="mt-3 text-white/60">
          Please wait while we securely connect your music account...
        </p>

        <div class="mt-10 h-2 overflow-hidden rounded-full bg-white/10">
          <div
            class="h-full w-full animate-pulse rounded-full bg-green-500"
          ></div>
        </div>

      </div>
    </div>
  </Transition>
</template>

<script setup>
defineProps({
  show: {
    type: Boolean,
    default: false,
  },

  platform: {
    type: Object,
    default: () => ({}),
  },
});
</script>

<style scoped>
.fade-enter-active,
.fade-leave-active {
  transition: opacity .25s ease;
}

.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}
</style>