<script setup>
import { ref } from "vue";
</script>

<template>
    <div class="flex flex-col">
        <header class="p-4 bg-white border-b border-gray-100">
            <slot name="header" />
        </header>
        <div class="p-4 flex-1 flex flex-col">
            <slot />
        </div>
    </div>
</template>
