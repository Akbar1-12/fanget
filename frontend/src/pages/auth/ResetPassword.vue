<template>
  <div class="min-h-screen flex items-center justify-center bg-black px-6">

    <form
      @submit.prevent="submit"
      class="w-full max-w-md rounded-2xl bg-zinc-900 p-8 space-y-6"
    >

      <h1 class="text-center text-3xl font-bold text-white">
        Reset Password
      </h1>

      <input
        v-model="password"
        type="password"
        placeholder="New Password"
        class="w-full rounded-xl border border-zinc-700 bg-zinc-800 px-4 py-3 text-white"
      />

      <input
        v-model="password_confirmation"
        type="password"
        placeholder="Confirm Password"
        class="w-full rounded-xl border border-zinc-700 bg-zinc-800 px-4 py-3 text-white"
      />

      <button
        :disabled="loading"
        class="w-full rounded-xl bg-green-500 py-3 font-semibold text-black"
      >
        {{ loading ? "Updating..." : "Reset Password" }}
      </button>

    </form>

  </div>
</template>

<script setup>
import { ref } from "vue";
import { useRoute, useRouter } from "vue-router";
import api from "@/services/api";

const router = useRouter();
const route = useRoute();

const loading = ref(false);

const password = ref("");
const password_confirmation = ref("");

async function submit() {

    loading.value = true;

    try {

        await api.post("/v1/reset-password", {

            token: route.query.token,

            email: route.query.email,

            password: password.value,

            password_confirmation: password_confirmation.value,

        });

        alert("Password updated successfully.");

        router.push("/login");

    } catch {

        alert("Password reset failed.");

    }

    loading.value = false;

}
</script>