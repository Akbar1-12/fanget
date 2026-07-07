<template>
    <div class="space-y-8">

        <div>

            <label class="block mb-2 text-sm text-gray-300">
                Song Title
            </label>

            <input
                v-model="form.song_title"
                type="text"
                class="w-full rounded-xl bg-zinc-900 border border-zinc-700 px-4 py-3 text-white"
                placeholder="Song title"
            />

        </div>

        <div>

            <label class="block mb-2 text-sm text-gray-300">
                Promo Text
            </label>

            <textarea
                v-model="form.promo"
                rows="4"
                class="w-full rounded-xl bg-zinc-900 border border-zinc-700 px-4 py-3 text-white"
                placeholder="Available on all platforms"
            />

        </div>

        <div>

            <label class="block mb-2 text-sm text-gray-300">
                Artwork
            </label>

            <input
                type="file"
                accept="image/*"
                @change="uploadArtwork"
                class="text-white"
            />

        </div>

        <div
            v-if="preview"
            class="pt-2"
        >

            <img
                :src="preview"
                class="h-52 rounded-2xl border border-zinc-700 object-cover"
            />

        </div>

    </div>
</template>

<script setup>
import { ref } from "vue";

const props = defineProps({
    form: Object,
});

const emit = defineEmits([
    "update:form",
]);

const preview = ref(null);

function uploadArtwork(e) {

    const file = e.target.files[0];

    props.form.artwork = file;

    if (file) {

        preview.value = URL.createObjectURL(file);

    }

}
</script>