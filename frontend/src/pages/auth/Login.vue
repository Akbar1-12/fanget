<template>
  <div class="min-h-screen flex items-center justify-center bg-black">

    <form
      @submit.prevent="submit"
      class="w-full max-w-md bg-zinc-900 p-8 rounded-2xl space-y-6"
    >

      <h1 class="text-3xl font-bold text-white">
        Artist Login
      </h1>

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

      <button
        :disabled="loading"
        class="w-full rounded-xl bg-green-500 py-3 font-semibold text-black"
      >
        {{ loading ? "Signing in..." : "Login" }}
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

    email: "",

    password: "",

});

async function submit() {

    loading.value = true;

    try {

        await auth.login(form);

        router.push("/dashboard");

    } catch (error) {

        if (error.status === 403) {

            router.push("/await-approval");
            return;

        }

        if (error.status === 401) {

            alert("Invalid email or password.");
            return;

        }

        alert(error.data?.message || "Something went wrong.");

    } finally {

        loading.value = false;

    }

}
</script>