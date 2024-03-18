<script setup lang="ts">
import { ScrollType } from '@/Components/WindowScroll.vue';
import { Series } from '@/types';
import { interpolate } from '@/utils/Interpolator';

defineProps<{
    series: Series,
    scroll?: ScrollType
}>();

</script>



<template>
    <div class="relative flex-1 overflow-hidden">
        <div class="absolute inset-0 flex flex-col">
            <div class="bg-surface-100"
                :style="{ transform: `translateY(${interpolate(scroll?.value, [100, 200], [0, 50])}%)`, }">
                <p class="font-extrabold font-serif text-lg sm:text-2xl md:text-4xl p-1 md:p-3">{{ series.title }}</p>
                <hr />
            </div>
            <div class="bg-surface-200 flex-1 overflow-hidden p-2 md:p-5"
                :style="{ opacity: `${interpolate(scroll?.value, [100, 200], [1, 0])}`, }">
                <div class="w-full flex justify-between mb-3">
                    <p
                        :class="`p-1 rounded-md ${series.status !== 'stopped' ? 'bg-red-500/25' : 'bg-primary-500/25'} font-extrabold`">
                        {{ series.status }}</p>
                    <p class="text-primary-100 font-extrabold">{{ new
                    Date(series.release_date).getFullYear()
                        }}</p>
                </div>
                <p class="text-sm sm:text-xl">{{ series.description }}</p>
            </div>
        </div>
    </div>
</template>