<template>
    <div class="space-y-8">

        <div>

            <label class="block mb-2 text-sm text-gray-300">
                YouTube Video URL
            </label>

            <input
                v-model="form.youtube_video_url"
                type="url"
                placeholder="https://www.youtube.com/watch?v=..."
                class="w-full rounded-xl bg-zinc-900 border border-zinc-700 px-4 py-3 text-white"
            />

        </div>

        <div>

            <label class="block mb-2 text-sm text-gray-300">
                YouTube Channel URL
            </label>

            <input
                v-model="form.youtube_channel_url"
                type="url"
                placeholder="https://youtube.com/@artist"
                class="w-full rounded-xl bg-zinc-900 border border-zinc-700 px-4 py-3 text-white"
            />

        </div>

        <div class="grid md:grid-cols-2 gap-6">

            <div>

                <label class="block mb-2 text-sm text-gray-300">
                    Button Text
                </label>

                <input
                    v-model="form.youtube_button_text"
                    class="w-full rounded-xl bg-zinc-900 border border-zinc-700 px-4 py-3 text-white"
                />

            </div>

            <div>

                <label class="block mb-2 text-sm text-gray-300">
                    Button URL
                </label>

                <input
                    v-model="form.youtube_button_url"
                    type="url"
                    placeholder="Leave empty to use Channel URL"
                    class="w-full rounded-xl bg-zinc-900 border border-zinc-700 px-4 py-3 text-white"
                />

            </div>

        </div>

        <div class="grid md:grid-cols-3 gap-6">

            <label class="flex items-center gap-3 text-white">

                <input
                    type="checkbox"
                    v-model="form.show_video"
                />

                Show Video

            </label>

            <label class="flex items-center gap-3 text-white">

                <input
                    type="checkbox"
                    v-model="form.autoplay_video"
                />

                Autoplay

            </label>

            <div>

                <label class="block mb-2 text-sm text-gray-300">
                    Autoplay Duration
                </label>

                <input
                    v-model.number="form.autoplay_seconds"
                    type="number"
                    min="10"
                    class="w-full rounded-xl bg-zinc-900 border border-zinc-700 px-4 py-3 text-white"
                />

            </div>

        </div>

    </div>
</template>

<script setup>
defineProps({
    form: Object,
});
</script>