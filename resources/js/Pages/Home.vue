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
    "card",
    "d-flex",
    "flex-column",
    "justify-content-center",
    "align-items-center",
];
const cardHeight = "200px";
</script>
<template>
    <BaseLayout>
        <div
            class="grid grid-cols-2 gap-4"
            style="--bs-columns: 2; --bs-gap: 1rem"
        >
            <Link
                :href="route('venue.index')"
                :class="cardClasses"
                :style="{ height: cardHeight }"
            >
                <h2 v-text="`${venueCount} venues`" />
            </Link>
            <Link
                :href="route('region.index')"
                :class="cardClasses"
                :style="{ height: cardHeight }"
            >
                <h2 v-text="`${regionCount} regions`" />
            </Link>
            <Link
                :href="route('area.index')"
                :class="cardClasses"
                :style="{ height: cardHeight }"
            >
                <h2 v-text="`${areaCount} areas`" />
            </Link>
        </div>
    </BaseLayout>
</template>
