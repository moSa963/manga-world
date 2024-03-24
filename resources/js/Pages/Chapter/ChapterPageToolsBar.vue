<script setup lang="ts">
import GroupButton from '@/Components/ButtonGroup/ButtonGroup.vue';
import Button from '@/Components/ButtonGroup/Button.vue';
import ArrowLeftIcon from 'vue-material-design-icons/ArrowLeft.vue';
import { Link, router } from '@inertiajs/vue3';
import { Chapter, Series } from '@/types';

const p = defineProps<{
    series: Series,
    chapter: Chapter,
    next: number | null,
    prev: number | null,
}>();

const goTo = (number: number | null) => {
    router.get(route('chapter.show', {
        series: p.series.id,
        chapter: number
    }));
}
</script>

<template>
    <div class="w-full border-b-[1px] bg-surface-0 rounded-xl flex items-center max-w-6xl">
        <Link :href="route('series.show', {
            series: series.id
        })">
        <Button>
            <ArrowLeftIcon />
        </Button>
        </Link>
        <div class="flex-grow flex justify-center items-center">
            <p class="font-bold text-xl">Chapter {{ chapter.number }}</p>
        </div>
        <GroupButton class="pointer-events-auto">
            <Button :disabled="prev === null" :title="prev" @click="() => goTo(prev)">
                <p>Previous</p>
            </Button>
            <Button :disabled="next === null" :title="next" @click="() => goTo(next)">
                <p>Next</p>
            </Button>
        </GroupButton>
    </div>
</template>