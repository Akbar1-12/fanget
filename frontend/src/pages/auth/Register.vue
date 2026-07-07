<template>
  <div class="min-h-screen flex items-center justify-center bg-black">

    <form
      @submit.prevent="submit"
      class="w-full max-w-lg bg-zinc-900 p-8 rounded-2xl space-y-5"
    >

      <h1 class="text-3xl font-bold text-white">
        Artist Registration
      </h1>

      <input
        v-model="form.name"
        type="text"
        placeholder="Full Name"
        class="w-full rounded-xl bg-zinc-800 border border-zinc-700 px-4 py-3 text-white"
      />

      <input
        v-model="form.artist_name"
        type="text"
        placeholder="Artist Name"
        class="w-full rounded-xl bg-zinc-800 border border-zinc-700 px-4 py-3 text-white"
      />

      <input
        v-model="form.email"
        type="email"
        placeholder="Email"
        class="w-full rounded-xl bg-zinc-800 border border-zinc-700 px-4 py-3 text-white"
      />

      <input
        v-model="form.password"
        type="password"
        placeholder="Password"
        class="w-full rounded-xl bg-zinc-800 border border-zinc-700 px-4 py-3 text-white"
      />

      <input
        v-model="form.password_confirmation"
        type="password"
        placeholder="Confirm Password"
        class="w-full rounded-xl bg-zinc-800 border border-zinc-700 px-4 py-3 text-white"
      />

      <button
        :disabled="loading"
        class="w-full rounded-xl bg-green-500 py-3 font-semibold text-black"
      >
        {{ loading ? "Creating account..." : "Create Account" }}
      </button>

    </form>

  </div>
</template>

<script setup>
import { reactive, ref } from "vue";
import { useRouter } from "vue-router";
import { useAuthStore } from "@/stores/auth";

const router = useRouter();
const auth = useAuthStore();

const loading = ref(false);

const form = reactive({

    name: "",

    artist_name: "",

    email: "",

    password: "",

    password_confirmation: "",

});

async function submit() {

    loading.value = true;

    try {

        await auth.register(form);

        router.push("/await-approval");

    } catch (e) {

        console.error(e);

        alert("Registration failed.");

    } finally {

        loading.value = false;

    }

}
</script>