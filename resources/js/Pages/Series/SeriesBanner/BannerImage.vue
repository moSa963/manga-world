<script setup lang="ts">
import { ScrollType } from '@/Components/WindowScroll.vue';
import { interpolate } from '@/utils/Interpolator';

defineProps<{
    src?: string,
    scroll?: ScrollType
}>();

</script>


<template>
    <div class="aspect-[2/3] overflow-hidden rounded-2xl rounded-e-none border-[1px] border-primary"
        :style="{ width: `${interpolate(scroll?.value, [55, 100], [22, 10])}%` }">
        <img :src="src" class="rounded-2xl rounded-e-none border-[2px] md:border-[6px] !border-surface-50" />
    </div>
</template>