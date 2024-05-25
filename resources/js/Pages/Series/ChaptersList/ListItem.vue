<script setup lang="ts">
import ClickScale from '@/Components/Effects/ClickScale.vue';
import { Chapter, Series } from '@/types';
import { Link } from '@inertiajs/vue3';


defineProps<{
    series: Series,
    chapter: Chapter,
}>();

</script>

<template>
    <ClickScale
        :class="`cursor-pointer select-none ${chapter.published ? 'bg-surface-100 hover:bg-surface-200' : 'bg-primary-100/25 hover:bg-primary-100/15'}`"
        :scale="0.99">
        <Link :href="route('chapter.show', { series: series.id, chapter: chapter.number, })">
        <div class="w-full p-2 flex justify-between">
            <p>{{ chapter.number }} - {{ chapter.title }}</p>
            <p>{{ chapter.releaseDate }}</p>
        </div>
        </Link>
    </ClickScale>
</template>