<template>
  <div class="mb-10">

    <!-- Progress -->
    <div class="flex items-center">

      <template
        v-for="(item, index) in steps"
        :key="item.number"
      >

        <!-- Circle -->
        <div
          class="flex h-12 w-12 items-center justify-center rounded-full border-2 text-sm font-bold transition-all duration-300"
          :class="[
            step >= item.number
              ? 'border-green-500 bg-green-500 text-black'
              : 'border-white/20 bg-[#18181B] text-white/50'
          ]"
        >
          {{ item.number }}
        </div>

        <!-- Line -->
        <div
          v-if="index < steps.length - 1"
          class="mx-2 h-1 flex-1 rounded-full transition-all duration-300"
          :class="step > item.number ? 'bg-green-500' : 'bg-white/10'"
        ></div>

      </template>

    </div>

    <!-- Labels -->
    <div class="mt-5 grid grid-cols-5 gap-2 text-center">

      <div
        v-for="item in steps"
        :key="item.number"
      >
        <p
          class="text-xs font-semibold"
          :class="step === item.number ? 'text-green-400' : 'text-white/40'"
        >
          {{ item.title }}
        </p>
      </div>

    </div>

  </div>
</template>

<script setup>
defineProps({
  step: {
    type: Number,
    required: true,
  },
});

const steps = [
  {
    number: 1,
    title: "Basic",
  },
  {
    number: 2,
    title: "Artwork",
  },
  {
    number: 3,
    title: "Video",
  },
  {
    number: 4,
    title: "Platforms",
  },
  {
    number: 5,
    title: "Publish",
  },
];
</script>