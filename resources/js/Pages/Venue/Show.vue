<script setup>
import BaseLayout from '@/Layouts/BaseLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

  defineProps({ venue: Object })
</script>
<template>
    <BaseLayout>
        <template #header>
            <Link :href="route('venue.index')" class="font-semibold text-xl text-gray-800 leading-tight">
                <i class="fa-solid fa-chevron-left" />
                Back to Venue Index
            </Link>
        </template>

        <Head :title="venue.name" />

        <div class="flex-1 flex flex-col space-y-4">
            <div class="border border-gray-100 rounded-lg p-3 space-y-3">
                <Link
                    :href="route('venue.show', venue.id)"
                    v-text="`${venue.name} | ${venue.region?.name ?? 'Unknown Region'}`"
                    class="text-2xl font-bold"
                />
                <hr />
                <h6 class="text-l font-bold">Description</h6>
                <p class="font-normal" v-text="venue.description" />
                <hr />
                <h6 class="text-l font-bold">Notes</h6>
                <p class="font-normal" v-text="venue.notes" />
                <hr />
                <span class="grid grid-cols-4 divide-x-2">
                    <p class="text-center" v-text="`Max seats: ${venue.maximum_seats}`" />
                    <p class="text-center" v-text="`Max wheelchair seats: ${venue.maximum_wheelchair_seats}`" />
                    <p class="text-center" v-text="`Dressing rooms: ${venue.number_of_dressing_rooms}`" />
                    <p class="text-center" v-text="`Wheelchairs backstage? ${venue.backstage_wheelchair_access ? 'Yes' : 'No'}`" />
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


            <div class="border border-gray-100 rounded-lg p-3 space-y-3">
                <p class="text-2xl font-bold">Access Equipment</p>
                    <ul v-if="venue.access_equipment.length">
                        <li v-for="equipment in venue.access_equipment" :key="equipment.id">
                            {{ equipment.name }}
                            <template v-if="equipment?.pivot?.notes"> | {{ equipment.pivot.notes }}</template>
                        </li>
                    </ul>
            </div>

            <div class="border border-gray-100 rounded-lg p-3 space-y-3">
                <p class="text-2xl font-bold">Deal Types</p>
                    <ul>
                        <li v-for="(type, index) in venue.deal_types" :key="index">
                            {{ type.name }}
                            <template v-if="type?.pivot?.notes"> | {{ type.pivot.notes }}</template>
                        </li>
                    </ul>
            </div>
        </div>
    </BaseLayout>
</template>
