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
    (newQuery, oldQuery) => {
        if (parseInt(oldQuery.page) === parseInt(newQuery.page)) {
            newQuery.page = 1;
        }
        router.get(
            route("venue.index", {
                _query: newQuery,
            })
        );
    },
    { deep: true }
);

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
    query.value = {
        ...query.value,
        page: parseInt(page) - 1,
    };
}

function incrementPage() {
    const { page } = query.value;
    query.value = {
        ...query.value,
        page: parseInt(page) + 1,
    };
}
</script>
<template>
    <BaseLayout
        body-classes="overflow-y-hidden"
    >
        <template #header>
            <h2
                class="font-semibold text-xl text-gray-800 leading-tight"
                v-text="'Venues'"
            />
        </template>

        <Head title="Venues" />

        <div class="flex flex-row flex-1 overflow-y-hidden space-x-3">

        <!--
                Filtering by access and deal types
            -->
        <div class="flex flex-col overflow-y-scroll max-w-[33%] space-y-3">
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
            <div class="card">
                <div class="font-bold">Deal Types</div>
                <select
                    id="dealTypes"
                    v-model="query.dealTypes"
                    name="dealTypes"
                    multiple
                    class="rounded-md w-full"
                >
                    <option
                        v-for="dealType in dealTypes"
                        :key="dealType.id"
                        :value="dealType.id"
                        v-text="dealType.name"
                    />
                </select>
            </div>
            <div class="card">
                <div class="font-bold">Access Equipment</div>
                <select
                    id="accessEquipment"
                    v-model="query.accessEquipment"
                    name="accessEquipment"
                    multiple
                    class="rounded-md w-full"
                >
                    <option
                        v-for="access in accessEquipment"
                        :key="access.id"
                        :value="access.id"
                        v-text="access.name"
                    />
                </select>
            </div>
            <div class="card">
                <div class="font-bold">Regions</div>
                <select
                    id="regions"
                    v-model="query.regions"
                    name="regions"
                    multiple
                    class="rounded-md w-full"
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
            <div
                class="card bg-blue-700 text-white font-bold text-center cursor-pointer"
                @click="resetFilters"
            >
                Reset Filters
            </div>
        </div>

        <!--
                Venues
            -->
        <div
            class="overflow-y-scroll space-y-3 flex-1 max-h-full overflow-y-scroll"
        >
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
