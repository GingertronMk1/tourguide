<script setup>
import { Link, usePage } from "@inertiajs/vue3";
import { ref } from "vue";

const props = defineProps({
    bodyClasses: {
        type: String,
        default: "",
    },
});

let bodyClasses = [
    "p-4 bg-gray-200 flex flex-col flex-1",
    props.bodyClasses,
].join(" ");

const routes = ref([
    { label: "Home", route: "home" },
    { label: "Venues", route: "venue.index" },
    { label: "Regions", route: "region.index" },
    { label: "Areas", route: "area.index" },
]);

if (usePage()?.props?.auth?.user) {
    routes.value.push({ label: "Activity Log", route: "activity-log.index" });
}

const openedMenu = ref(false);
</script>

<template>
    <div class="h-full flex flex-col">
        <header
            class="p-4 bg-white border-b border-gray-100 flex flex-row items-center relative"
        >
            <i :class="`cursor-pointer p-2 fa-solid ${openedMenu ? 'fa-xmark' : 'fa-bars'}`" @click="openedMenu = !openedMenu"/>
            <div class="flex-1">
                <slot name="header" />
            </div>
            <div v-if="$page?.props?.auth?.user">
                <span v-text="$page?.props?.auth?.user.name" />
            </div>
            <div v-else>
                <Link :href="route('login')">Log In</Link>
            </div>
            <div
                :class="`absolute ${openedMenu ? 'flex' : 'hidden'} flex-col w-full top-full left-0 bg-white divide-y-2 shadow-lg`"
            >
                <Link
                    v-for="(routeObject, index) in routes"
                    :key="index"
                    class="p-4 hover:bg-gray-200"
                    :href="route(routeObject.route)"
                >
                    {{ routeObject.label }}
                </Link>
            </div>
        </header>
        <div :class="bodyClasses">
            <slot />
        </div>
    </div>
</template>
