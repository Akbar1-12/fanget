```vue
<template>
    <div class="min-h-screen bg-[#09090B] flex items-center justify-center px-6">

        <div class="w-full max-w-md rounded-3xl border border-zinc-800 bg-zinc-900 p-8">

            <h1 class="text-3xl font-bold text-white mb-2">
                Admin Login
            </h1>

            <p class="text-zinc-400 mb-8">
                Sign in to Fanget Admin
            </p>

            <form
                @submit.prevent="login"
                class="space-y-5"
            >

                <div>

                    <label class="block text-sm text-zinc-400 mb-2">
                        Email
                    </label>

                    <input
                        v-model="form.email"
                        type="email"
                        class="w-full rounded-xl bg-black border border-zinc-700 px-4 py-3 text-white"
                    />

                </div>

                <div>

                    <label class="block text-sm text-zinc-400 mb-2">
                        Password
                    </label>

                    <input
                        v-model="form.password"
                        type="password"
                        class="w-full rounded-xl bg-black border border-zinc-700 px-4 py-3 text-white"
                    />

                </div>

                <button
                    :disabled="loading"
                    class="w-full rounded-xl bg-green-500 py-3 font-semibold text-black hover:bg-green-400 transition"
                >

                    {{ loading ? "Signing In..." : "Login" }}

                </button>

            </form>

            <p
                v-if="error"
                class="text-red-400 text-sm mt-5"
            >
                {{ error }}
            </p>

        </div>

    </div>
</template>

<script setup>
import { reactive, ref } from "vue";
import { useRouter } from "vue-router";
import api from "@/services/api";
import { useAuthStore } from "@/stores/auth";

const router = useRouter();

const auth = useAuthStore();

const loading = ref(false);

const error = ref("");

const form = reactive({

    email: "",

    password: "",

});

async function login() {

    error.value = "";

    loading.value = true;

    try {

        const { data } = await api.post("/v1/login", form);

        auth.adminLogin(

            data.token,

            data.admin

        );

        router.push("/admin/dashboard");

    }

    catch (e) {

        error.value =
            e.response?.data?.message ||
            "Unable to login.";

    }

    finally {

        loading.value = false;

    }

}
</script>
```
