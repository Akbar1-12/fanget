<template>

<Teleport to="body">

<div
v-if="show"
class="fixed inset-0 z-50 flex items-center justify-center bg-black/90 p-5"
>

<button
@click="$emit('close')"
class="absolute right-6 top-6 text-3xl"
>

✕

</button>

<div class="aspect-video w-full max-w-5xl overflow-hidden rounded-3xl">

<iframe
class="h-full w-full"
:src="youtubeUrl"
allowfullscreen
></iframe>

</div>

</div>

</Teleport>

</template>

<script setup>
import { computed } from "vue"

const props = defineProps({
show:Boolean,
video:Object
})

defineEmits(["close"])

const youtubeUrl = computed(() =>

`https://www.youtube.com/embed/${props.video.video_id}?autoplay=1`

)
</script>