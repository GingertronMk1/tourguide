<script setup>
import { useForm, Head } from "@inertiajs/vue3";
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
    venueTypes: {
        type: Array,
        default: () => [],
    },
});

const form = useForm(props.venue);
</script>
<template>
    <BaseLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit {{ venue.name }}
            </h2>
        </template>

        <Head :title="`Edit ${venue.name}`" />
        <form
            class="card space-y-3"
            @submit.prevent="form.patch(route('venue.update', venue))"
        >
            <div class="grid grid-cols-2 gap-x-4">
                <label for="name" class="flex flex-row items-center space-x-3">
                    <span>Name</span>
                    <input
                        id="name"
                        v-model="form.name"
                        type="text"
                        name="name"
                        class="flex-1"
                    />
                </label>
                <label
                    for="venue_type"
                    class="flex flex-row items-center space-x-3"
                >
                    <span>Venue Type</span>
                    <select
                        id="venue_type"
                        v-model="form.venue_type_id"
                        name="venue_type"
                        class="flex-1"
                    >
                        <option
                            v-for="venue_type in venueTypes"
                            :key="venue_type.id"
                            :value="venue_type.id"
                            v-text="venue_type.name"
                        />
                    </select>
                </label>
            </div>
            <label for="description" class="flex flex-col">
                <span>Description</span>
                <textarea
                    id="description"
                    v-model="form.description"
                    name="description"
                    cols="30"
                    rows="10"
                />
            </label>
            <label for="notes" class="flex flex-col">
                <span>Notes</span>
                <textarea
                    id="notes"
                    v-model="form.notes"
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
                            v-model="form.region_id"
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
                            v-model="form.city"
                            type="text"
                            name="city"
                            class="flex-1"
                        />
                    </label>
                </div>
                <label for="street_address" class="flex flex-col">
                    <span>Street Address</span>
                    <textarea
                        id="street_address"
                        v-model="form.street_address"
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
                                v-model="form.maximum_stage_width"
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
                                v-model="form.maximum_stage_depth"
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
                                v-model="form.maximum_stage_height"
                                type="number"
                                name="maximum_stage_height"
                            />mm</span
                        >
                    </label>
                </div>
                <div class="flex flex-col items-stretch space-y-3">
                    <label
                        for="number_of_dressing_rooms"
                        class="flex flex-row justify-between items-center space-x-3"
                    >
                        <span>Dressing Rooms</span>
                        <input
                            id="number_of_dressing_rooms"
                            v-model="form.number_of_dressing_rooms"
                            type="number"
                            name="number_of_dressing_rooms"
                        />
                    </label>
                    <label
                        for="maximum_seats"
                        class="flex flex-row justify-between items-center space-x-3"
                    >
                        <span>Maximum Seats</span>
                        <input
                            id="maximum_seats"
                            v-model="form.maximum_seats"
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
                            v-model="form.maximum_wheelchair_seats"
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
                            v-model="form.backstage_wheelchair_access"
                            :value="true"
                            type="checkbox"
                            name="backstage_wheelchair_access"
                        />
                    </label>
                </div>
            </div>
            <button type="submit" class="btn-primary">Save</button>
            <hr />
            <div class="grid grid-cols-2">
                <div class="flex flex-col space-y-3">
                        <label  class="flex flex-row items-center space-x-3" v-for="eq in accessEquipment" :key="eq.id" :for="`has-access-${eq.id}`">
                            <span class="mr-auto" v-text="eq.name" />
                        <input
                            type="checkbox"
                            :name="`has-access-${eq.id}`"
                            :id="`has-access-${eq.id}`"
                            v-model="form.access_equipment"
                        />
                        <input
                            type="text"
                            :name="`notes-access-${eq.id}`"
                            :id="`notes-access-${eq.id}`"
                        /></label>
                </div>
            </div>
        </form>
    </BaseLayout>
</template>
