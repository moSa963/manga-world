<script setup lang="ts">
import CircularProgress from '@/Components/CircularProgress.vue';
import { Chapter, Series } from '@/types';
import ListItem from './ListItem.vue';
import { computed } from 'vue';


const props = defineProps<{
    series: Series,
    chapters?: Array<Chapter> | null,
    revers?: boolean,
}>();


const c = computed(() => {
    if (props.revers) {
        return "flex flex-col-reverse gap-[2px]";
    }
    return "flex flex-col gap-[2px]";
});

</script>

<template>
    <div v-if="chapters" :class="c">
        <ListItem v-for="chapter in chapters" :chapter="chapter" :series="series" />
    </div>
    <CircularProgress v-else class="size-16" />
</template>