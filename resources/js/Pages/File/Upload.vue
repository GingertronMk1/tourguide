<script setup>
import BaseLayout from "@/Layouts/BaseLayout.vue";
import { useForm } from "@inertiajs/vue3";

const form = useForm({
    name: null,
    avatar: null,
});

function submit() {
    form.post(route("file.store"));
}
</script>

<template>
    <BaseLayout>
        <form @submit.prevent="submit">
            <input v-model="form.name" type="text" />
            <input type="file" @input="form.avatar = $event.target.files[0]" />
            <progress
                v-if="form.progress"
                :value="form.progress.percentage"
                max="100"
            >
                {{ form.progress.percentage }}%
            </progress>
            <button type="submit">Submit</button>
        </form>
    </BaseLayout>
</template>
