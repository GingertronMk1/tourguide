<script setup>
import BaseLayout from "@/Layouts/BaseLayout.vue";
import { Head, Link } from "@inertiajs/vue3";

const props = defineProps({
    venues: {
        type: Array,
        default: () => [],
    },
    region: {
        type: [Object, null],
        default: null,
    },
});

const headerText = props?.region ? `Venues in ${props?.region.name}` : "Venues";
</script>
<template>
    <BaseLayout>
        <template #header>
            <h2
                class="font-semibold text-xl text-gray-800 leading-tight"
                v-text="headerText"
            />
        </template>

        <Head :title="headerText" />

        <div class="flex-1 flex flex-col space-y-4">
            <div
                v-for="venue in venues"
                :key="venue.id"
                class="shadow border border-gray-100 rounded-lg p-3 space-y-3 bg-white"
            >
                <Link
                    :href="
                        region
                            ? route('region.venue.show', {
                                  region: region.id,
                                  venue: venue.id,
                              })
                            : route('venue.show', venue.id)
                    "
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
        </div>
    </BaseLayout>
</template>