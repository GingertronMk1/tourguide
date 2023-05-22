<script setup>
import VenueCard from "@/Components/Venue/VenueCard.vue";
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
    venueTypes: {
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
                seatsMax: 10000,
                seatsMin: 0,
            };
        },
    },
});

const query = ref(props.query);

watch(
    () => ({ ...query.value }),
    (newQuery, oldQuery) => {
        const { seatsMax: newSeatsMax, seatsMin: newSeatsMin } = newQuery;
        const { seatsMax: oldSeatsMax, seatsMin: oldSeatsMin } = oldQuery;
        const oldSeatsMaxInt = parseInt(oldSeatsMax);
        const oldSeatsMinInt = parseInt(oldSeatsMin);
        const newSeatsMaxInt = parseInt(newSeatsMax);
        const newSeatsMinInt = parseInt(newSeatsMin);
        if (newSeatsMaxInt < newSeatsMinInt) {
            if (oldSeatsMaxInt !== newSeatsMaxInt) {
                query.value.seatsMin = newSeatsMax - 1;
            } else if (oldSeatsMinInt !== newSeatsMinInt) {
                query.value.seatsMax = newSeatsMin + 1;
            }
        }
    },
    { deep: true }
);

function applyFilters(resetPage = true) {
    const newQuery = {
        ...query.value,
    };
    if (resetPage) {
        newQuery.page = 1;
    }
    router.get(
        route("venue.index", {
            _query: newQuery,
        })
    );
}

function resetFilters() {
    query.value = {
        ...query.value,
        accessEquipment: [],
        dealTypes: [],
        regions: [],
    };
}

function decrementPage() {
    const { page } = query.value;
    query.value.page = parseInt(page) - 1;
    applyFilters(false);
}

function incrementPage() {
    const { page } = query.value;
    query.value.page = parseInt(page) + 1;
    applyFilters(false);
}
</script>
<template>
    <BaseLayout body-classes="overflow-y-hidden">
        <Head title="Venues" />

        <div class="row">
            <!--
                Filtering by access and deal types
            -->
            <div id="filters" class="col-4">
                <div class="card flex flex-row justify-between">
                    <span>
                        <template v-if="venuePaginator.current_page > 1">
                            <i class="fa-solid fa-chevron-left mr-2" />
                            <button @click="decrementPage">Previous</button>
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
                            <button @click="incrementPage">Next</button>
                            <i class="fa-solid fa-chevron-right ml-2" />
                        </template>
                    </span>
                </div>
                <div class="form-group">
                    <div class="form-label">Deal Types</div>
                    <select
                        id="dealTypes"
                        v-model="query.dealTypes"
                        name="dealTypes"
                        multiple
                        class="form-select"
                    >
                        <option
                            v-for="dealType in dealTypes"
                            :key="dealType.id"
                            :value="dealType.id"
                            v-text="dealType.name"
                        />
                    </select>
                </div>
                <div class="form-group">
                    <div class="form-label">Access Equipment</div>
                    <select
                        id="accessEquipment"
                        v-model="query.accessEquipment"
                        name="accessEquipment"
                        multiple
                        class="form-select"
                    >
                        <option
                            v-for="access in accessEquipment"
                            :key="access.id"
                            :value="access.id"
                            v-text="access.name"
                        />
                    </select>
                </div>
                <div class="form-group">
                    <div class="form-label">Regions</div>
                    <select
                        id="regions"
                        v-model="query.regions"
                        name="regions"
                        multiple
                        class="form-select"
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
                <div class="form-group">
                    <div class="form-label">Venue Types</div>
                    <select
                        id="venueTypes"
                        v-model="query.venueTypes"
                        name="venueTypes"
                        multiple
                        class="form-select"
                    >
                        <option
                            v-for="venueType in venueTypes"
                            :key="venueType.id"
                            :value="venueType.id"
                            v-text="venueType.name"
                        />
                    </select>
                </div>
                <div class="form-group">
                    <div class="font-bold">Seats</div>
                    <div class="grid grid-cols-2 gap-x-2">
                        <div class="flex flex-col">
                            <span>Minimum</span>

                            <input
                                id="seatsMin"
                                v-model="query.seatsMin"
                                type="number"
                                name="seatsMin"
                                min="0"
                                :max="query.seatsMax"
                            />
                        </div>
                        <div class="flex flex-col">
                            <span>Maximum</span>

                            <input
                                id="seatsMax"
                                v-model="query.seatsMax"
                                type="number"
                                name="seatsMax"
                                :min="query.seatsMin"
                                max="10000"
                            />
                        </div>
                    </div>
                </div>

                <div class="flex flex-row space-x-2">
                    <button
                        class="btn-primary flex-1"
                        @click="applyFilters"
                        v-text="`Apply Filters`"
                    />

                    <button
                        class="btn-caution flex-1"
                        @click="resetFilters"
                        v-text="`Reset Filters`"
                    />
                </div>
            </div>

            <!--
                Venues
            -->
            <div class="col-8">
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
            </div>
        </div>
    </BaseLayout>
</template>
