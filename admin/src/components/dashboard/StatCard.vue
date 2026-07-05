<template>
    <div class="rounded-2xl border border-slate-800 bg-slate-900 p-6 shadow-lg">
        <p class="text-sm text-slate-400">
            {{ title }}
        </p>

        <h2 class="mt-3 text-4xl font-bold text-white">
            {{ value }}
        </h2>
    </div>
</template>

<script setup>
defineProps({
    title: String,
    value: [String, Number],
});
</script>
