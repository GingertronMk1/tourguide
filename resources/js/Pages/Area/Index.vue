<script setup>
import BaseLayout from "@/Layouts/BaseLayout.vue";
import { Head, Link } from "@inertiajs/vue3";

defineProps({
    areas: {
        type: Array,
        default: () => [],
    },
});

const headerText = "Areas";
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
            <div v-for="area in areas" :key="area.id" class="card space-y-3">
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
                <p
                    class="font-normal"
                    v-text="
                        area?.regions?.length === 1
                            ? `1 region`
                            : `${area.regions.length} regions`
                    "
                />
            </div>
        </div>
    </BaseLayout>
</template>
