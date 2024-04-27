<script setup lang="ts">
import Accordion from '@/Components/Accordion.vue';
import PublishSeriesButton from '@/Components/Actions/PublishSeriesButton.vue';
import Button from '@/Components/ButtonGroup/Button.vue';
import Chip from '@/Components/Chip.vue';
import ListItem from '@/Components/ListItem.vue';
import { Series } from '@/types';
import { Link } from '@inertiajs/vue3';
import { getDate } from '@/utils/DateTime';

const p = defineProps<{
    series: Series,
}>();

defineEmits<{
    seriesUpdate: [series: Series],
}>();

</script>
<template>
    <Accordion :class="`${series.published ? 'bg-surface-100' : 'bg-primary-400/10'}`">
        <template #head>
            <ListItem :src="route('api.series.poster', series.id)" disabled :title="series.title"
                :secondary="series.author" />
        </template>

        <div class="w-full p-4 flex flex-col gap-3">
            <div class="flex gap-2 items-center">
                <Chip class="border-0 bg-primary-500/25">{{ series.status }}</Chip>
                <Chip class="border-0 bg-primary-500/25">{{ series.type }}</Chip>
                <div class="flex-grow"></div>
                <Link :href="route('series.show', { series: series.id })">
                <Button class="h-fit" value="open" />
                </Link>
            </div>

            <div class="p-2 bg-surface-300/50 rounded-lg">
                {{ series.description }}
            </div>

            <div class="flex gap-2 flex-wrap bg-surface-300/50 rounded-lg p-2">
                <p class="text-divider">Created by: </p>
                <Chip class="border-none">
                    {{ series.user.name }}
                </Chip>
                <p class="text-divider">_ {{ getDate(series.releaseDate) }}</p>
            </div>

            <div class="flex gap-2 flex-wrap bg-surface-300/50 rounded-lg p-2">
                <p class="text-divider">Other names: </p>
                <Chip v-for="(name, i) in series.otherNames" :key="i">
                    {{ name }}
                </Chip>
            </div>

            <PublishSeriesButton @change="(v) => $emit('seriesUpdate', v)" :series="series" />
        </div>
    </Accordion>
</template>