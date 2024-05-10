<script setup lang="ts">
import { interpolate } from '@/utils/Interpolator';
import { computed, onMounted, ref, watch } from 'vue';
import ListViewerItem from './ListViewerItem.vue';

const num = ref(0);
const hover = ref(false);
const index = ref(0);
var key: number | undefined;

const props = defineProps<{
    data: Array<any>,
}>();

const emit = defineEmits<{
    click: [item: any]
}>();

watch(index, () => {
    index.value %= props.data.length;

    animateTo(num.value, index.value * 100);
});

const animateTo = (c: number, n: number) => {
    var counter = 0;
    clearInterval(key);

    key = setInterval(() => {
        counter += 1;
        num.value = interpolate(counter, [0, 100], [c, n]);

        if (counter == 100) {
            clearInterval(key);
        }
    }, 10);
}

onMounted(() => {
    setInterval(() => {
        if (!hover.value) {
            index.value++;
        }
    }, 8000);
});

const animData = computed(() => {
    return {
        ratio: num.value % 100,
        currentIndex: (i: number) => (Math.floor(num.value / 100) + i) % props.data.length,
    };
});

const handleClick = (i: number) => {
    index.value = animData.value.currentIndex(i);

    if (i === 0) {
        emit('click', props.data[animData.value.currentIndex(i)]);
    }
}

const handleMouseChange = (v: boolean) => {
    hover.value = v;
}

</script>



<template>
    <div class="relative w-full flex flex-col justify-center items-center overflow-hidden">
        <div class="w-full max-w-md aspect-square">
            <div class="relative w-full aspect-square" style="perspective: 800px;">

                <ListViewerItem v-for="i in [0, 1, 2, 3, 4, 5, 6]" @mouse-change="handleMouseChange"
                    @click="() => handleClick(i)" :index="i" :anime-ratio="animData.ratio">
                    <slot v-if="data[animData.currentIndex(i)]" :value="data[animData.currentIndex(i)]" />
                </ListViewerItem>
            </div>
        </div>
    </div>
</template>