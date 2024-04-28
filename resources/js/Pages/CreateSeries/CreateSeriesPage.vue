<script setup lang="ts">
import Button from '@/Components/ButtonGroup/Button.vue';
import InputLabel from '@/Components/InputLabel.vue';
import AppLayout from '@/Layouts/AppLayout/AppLayout.vue';
import { useForm } from '@inertiajs/vue3';
import ImageInput from './ImageInput.vue';
import MultiTextInput from '@/Components/Input/MultiTextInput/MultiTextInput.vue';
import Select from '@/Components/Input/Select.vue';
import Textarea from '@/Components/Input/Textarea.vue';
import TextInput from '@/Components/Input/TextInput/TextInput.vue';

const props = defineProps<{
    types: string[],
    status: string[],
}>();

const form = useForm({
    title: '',
    description: '',
    author: '',
    painter: '',
    type: props.types[0],
    status: props.status[0],
    release_date: '',
    other_names: [],
    poster: '',
});

const handleSave = async () => {
    form.post(route('series.store'));
}

</script>


<template>
    <AppLayout title="Create">
        <div class="w-full max-w-7xl">
            <div
                class="relative h-fit md:h-96 w-full bg-surface-50 flex flex-col md:flex-row overflow-hidden items-center">

                <ImageInput class="h-fit md:h-full w-64 md:w-fit" v-model="form.poster" :error="form.errors.poster" />

                <div class="h-full w-full flex-1 overflow-hidden flex flex-col">
                    <TextInput type="text" class="p-4 mt-1 block w-full" :error="form.errors.title" v-model="form.title"
                        placeholder="Title..." label="Title" />

                    <div class="w-full flex gap-2 flex-wrap px-4">
                        <Select :options="status" v-model="form.status" label="Status:" />
                        <Select :options="types" v-model="form.type" label="Type:" />
                    </div>

                    <div class="flex flex-col flex-1 overflow-hidden p-4">
                        <Textarea placeholder="Description..." label="Description" v-model="form.description"
                            :error="form.errors.description" resize="none" class="w-full min-h-40 flex-1" />
                    </div>
                </div>
            </div>

            <div class="bg-surface-50 w-full p-4 flex gap-2 flex-wrap mt-4">
                <TextInput type="text" class="min-w-80 flex-1 block w-full" v-model="form.author"
                    placeholder="Author..." label="Author:" :error="form.errors.author" />

                <TextInput type="text" class="min-w-80 flex-1 block w-full" v-model="form.painter"
                    placeholder="Painter..." label="Painter:" :error="form.errors.painter" />
            </div>

            <div class="bg-surface-50 w-full p-4 flex gap-2 flex-wrap mt-4 items-center">
                <InputLabel value="Release date: " />
                <input type="date" class="bg-inherit" v-model="form.release_date" />
            </div>

            <div class="bg-surface-50 w-full p-4 mt-4">
                <MultiTextInput v-model="form.other_names" label="Other names" :error="form.errors.other_names" />
            </div>

            <Button @click="handleSave" class="my-4 mb-[50vh]" border value="Save" />
        </div>
    </AppLayout>
</template>
