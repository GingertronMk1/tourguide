<script setup>
import VenueCard from "@/Components/Venue/VenueCard.vue";
import BaseLayout from "@/Layouts/BaseLayout.vue";
import { Head, router, Link } from "@inertiajs/vue3";
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
                seatsMax: null,
                seatsMin: null,
            };
        },
    },
    minMaxValues: {
        type: Object,
        default: () => {},
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

function applyFilters() {
    const newQuery = {
        ...query.value,
        page: 1,
    };
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
</script>
<template>
    <BaseLayout body-classes="overflow-y-hidden">
        <Head title="Venues" />

        <div class="row">
            <div id="filters" class="col-3">
                <!-- Forward and back buttons -->
                <div class="grid text-center mb-3" style="--bs-columns: 3">
                    <Link
                        :class="{
                            'btn btn-primary': true,
                            disabled: !venuePaginator.prev_page_url,
                        }"
                        :href="venuePaginator.prev_page_url"
                    >
                        <i class="fa-solid fa-chevron-left mr-2" />
                    </Link>
                    <span
                        class="d-flex flex-column justify-content-center"
                        v-text="
                            `${venuePaginator.current_page}/${venuePaginator.last_page}`
                        "
                    />
                    <Link
                        :class="{
                            'btn btn-primary': true,
                            disabled: !venuePaginator.next_page_url,
                        }"
                        :href="venuePaginator.next_page_url"
                    >
                        <i class="fa-solid fa-chevron-right ml-2" />
                    </Link>
                </div>

                <!-- Deal Types -->
                <div class="col mb-3">
                    <label class="form-label">Deal Types</label>
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
                <!-- Access Equipment -->
                <div class="col mb-3">
                    <label class="form-label">Access Equipment</label>
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
                <!-- Region -->
                <div class="col mb-3">
                    <label class="form-label">Regions</label>
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

                <!-- Venue Type -->
                <div class="col mb-3">
                    <label class="form-label">Venue Types</label>
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

                <!-- Seats min/max -->
                <div
                    v-for="(label, value) in minMaxValues"
                    :key="value"
                    class="col mb-3"
                >
                    <div class="row">
                        <div class="col-12 form-label" v-text="label" />
                        <div class="col-6">
                            <input
                                :id="`${value}Min`"
                                v-model="query[`${value}Min`]"
                                type="number"
                                :name="`${value}Min`"
                                class="form-control"
                                placeholder="Minimum"
                            />
                        </div>
                        <div class="col-6">
                            <input
                                :id="`${value}Max`"
                                v-model="query[`${value}Max`]"
                                type="number"
                                :name="`${value}Max`"
                                class="form-control"
                                placeholder="Maximum"
                            />
                        </div>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="col mb-3">
                    <div class="row">
                        <div class="col-6">
                            <button
                                class="btn btn-primary"
                                @click="applyFilters"
                                v-text="`Apply Filters`"
                            />
                        </div>

                        <div class="col-6">
                            <button
                                class="btn btn-danger"
                                @click="resetFilters"
                                v-text="`Reset Filters`"
                            />
                        </div>
                    </div>
                </div>
            </div>

            <!--
                Venues
            -->
            <div class="col">
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
