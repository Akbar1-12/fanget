<template>
    <div class="space-y-8">

        <div class="rounded-2xl border border-zinc-800 bg-zinc-900 p-8">

            <h2 class="text-2xl font-bold text-white mb-6">
                Ready to Publish
            </h2>

            <div class="space-y-4 text-white/70">

                <div class="flex justify-between">
                    <span>Song</span>
                    <span>{{ form.song_title }}</span>
                </div>

                <div class="flex justify-between">
                    <span>Platforms</span>
                    <span>{{ form.platforms.length }}</span>
                </div>

                <div class="flex justify-between">
                    <span>YouTube Video</span>
                    <span>
                        {{ form.youtube_video_url ? "Added" : "Not Added" }}
                    </span>
                </div>

                <div class="flex justify-between">
                    <span>Artwork</span>
                    <span>
                        {{ form.artwork ? "Uploaded" : "Missing" }}
                    </span>
                </div>

            </div>

            <div
                class="mt-8 rounded-xl border border-yellow-500/20 bg-yellow-500/10 p-4 text-yellow-300"
            >
                After publishing, Fanget will generate a unique campaign link
                that you can share anywhere.
            </div>

        </div>

    </div>
</template>

<script setup>
defineProps({
    form: Object,
});
</script>