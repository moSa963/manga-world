<script setup lang="ts">
import { ScrollType } from '@/Components/WindowScroll.vue';
import { Series } from '@/types';
import { interpolate } from '@/utils/Interpolator';
import { getYear } from '@/utils/DateTime';

defineProps<{
    series: Series,
    scroll?: ScrollType
}>();

</script>


<template>
    <div class="relative flex-1 flex flex-col overflow-hidden">
        <div class="bg-surface-100"
            :style="{ transform: `translateY(${interpolate(scroll?.value, [100, 200], [0, 50])}%)`, }">
            <p class="font-extrabold font-serif text-lg sm:text-2xl md:text-4xl p-1 md:p-3">{{ series.title }}</p>
            <hr />
        </div>
        <div class="bg-surface-200 flex-1 overflow-hidden p-2 md:p-5 flex flex-col"
            :style="{ opacity: `${interpolate(scroll?.value, [100, 200], [1, 0])}`, }">
            <div class="w-full flex mb-3 gap-3">
                <p
                    :class="`p-1 rounded-md ${series.status === 'stopped' ? 'bg-red-500/25' : 'bg-primary-500/25'} font-extrabold`">
                    {{ series.status }}</p>
                <p :class="`p-1 rounded-md bg-primary-500/25 font-extrabold`">
                    {{ series.type }}</p>
                <p v-if="!series.published" :class="`p-1 rounded-md bg-primary-500/25 font-extrabold`">
                    unpublished</p>
                <div class="flex-grow"></div>
                <p class="text-primary-100 font-extrabold">{{ getYear(series.releaseDate) }}</p>
            </div>
            <p class="text-sm sm:text-xl flex-1">{{ series.description }}</p>
            <slot />
        </div>
    </div>
</template>