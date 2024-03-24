<script setup lang="ts">
import WindowScroll, { ScrollType } from '@/Components/WindowScroll.vue';
import { Series } from '@/types';
import { interpolate } from '@/utils/Interpolator';
import { ref } from 'vue';
import BannerImage from './BannerImage.vue';
import BannerInfo from './BannerInfo.vue';


defineProps<{
    series: Series,
}>();

const scroll = ref<ScrollType>({
    value: 0,
    ratio: 0,
    innerHeight: 0,
});
const handleChange = (v: ScrollType) => {
    scroll.value = v;
}
</script>


<template>
    <WindowScroll @change="handleChange">
        <div class="relative w-full bg-inherit flex rounded-xl sm:rounded-2xl overflow-hidden" :style="{
        transform: `translateY(${interpolate(scroll.value, [50, 200], [0, 200 - 50])}px)`,
        marginBottom: `${interpolate(scroll.value, [55, 200], [0, 200 - 55])}px`
    }">

            <BannerImage :src="route('api.series.poster', series.id)" :scroll="scroll" />

            <BannerInfo :series="series" :scroll="scroll" />

        </div>
    </WindowScroll>
</template>