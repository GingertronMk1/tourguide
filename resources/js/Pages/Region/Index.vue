<script setup>
import BaseLayout from "@/Layouts/BaseLayout.vue";
import { Head, Link } from "@inertiajs/vue3";

const props = defineProps({
    regions: {
        type: Array,
        default: () => [],
    },
    area: {
        type: [Object, null],
        default: null,
    },
});

const headerText = props?.area ? `Regions in ${props.area.name}` : `Regions`;
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
                v-for="region in regions"
                :key="region.id"
                class="shadow border border-gray-100 rounded-lg p-3 space-y-3"
            >
                <Link
                    :href="
                        area
                            ? route('area.region.show', {
                                  region: region.id,
                                  area: area.id,
                              })
                            : route('region.show', region.id)
                    "
                    class="text-2xl font-bold"
                >
                    {{ region.name }}
                </Link>
                <hr />
                <h6 class="text-l font-bold">Description</h6>
                <p class="font-normal" v-text="region.description" />
                <hr />
                <h6 class="text-l font-bold">Notes</h6>
                <p class="font-normal" v-text="region.notes" />
                <hr />
                <p
                    class="font-normal"
                    v-text="
                        region?.venues?.length === 1
                            ? `1 theatre`
                            : `${region.venues.length} theatres`
                    "
                />
            </div>
        </div>
    </BaseLayout>
</template>
