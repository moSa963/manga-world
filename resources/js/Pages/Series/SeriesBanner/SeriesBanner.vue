<script setup lang="ts">
import WindowScroll, { ScrollType } from '@/Components/WindowScroll.vue';
import { Series } from '@/types';
import { interpolate } from '@/utils/Interpolator';
import { ref } from 'vue';


defineProps<{
    series: Series,
}>();

const p = ref<ScrollType>({
    value: 0,
    ratio: 0,
    innerHeight: 0,
});
const handleChange = (scroll: ScrollType) => {
    p.value = scroll;
}
</script>


<template>
    <WindowScroll @change="handleChange">
        <div class="relative w-full bg-inherit flex rounded-2xl overflow-hidden" :style="{
        transform: `translateY(${interpolate(p.value, [55, 200], [0, 200 - 55])}px)`,
        marginBottom: `${interpolate(p.value, [55, 200], [0, 200 - 55])}px`
    }">

            <div class="h-full aspect-[2/3] overflow-hidden rounded-2xl rounded-e-none border-[1px] border-primary"
                :style="{ width: `${interpolate(p.value, [55, 100], [22, 10])}%` }">
                <img :src="route('api.series.poster', series.id)"
                    class="rounded-2xl rounded-e-none border-[6px] !border-surface-50" />
            </div>

            <div class="relative flex-1 overflow-hidden">
                <div class="absolute inset-0 flex flex-col">
                    <div class="bg-surface-100"
                        :style="{ transform: `translateY(${interpolate(p.value, [100, 200], [0, 50])}%)`, }">
                        <p class="font-extrabold font-serif text-5xl p-3">{{ series.title }}</p>
                        <hr />
                    </div>
                    <div class="bg-surface-200 flex-1 overflow-hidden p-5"
                        :style="{ opacity: `${interpolate(p.value, [100, 200], [1, 0])}`, }">
                        <p>{{ series.description }}</p>
                    </div>
                </div>
            </div>

        </div>
    </WindowScroll>
</template>