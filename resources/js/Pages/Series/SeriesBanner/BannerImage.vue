<script setup lang="ts">
import { ScrollType } from '@/Components/WindowScroll.vue';
import { ScreenInfo } from '@/types';
import { interpolate } from '@/utils/Interpolator';
import { inject } from 'vue';

defineProps<{
    src?: string,
    scroll?: ScrollType
}>();

const screen = inject<ScreenInfo>("screenInfo");

</script>


<template>
    <div class="aspect-[2/3] overflow-hidden rounded-xl sm:rounded-2xl rounded-e-none sm:rounded-e-none border-[1px] border-primary"
        :style="{ width: `${interpolate(scroll?.value, [55, 100], screen?.size == 'sm' ? [40, 20] : [22, 10])}%` }">
        <img :src="src"
            class="rounded-xl sm:rounded-2xl rounded-e-none sm:rounded-e-none border-[2px] md:border-[6px] !border-surface-50" />
    </div>
</template>