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
    <div class="card mb-3">
        <img
            v-if="venue.main_photo"
            :src="venue.main_photo.file_url"
            class="card-img-top"
            alt="..."
        />
        <div class="card-header d-flex flex-row align-items-center">
            <Link v-if="href != ''" :href="href" class="fs-3 fw-bold">
                {{ cardTitle }}
            </Link>
            <template v-else>
                {{ cardTitle }}
            </template>
            <span class="ms-auto d-flex flex-row nowrap align-items-center">
                <template v-if="$page?.props?.auth?.user">
                    <Link
                        :href="route('venue.edit', venue)"
                        class="btn btn-primary ms-1 d-flex align-items-center"
                    >
                        Edit
                    </Link>
                    <span class="btn btn-danger ms-1 d-flex align-items-center"
                        >Delete</span
                    >
                </template>
                <a
                    :href="route('venue.pdf', venue)"
                    class="btn btn-primary ms-1 d-flex align-items-center"
                    target="_blank"
                >
                    <i class="fa-solid fa-file-pdf" /> PDF
                </a>
            </span>
        </div>
        <div class="list-group list-group-flush">
            <div class="list-group-item">
                <h6 class="text-l font-bold">Description</h6>
                {{ venue.description }}
            </div>
            <div class="list-group-item">
                <h6 class="text-l font-bold">Notes</h6>
                {{ venue.notes }}
            </div>

            <div class="list-group-item d-flex">
                <div class="col-3" v-text="`Stage dimensions:`" />
                <div
                    class="col-3"
                    v-text="`W: ${venue.maximum_stage_width}mm`"
                />
                <div
                    class="col-3"
                    v-text="`H: ${venue.maximum_stage_height}mm`"
                />
                <div
                    class="col-3"
                    v-text="`D: ${venue.maximum_stage_depth}mm`"
                />
            </div>
            <div class="list-group-item d-flex">
                <div
                    class="col-3"
                    v-text="`Max seats: ${venue.maximum_seats}`"
                />
                <div
                    class="col-3"
                    v-text="
                        `Max wheelchair seats: ${venue.maximum_wheelchair_seats}`
                    "
                />
                <div
                    class="col-3"
                    v-text="`Dressing rooms: ${venue.number_of_dressing_rooms}`"
                />
                <div
                    class="col-3"
                    v-text="
                        `Wheelchairs backstage? ${
                            venue.backstage_wheelchair_access ? 'Yes' : 'No'
                        }`
                    "
                />
            </div>
        </div>
    </div>
</template>
