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
    <ClickScale class="bg-surface-100 cursor-pointer hover:bg-surface-200 select-none" :scale="0.99">
        <Link :href="route('chapter.show', { series: series.id, chapter: chapter.number, })">
        <div class="w-full p-2 flex justify-between">
            <p>{{ chapter.number }} - {{ chapter.title }}</p>
            <p>{{ chapter.releaseDate }}</p>
        </div>
        </Link>
    </ClickScale>
</template>