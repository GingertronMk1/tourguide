<script setup>
import { Link, usePage } from "@inertiajs/vue3";
import { ref } from "vue";

const props = defineProps({
    bodyClasses: {
        type: String,
        default: "",
    },
});

let bodyClassesProcessed = [
    "container",
    "bg-gray",
    "pt-3",
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
</script>

<template>
    <div class="h-full flex flex-col">
        <nav class="navbar navbar-expand-lg bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Navbar</a>
                <button
                    class="navbar-toggler"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent"
                    aria-expanded="false"
                    aria-label="Toggle navigation"
                >
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div
                    id="navbarSupportedContent"
                    class="collapse navbar-collapse"
                >
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li
                            v-for="(routeObject, index) in routes"
                            :key="index"
                            class="nav-item"
                        >
                            <Link
                                class="nav-link"
                                :href="route(routeObject.route)"
                            >
                                {{ routeObject.label }}
                            </Link>
                        </li>
                    </ul>
                    <form class="d-flex" role="search">
                        <input
                            class="form-control me-2"
                            type="search"
                            placeholder="Search"
                            aria-label="Search"
                        />
                        <button class="btn btn-outline-success" type="submit">
                            Search
                        </button>
                    </form>
                </div>
            </div>
        </nav>
        <div :class="bodyClassesProcessed">
            <slot />
        </div>
    </div>
</template>
