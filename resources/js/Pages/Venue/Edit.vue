<script setup>
import { Head } from "@inertiajs/vue3";
import { ref } from "vue";
import BaseLayout from "@/Layouts/BaseLayout.vue";
import { computed } from "vue";

const props = defineProps({
    venue: {
        type: Object,
        required: true,
    },
    accessEquipment: {
        type: Array,
        default: () => [],
    },
    dealTypes: {
        type: Array,
        default: () => [],
    },
    areas: {
        type: Array,
        default: () => [],
    },
    venueTypes: {
        type: Array,
        default: () => []
    }
});

const newVenue = ref(props.venue);

const venueSearchValue = computed(() => {
    const { street_address, city } = newVenue.value;
    const modifiedAddress = street_address?.replace(/\n/g, " ");
    const searchString = `${city} ${modifiedAddress}`;
    return `https://www.google.com/maps/search/${encodeURIComponent(
        searchString
    )}`;
});
</script>
<template>
    <BaseLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit {{ venue.name }}
            </h2>
        </template>

        <Head :title="`Edit ${venue.name}`" />
        <div class="card space-y-3">
            <div class="grid grid-cols-2">

            <label for="name" class="flex flex-row items-center space-x-3">
                <span>Name</span>
                <input
                    id="name"
                    v-model="newVenue.name"
                    type="text"
                    name="name"
                />
            </label>
            <label for="venue_type">
                <span>Venue Type</span>
                <select name="venue_type" id="venue_type" v-model="newVenue.venue_type_id">
                    <option v-for="venue_type in venueTypes" :key="venue_type.id" :value="venue_type.id" v-text="venue_type.name" />
                </select>
            </label>
            </div>
            <label for="description" class="flex flex-col">
                <span>Description</span>
                <textarea
                    id="description"
                    v-model="newVenue.description"
                    name="description"
                    cols="30"
                    rows="10"
                />
            </label>
            <label for="notes" class="flex flex-col">
                <span>Notes</span>
                <textarea
                    id="notes"
                    v-model="newVenue.notes"
                    name="notes"
                    cols="30"
                    rows="10"
                />
            </label>
            <!-- LOCATION INFORMATION -->
            <div class="grid grid-cols-2 gap-x-4 items-start">
                <div class="flex flex-col items-stretch space-y-3">
                    <label for="region">
                        <span>Region</span>
                        <select
                            id="regions"
                            v-model="newVenue.region_id"
                            name="regions"
                            class="rounded-md w-full"
                        >
                            <template v-for="area in areas" :key="area.id">
                                <option disabled v-text="area.name" />
                                <option
                                    v-for="region in area.regions"
                                    :key="region.id"
                                    :value="region.id"
                                    class="ps-2"
                                    v-text="region.name"
                                />
                            </template>
                        </select>

                    </label>
                    <label
                        for="city"
                        class="flex flex-row items-center space-x-3"
                    >
                        <span>City</span>
                        <input
                            id="city"
                            v-model="newVenue.city"
                            type="text"
                            name="city"
                        />
                    </label>
                </div>
                <label for="street_address" class="flex flex-col">
                    <span>Street Address</span>
                    <textarea
                        id="street_address"
                        v-model="newVenue.street_address"
                        name="street_address"
                        cols="30"
                        rows="10"
                    />
                </label>
            </div>

            <!-- STAGE DIMENSIONS AND SEATS-->
            <div class="grid grid-cols-2 gap-x-4 items-end">
                <div class="flex flex-col items-stretch space-y-2">
                    <span>Stage Dimensions</span>
                    <label
                        for="maximum_stage_width"
                        class="flex flex-row items-center space-x-3 justify-between"
                    >
                        <span>Max Width</span>
                        <span>
                            <input
                                id="maximum_stage_width"
                                v-model="newVenue.maximum_stage_width"
                                type="number"
                                name="maximum_stage_width"
                            />mm</span
                        >
                    </label>
                    <label
                        for="maximum_stage_depth"
                        class="flex flex-row items-center space-x-3 justify-between"
                    >
                        <span>Max Height</span>
                        <span>
                            <input
                                id="maximum_stage_depth"
                                v-model="newVenue.maximum_stage_depth"
                                type="number"
                                name="maximum_stage_depth"
                            />mm
                        </span>
                    </label>
                    <label
                        for="maximum_stage_height"
                        class="flex flex-row items-center space-x-3 justify-between"
                    >
                        <span>Max Depth</span>
                        <span>
                            <input
                                id="maximum_stage_height"
                                v-model="newVenue.maximum_stage_height"
                                type="number"
                                name="maximum_stage_height"
                            />mm</span
                        >
                    </label>
                </div>
                <div class="flex flex-col items-stretch space-y-3">
                    <label
                        for="maximum_seats"
                        class="flex flex-row justify-between items-center space-x-3"
                    >
                        <span>Maximum Seats</span>
                        <input
                            id="maximum_seats"
                            v-model="newVenue.maximum_seats"
                            type="number"
                            name="maximum_seats"
                        />
                    </label>
                    <label
                        for="maximum_wheelchair_seats"
                        class="flex flex-row justify-between items-center space-x-3"
                    >
                        <span>Maximum Wheelchair Seats</span>
                        <input
                            id="maximum_wheelchair_seats"
                            v-model="newVenue.maximum_wheelchair_seats"
                            type="number"
                            name="maximum_wheelchair_seats"
                        />
                    </label>
                    <label
                        for="backstage_wheelchair_access"
                        class="flex flex-row justify-between items-center space-x-3"
                    >
                        <span>Backstage Wheelchair Access?</span>
                        <input
                            id="backstage_wheelchair_access"
                            v-model="newVenue.backstage_wheelchair_access"
                            :value="true"
                            type="checkbox"
                            name="backstage_wheelchair_access"
                        />
                    </label>
                </div>
            </div>
        </div>
        <pre v-text="venue" />
    </BaseLayout>
</template>
