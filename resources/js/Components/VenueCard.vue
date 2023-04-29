<script setup>
import { Link } from "@inertiajs/vue3";
const props = defineProps({
    venue: {
        type: Object,
        required: true,
    },
    href: {
        type: String,
        default: "",
    },
});

const cardTitle = [
    props.venue.name,
    props.venue.venue_type?.name ?? "Unknown Venue Type",
    props.venue.region?.name ?? "Unknown Region",
].join(" | ");
</script>
<template>
    <div class="card space-y-3">
        <span class="text-2xl font-bold">
            <Link v-if="href != ''" :href="href" class="text-2xl font-bold">
                {{ cardTitle }}
            </Link>
            <template v-else>
                {{ cardTitle }}
            </template>
        </span>
        <hr />
        <h6 class="text-l font-bold">Description</h6>
        <p class="font-normal" v-text="venue.description" />
        <hr />
        <h6 class="text-l font-bold">Notes</h6>
        <p class="font-normal" v-text="venue.notes" />
        <hr />
        <span class="grid grid-cols-4 divide-x-2 items-center">
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
                v-text="`Dressing rooms: ${venue.number_of_dressing_rooms}`"
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
</template>
