<template>
    <div class="space-y-6">

        <div>

            <h2 class="text-2xl font-bold text-white">
                Streaming Platforms
            </h2>

            <p class="mt-2 text-white/50">
                Paste the direct link to your song for every platform you want
                to include.
            </p>

        </div>

        <div
            v-for="platform in platforms"
            :key="platform.platform_id"
            class="rounded-2xl border border-zinc-800 bg-zinc-900 p-6"
        >

            <div class="mb-4 flex items-center gap-4">

                <img
                    v-if="platform.logo"
                    :src="platform.logo"
                    :alt="platform.name"
                    class="h-10 w-10 object-contain"
                >

                <div>

                    <h3 class="font-semibold text-white">
                        {{ platform.name }}
                    </h3>

                </div>

            </div>

            <input
                v-model="platform.destination_url"
                type="url"
                :placeholder="`Paste your ${platform.name} song URL`"
                class="w-full rounded-xl border border-zinc-700 bg-zinc-800 px-4 py-3 text-white outline-none focus:border-green-500"
            >

        </div>

    </div>
</template>

<script setup>

const platforms = defineModel("platforms");

</script>