<script setup>
import VenueCard from "@/Components/VenueCard.vue";
import BaseLayout from "@/Layouts/BaseLayout.vue";
import { Head, Link } from "@inertiajs/vue3";

defineProps({
    region: {
        type: [Object, null],
        default: null,
    },
    venue: {
        type: Object,
        required: true,
    },
});
</script>
<template>
    <BaseLayout>
        <template #header>
            <span class="font-semibold text-xl text-gray-800 leading-tight">
                <Link
                    :href="
                        region?.id
                            ? route('region.venue.index', { region: region.id })
                            : route('venue.index')
                    "
                >
                    <i class="fa-solid fa-chevron-left" />
                    <template v-if="region">
                        Back to {{ region.name }} Venues
                    </template>
                    <template v-else> Back to Venue Index </template>
                </Link>
            </span>
        </template>

        <Head :title="venue.name" />

        <div class="flex-1 flex flex-col space-y-4">
            <VenueCard :venue="venue" />

            <div class="card space-y-3">
                <p class="text-2xl font-bold">Access Equipment</p>
                <ul v-if="venue.access_equipment.length">
                    <li
                        v-for="equipment in venue.access_equipment"
                        :key="equipment.id"
                    >
                        {{ equipment.name }}
                        <template v-if="equipment?.pivot?.notes">
                            | {{ equipment.pivot.notes }}</template
                        >
                    </li>
                </ul>
            </div>

            <div class="card space-y-3">
                <p class="text-2xl font-bold">Deal Types</p>
                <ul>
                    <li v-for="(type, index) in venue.deal_types" :key="index">
                        {{ type.name }}
                        <template v-if="type?.pivot?.notes">
                            | {{ type.pivot.notes }}</template
                        >
                    </li>
                </ul>
            </div>
        </div>
    </BaseLayout>
</template>
