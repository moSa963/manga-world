<script setup lang="ts">
import Button from '@/Components/ButtonGroup/Button.vue';
import TextInput from '@/Components/Input/TextInput/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import AppLayout from '@/Layouts/AppLayout/AppLayout.vue';
import { useForm } from '@inertiajs/vue3';
import PageInput from './PageInput.vue';
import SeriesBanner from '../Series/SeriesBanner/SeriesBanner.vue';
import { Series } from '@/types';

const props = defineProps<{
    series: Series,
    number: string,
}>();

const form = useForm({
    title: '',
    number: props.number,
    release_date: new Date().toISOString().substring(0, 10),
    pages: [],
});

const handleSave = async () => {
    form.post(route('chapter.store', { series: props.series.id }));
}


</script>


<template>
    <AppLayout title="Add chapter">
        <div class="w-full max-w-7xl">
            <SeriesBanner :series="series" />
            <div class="relative w-full bg-surface-50 overflow-hidden my-5 flex flex-col gap-6 px-4">
                <div class="h-full w-full flex-1 overflow-hidden flex flex-col">
                    <TextInput type="text" class="block w-full" :error="form.errors.title" v-model="form.title"
                        placeholder="Title..." label="Title" />
                </div>
                <div class="w-full flex gap-2 flex-wrap items-center">
                    <TextInput type="number" class="block w-full" :error="form.errors.number" v-model="form.number"
                        placeholder="Title..." label="Number: " />
                </div>
                <div class="w-full flex gap-2 flex-wrap items-center">
                    <InputLabel value="Release date: " />
                    <input type="date" class="bg-inherit" v-model="form.release_date" />
                </div>
            </div>

            <PageInput v-model="form.pages" />

            <Button @click="handleSave" class="my-4 mb-[50vh]" border value="Save" />
        </div>
    </AppLayout>
</template>
