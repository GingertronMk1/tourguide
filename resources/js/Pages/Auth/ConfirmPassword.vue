<script setup>
import BaseLayout from "@/Layouts/BaseLayout.vue";
import { Head, useForm } from "@inertiajs/vue3";

const form = useForm({
    password: "",
});

const submit = () => {
    form.post(route("password.confirm"), {
        onFinish: () => form.reset(),
    });
};
</script>

<template>
    <BaseLayout>
        <Head title="Confirm Password" />

        <div class="mb-4 text-sm text-gray-600">
            This is a secure area of the application. Please confirm your
            password before continuing.
        </div>

        <form @submit.prevent="submit">
            <div>
                <label for="password">Password</label>
                <input
                    id="password"
                    v-model="form.password"
                    type="password"
                    name="password"
                    class="form-control"
                    required
                    autocomplete="current-password"
                    autofocus
                />
            </div>

            <div class="flex justify-end mt-4">
                <button
                    :class="`btn-primary ms-3 ${
                        form.processing ? 'disabled' : ''
                    }`"
                    :disabled="form.processing"
                >
                    Confirm
                </button>
            </div>
        </form>
    </BaseLayout>
</template>
