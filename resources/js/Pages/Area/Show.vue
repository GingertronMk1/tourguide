<script setup>
import BaseLayout from "@/Layouts/BaseLayout.vue";
import { Head, Link } from "@inertiajs/vue3";

defineProps({
    area: {
        type: Object,
        required: true,
    },
});
</script>
<template>
    <BaseLayout>
        <template #header>
            <span class="font-semibold text-xl text-gray-800 leading-tight">
                <Link :href="route('area.index')">
                    <i class="fa-solid fa-chevron-left" />
                    Back to Area Index
                </Link>
            </span>
        </template>

        <Head :title="area.name" />

        <div class="flex-1 flex flex-col space-y-4">
            <div
                class="bg-white shadow border border-gray-100 rounded-lg p-3 space-y-3"
            >
                <Link
                    :href="route('area.show', area.id)"
                    class="text-2xl font-bold"
                >
                    {{ area.name }}
                </Link>
                <hr />
                <h6 class="text-l font-bold">Description</h6>
                <p class="font-normal" v-text="area.description" />
                <hr />
                <h6 class="text-l font-bold">Notes</h6>
                <p class="font-normal" v-text="area.notes" />
                <hr />
                <div>
                    <Link
                        class="text-l font-bold"
                        :href="route('area.region.index', area.id)"
                    >
                        See
                        {{
                            area?.regions?.length === 1
                                ? `1 region`
                                : `${area.regions.length} regions`
                        }}
                        <i class="fa-solid fa-chevron-right" />
                    </Link>
                </div>
            </div>
        </div>
    </BaseLayout>
</template>
