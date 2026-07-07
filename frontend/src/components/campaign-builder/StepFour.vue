<template>
    <div class="space-y-8">

        <div class="rounded-2xl border border-zinc-800 bg-zinc-900 p-6">

            <img
                v-if="form.artwork"
                :src="preview"
                class="mx-auto h-64 w-64 rounded-2xl object-cover"
            />

            <h2 class="mt-6 text-3xl font-bold text-white">
                {{ form.song_title || "Song Title" }}
            </h2>

            <p class="mt-4 text-white/60 whitespace-pre-line">
                {{ form.promo || "Your promo text will appear here." }}
            </p>

        </div>

        <div class="rounded-2xl border border-zinc-800 bg-zinc-900 p-6">

            <h3 class="mb-4 text-xl font-semibold text-white">
                Streaming Platforms
            </h3>

            <div
                v-for="platform in form.platforms"
                :key="platform.platform_id"
                class="mb-2 text-white/70"
            >
                ✔ {{ platform.destination_url }}
            </div>

        </div>

        <div class="rounded-2xl border border-zinc-800 bg-zinc-900 p-6">

            <h3 class="mb-4 text-xl font-semibold text-white">
                YouTube
            </h3>

            <div class="space-y-2 text-white/70">

                <p>
                    <strong>Video:</strong>
                    {{ form.youtube_video_url || "-" }}
                </p>

                <p>
                    <strong>Channel:</strong>
                    {{ form.youtube_channel_url || "-" }}
                </p>

                <p>
                    <strong>Button:</strong>
                    {{ form.youtube_button_text }}
                </p>

                <p>
                    <strong>Autoplay:</strong>
                    {{ form.autoplay_video ? "Enabled" : "Disabled" }}
                </p>

                <p>
                    <strong>Delay:</strong>
                    {{ form.autoplay_seconds }} seconds
                </p>

            </div>

        </div>

    </div>
</template>

<script setup>
import { computed } from "vue";

const props = defineProps({
    form: Object,
});

const preview = computed(() => {

    if (!props.form.artwork) return null;

    return URL.createObjectURL(props.form.artwork);

});
</script>