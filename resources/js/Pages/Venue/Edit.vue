<script setup>
import { Head } from "@inertiajs/vue3";
import { ref } from "vue";
import BaseLayout from "@/Layouts/BaseLayout.vue";

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
});

const newVenue = ref(props.venue);
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
            <label for="name" class="flex flex-row items-center space-x-3">
                <span>Name</span>
                <input
                    id="name"
                    v-model="newVenue.name"
                    type="text"
                    name="name"
                />
            </label>
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
            <label for="city" class="flex flex-row items-center space-x-3">
                <span>City</span>
                <input
                    id="city"
                    v-model="newVenue.city"
                    type="text"
                    name="city"
                />
            </label>
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
            <div class="flex flex-col items-start">
                <span>Stage Dimensions</span>
                <label
                    for="maximum_stage_width"
                    class="flex flex-row items-center space-x-3"
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
                    class="flex flex-row items-center space-x-3"
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
                    class="flex flex-row items-center space-x-3"
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
        </div>
        <pre v-text="venue" />
        <div class="card"></div>
    </BaseLayout>
</template>
