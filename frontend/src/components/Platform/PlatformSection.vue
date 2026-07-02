<template>
  <section class="mt-10">
    <div class="text-center">
      <h3 class="text-xl font-semibold text-white">
        Choose a platform
      </h3>
      <p class="mt-2 text-sm text-white/50">
        Tap a logo to begin the follow flow.
      </p>
    </div>

    <div class="mt-6 grid grid-cols-2 gap-4 sm:grid-cols-3">
      <button
        v-for="platform in platforms"
        :key="platform.id"
        type="button"
        @click="$emit('follow', platform.id)"
        class="group flex flex-col items-center gap-3 rounded-3xl border border-white/10 bg-white/5 p-5 text-center transition duration-300 hover:-translate-y-1 hover:bg-white/10"
      >
        <div
          class="flex h-20 w-20 items-center justify-center rounded-3xl shadow-lg transition duration-300 group-hover:scale-105 group-hover:shadow-2xl"
          :style="{ backgroundColor: platform.color }"
        >
          <span class="text-2xl font-black text-white">
            {{ platform.short }}
          </span>
        </div>

        <div>
          <p class="text-sm font-semibold text-white">
            {{ platform.name }}
          </p>
          <p class="mt-1 text-xs text-white/45">
            Tap to follow
          </p>
        </div>
      </button>
    </div>
  </section>
</template>

<script setup>
defineProps({
  platforms: {
    type: Array,
    required: true,
  },
})

defineEmits(["follow"])
</script>