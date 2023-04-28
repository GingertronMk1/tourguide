<script setup>
defineProps({
    message: {
        type: String,
        default: "There has been an error",
    },
});
</script>

<template>
    <div v-show="message">
        <p class="text-sm text-red-600">
            {{ message }}
        </p>
    </div>
</template>
