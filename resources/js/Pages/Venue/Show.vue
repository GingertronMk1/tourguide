<script setup>
import BaseLayout from '@/Layouts/BaseLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

  defineProps({ venue: Object })
</script>
<template>
    <BaseLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight" v-text="venue.name" />
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
                <template v-if="venue.access_equipment.length">
                    <ul>
                        <li v-for="(equpiment, index) in venue.access_equipment" :key="index">
                            {{  equpiment.name }}
                        </li>
                    </ul>
                </template>
                <template v-else>
                    <p>This venue does not have any access equipment</p>
                </template>
            </div>

            <div class="border border-gray-100 rounded-lg p-3 space-y-3">
                <p class="text-2xl font-bold">Deal Types</p>
                <template v-if="venue.deal_types.length">
                    <ul>
                        <li v-for="(type, index) in venue.deal_types" :key="index">
                            {{  type.name }}
                        </li>
                    </ul>
                </template>
                <template v-else>
                    <p>This venue does not have any deal types</p>
                </template>
            </div>
        </div>
    </BaseLayout>
</template>
