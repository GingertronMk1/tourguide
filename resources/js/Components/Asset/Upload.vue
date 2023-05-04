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
    file: null,
    type: Object.keys(assetTypes)[0],
    assetable_type: props.assetableClass,
    assetable_id: props.assetableId,
    redirect: route(route().current(), route().params),
});

function submit() {
    form.post(route("asset.store"));
}
</script>
<template>
    <div class="grid grid-cols-4 gap-2">
        <div
            v-for="asset in existingAssets"
            :key="asset.id"
            class="card flex flex-col space-y-2"
        >
            <span v-text="asset.type" />
            <span v-text="asset.path" />
            <span v-text="asset.mime_type" />
            <img :src="asset.file_url" width="100" height="100" />
        </div>
        <form class="card" @submit.prevent="submit">
            <input
                id="file"
                type="file"
                name="file"
                @input="form.file = $event.target.files[0]"
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
