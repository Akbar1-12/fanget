<template>
  <section class="mt-10 animate-fade-up-d1">
    <button
      type="button"
      @click="$emit('open-modal')"
      class="group relative w-full overflow-hidden rounded-3xl border border-white/10 bg-white/5 text-left transition duration-300 hover:bg-white/10"
    >
      <div class="relative aspect-video w-full">
        <img
          :src="video.thumbnail"
          :alt="video.title"
          class="h-full w-full object-cover opacity-90 transition duration-300 group-hover:scale-105"
        />

        <div class="absolute inset-0 bg-black/35"></div>

        <div class="absolute inset-0 flex items-center justify-center">
          <div class="flex h-20 w-20 items-center justify-center rounded-full bg-black/70 text-white shadow-2xl ring-1 ring-white/20 transition duration-300 group-hover:scale-110">
            <span class="ml-1 text-2xl">▶</span>
          </div>
        </div>
      </div>

      <div class="p-5 md:p-6">
        <p class="text-sm uppercase tracking-[0.2em] text-white/40">
          Music Video
        </p>
        <h3 class="mt-2 text-lg font-semibold text-white md:text-xl">
          {{ video.title }}
        </h3>
        <p class="mt-2 text-sm text-white/50">
          Tap to preview the official video.
        </p>
      </div>
    </button>
  </section>
</template>

<script setup>
defineProps({
  video: {
    type: Object,
    required: true,
  },
})

defineEmits(["open-modal"])
</script>