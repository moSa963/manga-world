<script setup lang="ts">

import Chip from '@/Components/Chip.vue';
import { Chapter, Series } from '@/types';
import { router } from '@inertiajs/vue3';

const props = defineProps<{
    series: Series,
    chapter: Chapter,
}>();

const handleClick = () => {
    router.get(route("chapter.show", {
        series: props.series.id,
        chapter: props.chapter.number,
    }),
    );
}

</script>

<template>
    <Chip @click.capture.prevent="handleClick" class="flex-1 overflow-hidden">
        <p class="text-ellipsis overflow-hidden">{{ chapter.number }}</p>
    </Chip>
</template>