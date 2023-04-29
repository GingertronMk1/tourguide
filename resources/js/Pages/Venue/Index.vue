<script setup>
import VenueCard from "@/Components/VenueCard.vue";
import BaseLayout from "@/Layouts/BaseLayout.vue";
import { Head, router } from "@inertiajs/vue3";
import { ref, watch } from "vue";

const props = defineProps({
    venuePaginator: {
        type: Object,
        default: () => {},
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
    query: {
        type: Object,
        default: () => {
            return {
                accessEquipment: [],
                dealTypes: [],
                page: 1,
                regions: [],
            };
        },
    },
});

const query = ref(props.query);

watch(
    () => query.value,
    (newQuery) => {
        router.get(
            route("venue.index", {
                _query: newQuery,
            })
        );
    },
    { deep: true }
);
</script>
<template>
    <BaseLayout>
        <template #header>
            <h2
                class="font-semibold text-xl text-gray-800 leading-tight"
                v-text="'Venues'"
            />
        </template>

        <Head title="Venues" />

        <div class="flex-1 flex flex-col space-y-4">
            <!--
                Filtering by access and deal types
            -->
            <div class="card grid grid-cols-3 gap-x-3">
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
                <select
                    id="regions"
                    v-model="query.regions"
                    name="regions"
                    multiple
                    class="rounded-md"
                >
                    <template v-for="area in areas" :key="area.id">
                        <option disabled v-text="area.name" />
                        <option
                            v-for="region in area.regions"
                            :key="region.id"
                            :value="region.id"
                            class="ps-2"
                            v-text="`  ${region.name}`"
                        />
                    </template>
                </select>
            </div>

            <!--
                Venues
            -->
            <VenueCard
                v-for="venue in venuePaginator.data"
                :key="venue.id"
                :venue="venue"
                :href="
                    route('venue.show', {
                        venue,
                        query,
                    })
                "
            />

            <div class="card flex flex-row justify-between">
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
