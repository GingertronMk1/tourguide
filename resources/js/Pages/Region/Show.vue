<script setup>
import BaseLayout from "@/Layouts/BaseLayout.vue";
import { Head, Link } from "@inertiajs/vue3";

defineProps({
    area: {
        type: [Object, null],
        default: null,
    },
    region: {
        type: Object,
        required: true,
    },
});
</script>
<template>
    <BaseLayout>
        <template #header>
            <span class="font-semibold text-xl text-gray-800 leading-tight">
                <Link
                    :href="
                        area?.id
                            ? route('area.region.index', { area: area.id })
                            : route('region.index')
                    "
                >
                    <i class="fa-solid fa-chevron-left" />
                    <template v-if="area">
                        Back to {{ area.name }} Regions
                    </template>
                    <template v-else> Back to Region Index </template>
                </Link>
            </span>
        </template>

        <Head :title="region.name" />

        <div class="flex-1 flex flex-col space-y-4">
            <div class="card space-y-3">
                <Link
                    :href="route('region.show', region.id)"
                    class="text-2xl font-bold"
                >
                    {{ region.name }} |
                    {{ region.area?.name ?? "Unknown Area" }}
                </Link>
                <hr />
                <h6 class="text-l font-bold">Description</h6>
                <p class="font-normal" v-text="region.description" />
                <hr />
                <h6 class="text-l font-bold">Notes</h6>
                <p class="font-normal" v-text="region.notes" />
                <hr />
                <div>
                    <Link
                        class="text-l font-bold"
                        :href="route('venue.index', {regions: [region.id]})"
                    >
                        See
                        {{
                            region.venues?.length === 1
                                ? `1 theatre`
                                : `${region.venues.length} theatres`
                        }}
                        <i class="fa-solid fa-chevron-right" />
                    </Link>
                </div>
            </div>
        </div>
    </BaseLayout>
</template>
