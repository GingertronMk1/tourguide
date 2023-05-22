<script setup>
import BaseLayout from "@/Layouts/BaseLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, useForm } from "@inertiajs/vue3";

defineProps({
    status: {
        type: String,
        default: "",
    },
});

const form = useForm({
    email: "",
});

const submit = () => {
    form.post(route("password.email"));
};
</script>

<template>
    <BaseLayout>
        <Head title="Forgot Password" />

        <div class="mb-4 text-sm text-gray-600">
            Forgot your password? No problem. Just let us know your email
            address and we will email you a password reset link that will allow
            you to choose a new one.
        </div>

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <form @submit.prevent="submit">
            <div>
                <label for="email">Email</label>
                <input
                    id="email"
                    v-model="form.email"
                    name="email"
                    type="email"
                    required
                    autofocus
                    autocomplete="username"
                />
            </div>

            <div class="flex items-center justify-end mt-4">
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
