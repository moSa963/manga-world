<script setup lang="ts">
import AdministrationLayout from '@/Layouts/AdministrationLayout/AdministrationLayout.vue';
import { onMounted, ref } from 'vue';
import GenreListItem from './GenreListItem.vue';
import Button from '@/Components/ButtonGroup/Button.vue';
import apiRequest from '@/utils/ApiRequest';

const data = ref<string[]>([]);
const input = ref<string>();
const processing = ref<boolean>(false);

const getData = async () => {
    const res = await fetch(route("api.genres.list"));

    if (res.ok) {
        data.value = await res.json();
    }
}

onMounted(async () => {
    await getData();
});

const handleAdd = async () => {
    const value = input.value?.trim();

    if (processing.value || value == "") return;
    processing.value = true;

    const res = await apiRequest(route('api.genres.store'), "POST", {
        name: value
    });

    if (res.ok) {
        data.value.push(value ?? '');
        input.value = "";
    }

    processing.value = false;
}

const handleDelete = async (genre: string) => {
    const res = await apiRequest(route('api.genres.delete', { genre }), "DELETE",);

    if (res.ok) {
        data.value = data.value.filter(v => v != genre);
    }
}
</script>

<template>
    <AdministrationLayout selected="genres">
        <div class="w-full flex justify-center pt-24">
            <div class="w-full max-w-3xl">
                <div class="w-full flex border-[1px] border-divider/30">
                    <div class="w-full overflow-hidden flex">
                        <input placeholder="Genre..." type="text" v-model="input"
                            class="flex-1 bg-inherit border-none -m-2" />
                    </div>
                    <Button class="rounded-none" value="Add" @click="handleAdd" />
                </div>
                <GenreListItem v-for="v in data" :genre="v" @delete="handleDelete" />
            </div>
        </div>
    </AdministrationLayout>
</template>