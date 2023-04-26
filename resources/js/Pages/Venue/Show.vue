<script setup>
import BaseLayout from "@/Layouts/BaseLayout.vue";
import { Head, Link } from "@inertiajs/vue3";

defineProps({
    region: {
        type: [Object, null],
        default: null
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
                        ? route('region.venue.index', {region: region.id})
                        : route('venue.index')
                    "
                >
                    <i class="fa-solid fa-chevron-left" />
                    <template v-if="region">
                        Back to {{ region.name }} Venues
                    </template>
                    <template v-else>
                        Back to Venue Index
                    </template>
                </Link>
            </span>
        </template>

        <Head :title="venue.name" />

        <div class="flex-1 flex flex-col space-y-4">
            <div class="shadow border border-gray-100 rounded-lg p-3 space-y-3">
                <Link
                    :href="route('venue.show', venue.id)"
                    class="text-2xl font-bold"
                >
                    {{ venue.name }} |
                    {{ venue.region?.name ?? "Unknown Region" }}
                </Link>
                <hr />
                <h6 class="text-l font-bold">Description</h6>
                <p class="font-normal" v-text="venue.description" />
                <hr />
                <h6 class="text-l font-bold">Notes</h6>
                <p class="font-normal" v-text="venue.notes" />
                <hr />
                <span class="grid grid-cols-4 divide-x-2">
                    <p
                        class="text-center"
                        v-text="`Max seats: ${venue.maximum_seats}`"
                    />
                    <p
                        class="text-center"
                        v-text="
                            `Max wheelchair seats: ${venue.maximum_wheelchair_seats}`
                        "
                    />
                    <p
                        class="text-center"
                        v-text="
                            `Dressing rooms: ${venue.number_of_dressing_rooms}`
                        "
                    />
                    <p
                        class="text-center"
                        v-text="
                            `Wheelchairs backstage? ${
                                venue.backstage_wheelchair_access ? 'Yes' : 'No'
                            }`
                        "
                    />
                </span>
                <hr />
                <span class="flex flex-row items-start space-x-3">
                    <p class="font-normal" v-text="`Stage dimensions:`" />
                    <ul>
                        <li v-text="`W: ${venue.maximum_stage_width}mm`" />
                        <li v-text="`H: ${venue.maximum_stage_height}mm`" />
                        <li v-text="`D: ${venue.maximum_stage_depth}mm`" />
                    </ul>
                </span>
            </div>

            <div class="shadow border border-gray-100 rounded-lg p-3 space-y-3">
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

            <div class="shadow border border-gray-100 rounded-lg p-3 space-y-3">
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
