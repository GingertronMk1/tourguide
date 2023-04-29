<script setup>
import { Link } from "@inertiajs/vue3";
</script>

<template>
    <div class="h-full">
        <header class="p-4 bg-white border-b border-gray-100 flex flex-row">
            <Link
                :href="route('home')"
                class="fa-solid fa-house mr-3 justify-center"
            ></Link>
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
        <div class="p-4 bg-gray-200">
            <slot />
        </div>
    </div>
</template>
