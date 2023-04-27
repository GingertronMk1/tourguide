<script setup>
import BaseLayout from "@/Layouts/BaseLayout.vue";
import { Head, Link, router } from "@inertiajs/vue3";
import { ref, watch } from "vue";

const props = defineProps({
    venuePaginator: {
        type: Object,
        default: () => {},
    },
    region: {
        type: [Object, null],
        default: null,
    },
    accessEquipment: {
        type: Array,
        default: () => [],
    },
    dealTypes: {
        type: Array,
        default: () => [],
    },
    selectedAccessEquipmentProp: {
        type: Array,
        default: () => [],
    },
    selectedDealTypesProp: {
        type: Array,
        default: () => [],
    },
});

const headerText = props?.region ? `Venues in ${props?.region.name}` : "Venues";

const query = ref({
    accessEquipment: props.selectedAccessEquipmentProp,
    dealTypes: props.selectedDealTypesProp,
    page: props?.venuePaginator?.current_page ?? 1,
});

watch(
    () => query.value,
    (newQuery) => {
        if (props?.region?.id) {
        router.get(
            route("region.venue.index", {
                region: props.region.id,
                _query: newQuery,
            })
        );
        } else {
        router.get(
            route("venue.index", {
                _query: newQuery,
            })
        );
        }
    },
    { deep: true }
);
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
                class="shadow border border-gray-100 rounded-lg p-3 bg-white grid grid-cols-2 gap-x-3"
            >
                <select
                    id="dealTypes"
                    v-model="query.dealTypes"
                    name="dealTypes"
                    multiple
                    class="rounded-md"
                >
                    <option
                        v-for="dealType in dealTypes"
                        :key="dealType.id"
                        :value="dealType.id"
                        v-text="dealType.name"
                    />
                </select>
                <select
                    id="accessEquipment"
                    v-model="query.accessEquipment"
                    name="accessEquipment"
                    multiple
                    class="rounded-md"
                >
                    <option
                        v-for="access in accessEquipment"
                        :key="access.id"
                        :value="access.id"
                        v-text="access.name"
                    />
                </select>
            </div>
            <div
                v-for="venue in venuePaginator.data"
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
            <div
                class="shadow border border-gray-100 rounded-lg p-3 bg-white flex flex-row justify-between"
            >
                <span>
                    <template v-if="venuePaginator.current_page > 1">
                        <i class="fa-solid fa-chevron-left" />
                        <button @click="query.page--">Previous</button>
                    </template>
                </span>
                <span
                    v-text="
                        `You are on page ${venuePaginator.current_page} of ${venuePaginator.last_page}`
                    "
                />
                <span>
                    <template
                        v-if="
                            venuePaginator.current_page <
                            venuePaginator.last_page
                        "
                    >
                        <button @click="query.page++">Next</button>
                        <i class="fa-solid fa-chevron-right" />
                    </template>
                </span>
            </div>
        </div>
    </BaseLayout>
</template>
