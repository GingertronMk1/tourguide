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
        <span
            class="text-2xl font-bold flex flex-row items-center justify-between"
        >
            <Link v-if="href != ''" :href="href" class="text-2xl font-bold">
                {{ cardTitle }}
            </Link>
            <template v-else>
                {{ cardTitle }}
            </template>
            <span
                v-if="$page?.props?.auth?.user"
                class="flex flex-row justify-end space-x-2"
            >
                <Link :href="route('venue.edit', venue)" class="btn-primary">
                    Edit
                </Link>
                <span class="btn-caution">Delete</span>
            </span>
        </span>
        <hr />
        <div class="grid grid-cols-2 gap-y-2">
            <span>
                <h6 class="text-l font-bold">Description</h6>
                <p class="font-normal" v-text="venue.description" />
            </span>
            <a
                v-if="venue.main_photo?.file_url"
                class="w-full h-80 row-span-2 bg-no-repeat bg-center bg-contain"
                :style="{
                    'background-image': `url(${venue.main_photo.file_url})`,
                }"
                :href="venue.main_photo.file_url"
                target="_blank"
            />
            <span>
                <h6 class="text-l font-bold">Notes</h6>
                <p class="font-normal" v-text="venue.notes" />
            </span>
        </div>
        <hr />

        <div class="grid grid-cols-2">
            <span class="flex flex-row items-start space-x-3">
                <p class="font-normal" v-text="`Stage dimensions:`" />
                <ul>
                    <li v-text="`W: ${venue.maximum_stage_width}mm`" />
                    <li v-text="`H: ${venue.maximum_stage_height}mm`" />
                    <li v-text="`D: ${venue.maximum_stage_depth}mm`" />
                </ul>
            </span>
            <span class="grid grid-cols-2 divide-2 items-center">
                <p v-text="`Max seats: ${venue.maximum_seats}`" />
                <p
                    v-text="
                        `Max wheelchair seats: ${venue.maximum_wheelchair_seats}`
                    "
                />
                <p
                    v-text="`Dressing rooms: ${venue.number_of_dressing_rooms}`"
                />
                <p
                    v-text="
                        `Wheelchairs backstage? ${
                            venue.backstage_wheelchair_access ? 'Yes' : 'No'
                        }`
                    "
                />
            </span>
        </div>
    </div>
</template>
