<template>
  <div class="flex gap-3">
    <a
      :href="video.button_url"
      target="_blank"
      rel="noopener noreferrer"
      class="flex-1 rounded-full bg-red-600 px-5 py-3 text-center text-sm font-bold text-white transition hover:bg-red-500"
    >
      {{ video.button_text || "Subscribe" }}
    </a>

    <a
      :href="watchUrl"
      target="_blank"
      rel="noopener noreferrer"
      class="rounded-full border border-white/10 px-5 py-3 text-sm font-semibold text-white transition hover:bg-white/10"
    >
      Watch
    </a>
  </div>
</template>

<script setup>
import { computed } from "vue";

const props = defineProps({
  video: {
    type: Object,
    required: true,
  },
});

const watchUrl = computed(() => {
  if (!props.video?.video_id) return "#";

  return `https://www.youtube.com/watch?v=${props.video.video_id}`;
});
</script>