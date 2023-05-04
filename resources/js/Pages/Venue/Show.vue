<script setup>
import VenueCard from "@/Components/Venue/VenueCard.vue";
import BaseLayout from "@/Layouts/BaseLayout.vue";
import AssetUpload from "@/Components/Asset/Upload.vue";
import { Head, Link } from "@inertiajs/vue3";
import { computed } from "vue";

const props = defineProps({
    venue: {
        type: Object,
        required: true,
    },
    query: {
        type: Object,
        default: () => {},
    },
});

const addressSearchURL = computed(() => {
    const { street_address, city } = props?.venue ?? {};
    const replacedStreetAddress = street_address.replace(/\n/g, " ");
    const encodedAddress = encodeURIComponent(
        `${city} ${replacedStreetAddress}`
    );
    return `https://www.google.com/maps/search/${encodedAddress}`;
});
</script>
<template>
    <BaseLayout>
        <template #header>
            <span class="font-semibold text-xl text-gray-800 leading-tight">
                <Link :href="route('venue.index', query)">
                    <i class="fa-solid fa-chevron-left" />
                    Back to Venue Index
                </Link>
            </span>
        </template>

        <Head :title="venue.name" />

        <div class="flex-1 flex flex-col space-y-4">
            <VenueCard :venue="venue" />

            <div class="card">
                <div class="text-2xl font-bold">Address Details</div>
                <div class="grid grid-cols-2 gap-x-4">
                    <div class="flex flex-col space-y-3">
                        <span class="font-semibold">City</span>
                        <span v-text="venue.city" />
                        <a :href="addressSearchURL" target="_blank">
                            <i class="fa-solid fa-map-location-dot" />
                            Find on Google
                        </a>
                    </div>
                    <div class="flex flex-col space-y-3">
                        <span class="font-semibold">Street Address</span>
                        <span
                            class="whitespace-pre-line"
                            v-text="venue.street_address"
                        />
                    </div>
                </div>
            </div>

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
            <AssetUpload
                :assetable-class="venue.class_name"
                :assetable-id="venue.id"
                :existing-assets="venue.assets"
            />
        </div>
    </BaseLayout>
</template>
