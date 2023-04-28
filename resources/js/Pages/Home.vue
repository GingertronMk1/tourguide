<script setup>
import BaseLayout from "@/Layouts/BaseLayout.vue";
import { Link } from "@inertiajs/vue3";

defineProps({
    venueCount: {
        type: Number,
        required: true,
    },
    regionCount: {
        type: Number,
        required: true,
    },
    areaCount: {
        type: Number,
        required: true,
    },
});

const cardClasses = [
    "bg-white",
    "drop-shadow-sm",
    "hover:drop-shadow-lg",
    "border",
    "border-gray-100",
    "rounded-lg",
    "p-3",
    "flex",
    "flex-col",
    "justify-center",
    "align-center",
    "text-center",
    "text-2xl",
].join(" ");
</script>
<template>
    <BaseLayout>
        <template #header>
            <span class="font-semibold text-xl text-gray-800 leading-tight">
                Welcome to TourGuide!
            </span>
        </template>

        <div class="flex-1 grid grid-cols-2 gap-4">
            <Link :href="route('venue.index')" :class="cardClasses">
                {{ venueCount }} venues
            </Link>
            <Link :href="route('region.index')" :class="cardClasses">
                {{ regionCount }} regions
            </Link>
            <Link :href="route('area.index')" :class="cardClasses">
                {{ areaCount }} areas
            </Link>
        </div>
    </BaseLayout>
</template>
