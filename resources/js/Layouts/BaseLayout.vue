<script setup>
import { Link } from "@inertiajs/vue3";

</script>

<template>
    <div class="flex flex-col">
        <header class="p-4 bg-white border-b border-gray-100 flex flex-row">
            <div class="flex-1">
                <slot name="header" />
            </div>
            <div v-if="$page?.props?.auth?.user">
                <span v-text="$page?.props?.auth?.user.name" />
            </div>
            <div v-else>
                <Link :href="route('login')">Log In</Link>
            </div>
        </header>
        <div class="p-4 flex-1 flex flex-col">
            <slot />
        </div>
    </div>
</template>
