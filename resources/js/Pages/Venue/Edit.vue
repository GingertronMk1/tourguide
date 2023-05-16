<script setup>
import { useForm, Head } from "@inertiajs/vue3";
import { ref } from "vue";
import AssetThumbnails

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

/** The general Venue form */
const form = useForm(props.venue);

/** Handling Access Equipment */
const venueAccessPivots = ref(
    props.venue.access_equipment.map(
        ({ name, pivot: { venue_id, access_equipment_id, notes } }) => ({
            venue_id,
            access_equipment_id,
            notes,
            name,
        })
    )
);

const accessPivots = ref({
    ...props.accessEquipment.map(({ name, id }) => ({
        name,
        venue_id: props.venue.id,
        access_equipment_id: id,
        notes: "",
    })),
    ...venueAccessPivots.value,
});

/** Handling Deal Types */
const venueDealTypePivots = ref(
    props.venue.deal_types.map(
        ({ name, pivot: { venue_id, deal_type_id, notes } }) => ({
            venue_id,
            deal_type_id,
            notes,
            name,
        })
    )
);

const dealTypePivots = ref({
    ...props.dealTypes.map(({ name, id }) => ({
        name,
        venue_id: props.venue.id,
        deal_type_id: id,
        notes: "",
    })),
    ...venueDealTypePivots.value,
});

/** Saving */
function saveForm() {
    form.access_equipment = venueAccessPivots.value;
    form.deal_types = venueDealTypePivots.value;
    form.patch(route("venue.update", props.venue));
}
</script>
<template>
    <BaseLayout body-classes="space-y-3">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit {{ venue.name }}
            </h2>
        </template>

        <Head :title="`Edit ${venue.name}`" />
        <form class="card space-y-3" @submit.prevent="saveForm">
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
            <div class="grid grid-cols-2 gap-x-4">
                <div class="flex flex-col space-y-3">
                    <span class="text-lg">Access Equipment</span>
                    <label
                        v-for="eq in accessPivots"
                        :key="eq.id"
                        class="flex flex-row items-center space-x-3"
                        :for="`has-access-${eq.id}`"
                    >
                        <span class="mr-auto" v-text="eq.name" />
                        <input
                            :id="`has-access-${eq.id}`"
                            v-model="venueAccessPivots"
                            :value="eq"
                            type="checkbox"
                            :name="`has-access-${eq.id}`" />
                        <input
                            :id="`notes-access-${eq.id}`"
                            v-model="eq.notes"
                            type="text"
                            :name="`notes-access-${eq.id}`"
                            placeholder="Notes"
                    /></label>
                </div>
                <div class="flex flex-col space-y-3">
                    <span class="text-lg">Deal Types</span>
                    <label
                        v-for="dt in dealTypePivots"
                        :key="dt.id"
                        class="flex flex-row items-center space-x-3"
                        :for="`has-deal-type-${dt.id}`"
                    >
                        <span class="mr-auto" v-text="dt.name" />
                        <input
                            :id="`has-deal-type-${dt.id}`"
                            v-model="venueDealTypePivots"
                            :value="dt"
                            type="checkbox"
                            :name="`has-deal-type-${dt.id}`" />
                        <input
                            :id="`notes-deal-type-${dt.id}`"
                            v-model="dt.notes"
                            type="text"
                            :name="`notes-deal-type-${dt.id}`"
                            placeholder="Notes"
                    /></label>
                </div>
            </div>
        </form>
        <AssetThumbnails
            :assetable-class="venue.class_name"
            :assetable-id="venue.id"
            :existing-assets="venue.assets"
            :add-asset-option="true"
        />
    </BaseLayout>
</template>
