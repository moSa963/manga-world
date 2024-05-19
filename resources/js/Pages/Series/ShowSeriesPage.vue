<script setup lang="ts">
import { ref } from 'vue';
import AppLayout from '../../Layouts/AppLayout/AppLayout.vue';
import ChaptersList from './ChaptersList/ChaptersList.vue';
import SeriesBanner from './SeriesBanner/SeriesBanner.vue';
import { Series, User } from '@/types';
import { Link } from '@inertiajs/vue3';
import Button from '@/Components/ButtonGroup/Button.vue';
import { hasPermission } from '@/utils/Permissions';
const props = defineProps<{
    series: Series,
    auth: {
        user: User
    }
}>();

const seriesRef = ref(props.series);

const handleChange = (series: Series) => {
    seriesRef.value = series;
}
</script>


<template>
    <AppLayout :title="seriesRef.title">
        <div class="w-full max-w-7xl">
            <SeriesBanner :series="seriesRef" @change="handleChange" />
            <div class="w-full flex flex-col sm:flex-row pb-96 pt-11 ">

                <div class="flex-[2] overflow-hidden relative ">
                    <ChaptersList :series="seriesRef" />
                </div>

                <div class="flex-1 flex flex-col items-center">
                    <div v-if="hasPermission(auth.user, 'create')" class="w-full md:w-72 p-1">
                        <Link :href="route('chapter.create', { series: series.id })">
                        <Button border>
                            <p>Add new chapter</p>
                        </Button>
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>