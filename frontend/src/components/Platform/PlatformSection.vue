<template>
  <section class="mx-auto mt-12 w-full max-w-4xl px-4 sm:px-6">
    <!-- Heading -->
    <div class="mb-12 text-center">
      <h2 class="text-3xl font-bold text-white">
        Choose your platform
      </h2>

      <p class="mt-3 text-white/50">
        Continue with your preferred streaming service.
      </p>
    </div>

    <!-- Platform List -->
    <div class="space-y-5">
      <MusicPlatformCard
        v-for="platform in orderedPlatforms"
        :key="platform.id"
        :platform="platform"
        @click="$emit('follow', platform)"
      />
    </div>
  </section>
</template>

<script setup>
import { computed } from "vue";
import MusicPlatformCard from "./MusicPlatformCard.vue";

const props = defineProps({
  platforms: {
    type: Array,
    required: true,
  },
});

defineEmits(["follow"]);

const orderedPlatforms = computed(() => {
  const order = [
    "spotify",
    "apple",
    "boomplay",
    "audiomack",
    "deezer",
    "youtube",
  ];

  return [...props.platforms].sort((a, b) => {
    const indexA = order.indexOf(a.id);
    const indexB = order.indexOf(b.id);

    return (
      (indexA === -1 ? 999 : indexA) -
      (indexB === -1 ? 999 : indexB)
    );
  });
});
</script>