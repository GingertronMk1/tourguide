<script setup>
import { useForm, usePage } from "@inertiajs/vue3";

const props = defineProps({
    assetableClass: {
        type: String,
        required: true,
    },
    assetableId: {
        type: [String, Number],
        required: true,
    },
    existingAssets: {
        type: Array,
        default: () => [],
    },
});

const assetTypes = usePage()?.props?.util?.asset_types ?? [];

const form = useForm({
    title: "",
    file: null,
    type: Object.keys(assetTypes)[0],
    assetable_type: props.assetableClass,
    assetable_id: props.assetableId,
    redirect: route(route().current(), route().params),
});

function submit() {
    form.post(route("asset.store"), {
        onSuccess: () => form.reset(),
    });
}

function addFileToForm({
    target: {
        files: [file],
    },
}) {
    console.table(file);
    form.title = file.name;
    form.file = file;
}
</script>
<template>
    <div class="grid grid-cols-4 gap-2">
        <div
            v-for="asset in existingAssets"
            :key="asset.id"
            class="card text-center min-h-20 flex flex-col items-stretch space-y-2"
        >
            <a
                class="flex flex-row justify-center items-center flex-1"
                :href="asset.file_url"
                target="_blank"
            >
                <i
                    v-if="asset.thumbnail_url.type === 'font-awesome'"
                    :class="`text-9xl ${asset.thumbnail_url.value}`"
                />
                <img
                    v-else-if="asset.thumbnail_url.type === 'url'"
                    :src="asset.thumbnail_url.value"
                    width="200"
                    height="200"
                    class="object-contain"
                />
            </a>
            <span v-text="asset.title" />
            <span v-text="$page.props.util.asset_types[asset.type]" />
        </div>
        <form class="card flex flex-col space-y-2" @submit.prevent="submit">
            <input id="file" type="file" name="file" @input="addFileToForm" />
            <input
                id="title"
                v-model="form.title"
                type="text"
                name="title"
                placeholder="Asset Title"
            />
            <select id="type" v-model="form.type" name="type">
                <option
                    v-for="(type, index) in $page.props.util.asset_types"
                    :key="index"
                    :value="index"
                    v-text="type"
                />
            </select>
            <button type="submit" class="btn-primary">Add Asset</button>
        </form>
    </div>
</template>
