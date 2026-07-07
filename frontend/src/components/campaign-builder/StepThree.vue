<template>
    <div class="space-y-8">

        <!-- YouTube Video -->
        <div>

            <label class="block mb-2 text-sm text-gray-300">
                YouTube Video URL
            </label>

            <input
                v-model="form.youtube_video_url"
                type="url"
                placeholder="https://www.youtube.com/watch?v=..."
                class="w-full rounded-xl border border-zinc-700 bg-zinc-900 px-4 py-3 text-white"
            />

        </div>

        <!-- Channel URL -->
        <div>

            <label class="block mb-2 text-sm text-gray-300">
                YouTube Channel URL
            </label>

            <input
                v-model="form.youtube_channel_url"
                type="url"
                placeholder="https://youtube.com/@artist"
                class="w-full rounded-xl border border-zinc-700 bg-zinc-900 px-4 py-3 text-white"
            />

            <p class="mt-2 text-xs text-zinc-500">
                This URL is used automatically for the Subscribe button.
            </p>

        </div>

        <!-- Toggle Buttons -->
        <div
            class="flex items-center justify-between rounded-xl border border-zinc-700 bg-zinc-900 p-5"
        >

            <div>

                <h3 class="font-semibold text-white">
                    Show YouTube Buttons
                </h3>

                <p class="mt-1 text-sm text-zinc-400">
                    Show or hide the Subscribe and Watch Now buttons beneath
                    the YouTube video.
                </p>

            </div>

            <label class="relative inline-flex cursor-pointer items-center">

                <input
                    v-model="form.show_video_buttons"
                    type="checkbox"
                    class="peer sr-only"
                />

                <div
                    class="h-6 w-11 rounded-full bg-zinc-700 transition
                           peer-checked:bg-green-500
                           after:absolute after:left-[2px] after:top-[2px]
                           after:h-5 after:w-5 after:rounded-full
                           after:bg-white after:transition-all
                           peer-checked:after:translate-x-5"
                ></div>

            </label>

        </div>

        <!-- Button Settings -->
        <div
            v-if="form.show_video_buttons"
            class="space-y-6"
        >

            <!-- Subscribe Button -->
            <div>

                <label class="block mb-2 text-sm text-gray-300">
                    Subscribe Button
                </label>

                <input
                    value="Subscribe"
                    disabled
                    class="w-full cursor-not-allowed rounded-xl border border-zinc-700 bg-zinc-800 px-4 py-3 text-zinc-400"
                />

                <p class="mt-2 text-xs text-zinc-500">
                    The Subscribe button text is fixed and cannot be changed.
                </p>

            </div>

            <!-- Watch Now URL -->
            <div>

                <label class="block mb-2 text-sm text-gray-300">
                    Watch Now Button URL
                </label>

                <input
                    v-model="form.youtube_button_url"
                    type="url"
                    placeholder="Leave empty to use the YouTube video"
                    class="w-full rounded-xl border border-zinc-700 bg-zinc-900 px-4 py-3 text-white"
                />

            </div>

        </div>

        <!-- Autoplay -->
        <div class="grid gap-6 md:grid-cols-2">

            <label class="flex items-center gap-3 text-white">

                <input
                    v-model="form.autoplay_video"
                    type="checkbox"
                />

                Autoplay Video

            </label>

            <div>

                <label class="block mb-2 text-sm text-gray-300">
                    Autoplay Duration (seconds)
                </label>

                <input
                    v-model.number="form.autoplay_seconds"
                    type="number"
                    min="10"
                    max="120"
                    class="w-full rounded-xl border border-zinc-700 bg-zinc-900 px-4 py-3 text-white"
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