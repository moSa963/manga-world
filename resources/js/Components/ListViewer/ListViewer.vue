<script setup lang="ts">
import { interpolate } from '@/utils/Interpolator';
import { computed, onMounted, ref, watch } from 'vue';
import ListViewerItem from './ListViewerItem.vue';

const anime = ref(0);
const hover = ref(false);
const index = ref(0);
var key: number | undefined;

const props = defineProps<{
    data: Array<any>,
}>();

const emit = defineEmits<{
    click: [item: any]
}>();

onMounted(() => {
    setInterval(() => {
        if (!hover.value && !document.hidden) {
            index.value++;
        }
    }, 8000);
});

watch(index, () => {
    index.value %= props.data.length;
    animateTo(anime.value, index.value, props.data.length);
});

const animateTo = (from: number, to: number, max: number) => {

    const gap = from - to;
    var steps = Math.abs(gap);
    const reverse = max - steps;

    if (steps < reverse) {
        if (gap > 0) {
            steps *= -1;
        }
    } else {
        steps = reverse;
        if (gap < 0) {
            steps *= -1;
        }
    }

    var count = 0;

    clearInterval(key);

    key = setInterval(() => {
        ++count;

        anime.value = mod(from + interpolate(count, [1, 100], [0, steps]), max);

        if (count >= 100) {
            clearInterval(key);
        }
    }, 5);
}

const currentIndex = (i: number) => {
    return (Math.floor(anime.value) + i) % props.data.length;
}

const handleClick = (i: number) => {
    index.value = currentIndex(i);

    if (i === 0) {
        emit('click', props.data[currentIndex(i)]);
    }
}

const handleMouseChange = (v: boolean) => {
    hover.value = v;
}

const mod = (x: number, y: number) => {
    return ((x % y) + y) % y;
}

const handleWheel = (e: WheelEvent) => {
    index.value += e.deltaY > 1 ? 1 : -1;
}

</script>



<template>
    <div class="relative w-full flex flex-col justify-center items-center overflow-hidden">
        <div class="w-full max-w-md aspect-square">
            <div class="relative w-full aspect-square" @wheel.prevent="handleWheel" style="perspective: 800px;">
                <ListViewerItem v-for="(_, i) in 7" :key="currentIndex(i)" @mouse-change="handleMouseChange"
                    @click.capture="() => handleClick(i)" :index="i" :anime-ratio="anime % 1">
                    <slot v-if="data[currentIndex(i)]" :value="data[currentIndex(i)]" />
                </ListViewerItem>
            </div>
        </div>
    </div>
</template>